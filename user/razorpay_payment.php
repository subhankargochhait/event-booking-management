<?php
// razorpay_payment.php
include("../config/db.php");
include("../config/razorpay.php"); 
// razorpay.php must define:
// define("RAZORPAY_KEY_ID", "rzp_test_xxxxx");
// define("RAZORPAY_KEY_SECRET", "xxxxxxxxxxxxxx");
// define("CURRENCY", "INR");
// define("RAZORPAY_API_BASE", "https://api.razorpay.com/v1");

if (!isset($_GET['booking_id'])) { die("Missing booking id"); }
$booking_id = (int)$_GET['booking_id'];

$stmt = $con->prepare("SELECT b.*, e.name AS event_name FROM bookings b JOIN events e ON e.event_id=b.event_id WHERE b.booking_id=?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$booking || $booking['payment_method'] !== 'Razorpay') { die("Invalid booking"); }

$amountPaise = (int)round($booking['total'] * 100);

// Create Razorpay Order if not created yet
if (empty($booking['razorpay_order_id'])) {
    $ch = curl_init(RAZORPAY_API_BASE . "/orders");
    $data = json_encode([
      "amount" => $amountPaise,
      "currency" => CURRENCY,
      "receipt" => "BKID_" . $booking_id,
      "payment_capture" => 1
    ]);
    // ✅ use correct API keys
    curl_setopt($ch, CURLOPT_USERPWD, "rzp_test_R6gWimTKYuOdob" . ":" . "Y8JxgzTXxVlqs9dLvfdvGvNd");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    if ($result === false) { die("Razorpay error: " . curl_error($ch)); }
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $order = json_decode($result, true);
    if ($statusCode !== 200 || empty($order['id'])) {
        die("Failed to create order with Razorpay: " . htmlspecialchars($result));
    }
    $razorpay_order_id = $order['id'];

    $up = $con->prepare("UPDATE bookings SET razorpay_order_id=? WHERE booking_id=?");
    $up->bind_param("si", $razorpay_order_id, $booking_id);
    $up->execute();
    $up->close();

    $booking['razorpay_order_id'] = $razorpay_order_id;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pay with Razorpay</title>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function payNow(){
      var options = {
        "key": "<?php echo RAZORPAY_KEY_ID; ?>", // only publishable key
        "amount": "<?php echo (int)$amountPaise; ?>",
        "currency": "<?php echo CURRENCY; ?>",
        "name": "<?php echo htmlspecialchars($booking['event_name']); ?>",
        "description": "Booking #<?php echo $booking_id; ?>",
        "order_id": "<?php echo htmlspecialchars($booking['razorpay_order_id']); ?>",
        "prefill": {
          "name": "<?php echo htmlspecialchars($booking['full_name']); ?>",
          "email": "<?php echo htmlspecialchars($booking['email']); ?>",
          "contact": "<?php echo htmlspecialchars($booking['phone']); ?>"
        },
        "handler": function (response){
          var form = document.createElement('form');
          form.method = 'POST';
          form.action = 'razorpay_callback.php';
          ['razorpay_payment_id','razorpay_order_id','razorpay_signature'].forEach(function(k){
            var i = document.createElement('input');
            i.type='hidden'; i.name=k; i.value=response[k];
            form.appendChild(i);
          });
          var bi = document.createElement('input');
          bi.type='hidden'; bi.name='booking_id'; bi.value='<?php echo $booking_id; ?>';
          form.appendChild(bi);
          document.body.appendChild(form);
          form.submit();
        },
        "theme": {"color": "#7c3aed"}
      };
      var rzp = new Razorpay(options);
      rzp.on('payment.failed', function (){
        window.location = 'payment_failed.php?booking_id=<?php echo $booking_id; ?>';
      });
      rzp.open();
    }
  </script>
</head>
<body class="bg-gray-50">
  <div class="max-w-xl mx-auto bg-white p-8 mt-16 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-2">Pay for: <?php echo htmlspecialchars($booking['event_name']); ?></h1>
    <p class="mb-6 text-gray-600">Booking #<?php echo $booking_id; ?> • Total: <strong>₹<?php echo number_format($booking['total'],2); ?></strong></p>
    <button onclick="payNow()" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700">Pay with Razorpay</button>
    <a href="festival.php" class="block text-center mt-4 text-gray-600">Cancel</a>
  </div>
</body>
</html>
