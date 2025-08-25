<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['un'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid Event");
}

$event_id   = (int)$_GET['id'];
$session_identifier = $_SESSION['un'];

// Fetch event details
$stmt = $con->prepare("SELECT * FROM events WHERE event_id=? AND status='active'");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

if (!$event) {
    die("Event not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Checkout - <?php echo htmlspecialchars($event['name']); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen">

  <div class="max-w-5xl mx-auto px-4 py-10">
    <div class="grid md:grid-cols-2 gap-8">

      <!-- Left: Event summary -->
      <div class="bg-white shadow-2xl rounded-2xl p-8">
        <div class="w-full h-56 mb-6 rounded-xl overflow-hidden bg-gray-100">
          <?php if(!empty($event['event_image'])): ?>
            <img src="../uploads/events/<?php echo htmlspecialchars($event['event_image']); ?>" 
                 alt="Event Image" class="w-full h-full object-cover">
          <?php else: ?>
            <div class="flex items-center justify-center h-full text-6xl">🎉</div>
          <?php endif; ?>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['name']); ?></h1>
        <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($event['description']); ?></p>

        <div class="text-sm space-y-2 mb-6">
          <p>📅 <span class="font-medium"><?php echo date("F j, Y", strtotime($event['event_date'])); ?></span></p>
          <p>⏰ 
            <span class="font-medium">
              <?php 
                if (!empty($event['start_time']) && !empty($event['end_time'])) {
                    echo date("g:i A", strtotime($event['start_time'])) . " - " . date("g:i A", strtotime($event['end_time']));
                } else {
                    echo "All Day";
                }
              ?>
            </span>
          </p>
          <p>📍 <span class="font-medium"><?php echo htmlspecialchars($event['location']); ?></span></p>
          <p>✨ <span class="font-medium"><?php echo htmlspecialchars($event['highlights']); ?></span></p>
        </div>

        <div class="text-3xl font-extrabold text-indigo-600">
          ₹<?php echo number_format($event['price'], 2); ?>
        </div>
      </div>

      <!-- Right: Payment & Details -->
      <div class="bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-xl font-semibold mb-6">Complete your booking</h2>

        <form id="checkout-form" class="space-y-5" method="post" action="payment_success.php">
          <input type="hidden" name="event_id" value="<?php echo (int)$event_id; ?>" />
          <input type="hidden" id="method" name="method" value="Razorpay" />
          <input type="hidden" id="payment_id" name="payment_id" value="" />

          <!-- User Details -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="full_name" required
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email"required
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="phone" required
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea name="address" rows="2" required
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   placeholder="Enter your address"></textarea>
          </div>

          <!-- Guests -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
            <input type="number" name="guests" id="guests" min="1" value="1"
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
          </div>

          <!-- Requirements -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Requirements (optional)</label>
            <textarea name="requirements" id="requirements" rows="3"
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   placeholder="Any special requests or notes"></textarea>
          </div>

          <!-- Payment Method -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
            <div class="grid grid-cols-1 gap-3">
              <label class="flex items-center gap-3 border rounded-xl p-3 cursor-pointer hover:bg-indigo-50">
                <input type="radio" name="pay_option" id="pay_razorpay" value="Razorpay" class="h-5 w-5" checked>
                <div>
                  <div class="font-semibold">Razorpay (UPI / Cards / NetBanking)</div>
                  <div class="text-xs text-gray-500">Instant online payment</div>
                </div>
              </label>
              <label class="flex items-center gap-3 border rounded-xl p-3 cursor-pointer hover:bg-indigo-50">
                <input type="radio" name="pay_option" id="pay_cod" value="Cash">
                <div>
                  <div class="font-semibold">Cash on Delivery</div>
                  <div class="text-xs text-gray-500">Pay at venue (status: Pending)</div>
                </div>
              </label>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex gap-3 pt-2">
            <button type="button" id="btn-pay"
              class="flex-1 bg-gradient-to-r from-indigo-600 to-blue-700 text-white py-3 px-6 rounded-xl 
                     font-semibold shadow-lg hover:from-indigo-700 hover:to-blue-800 transition-all transform hover:scale-105">
              Book Now
            </button>
            <a href="all_events.php"
               class="px-5 py-3 rounded-xl border text-gray-700 hover:bg-gray-50">Cancel</a>
          </div>
        </form>
      </div>

    </div>
  </div>

  <script>
    const rzpOptions = {
      key: "rzp_test_R6gWimTKYuOdob", // Replace with your live/test key
      amount: "<?php echo (int)($event['price'] * 100); ?>",
      currency: "INR",
      name: "Bharat Events",
      description: "<?php echo htmlspecialchars($event['name']); ?> Booking",
      handler: function (response) {
        document.getElementById('payment_id').value = response.razorpay_payment_id;
        document.getElementById('method').value = 'Razorpay';
        document.getElementById('checkout-form').submit();
      },
      prefill: {
        email: "<?php echo htmlspecialchars($session_identifier); ?>"
      },
      theme: { color: "#6366F1" }
    };
    const rzp = new Razorpay(rzpOptions);

    document.getElementById('btn-pay').addEventListener('click', function(e) {
      e.preventDefault();
      const payMethod = document.querySelector('input[name="pay_option"]:checked')?.value || 'Razorpay';
      if (payMethod === 'Razorpay') {
        rzp.open();
      } else {
        document.getElementById('payment_id').value = '';
        document.getElementById('method').value = 'Cash';
        document.getElementById('checkout-form').submit();
      }
    });
  </script>
</body>
</html>
