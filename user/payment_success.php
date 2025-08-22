<?php
include("../config/db.php");
$booking_id = (int)($_GET['booking_id'] ?? 0);
$stmt = $con->prepare("SELECT b.*, e.name as event_name FROM bookings b JOIN events e ON e.event_id=b.event_id WHERE booking_id=?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$b = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Payment Success</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">
  <div class="max-w-xl mx-auto bg-white p-8 mt-16 rounded-2xl shadow">
    <div class="text-6xl mb-2">✅</div>
    <h1 class="text-2xl font-bold mb-2">Payment Successful!</h1>
    <?php if($b): ?>
      <p class="text-gray-700 mb-4">Booking #<?php echo $b['booking_id']; ?> for <strong><?php echo htmlspecialchars($b['event_name']); ?></strong> has been confirmed.</p>
      <p class="mb-2">Amount Paid: ₹<?php echo number_format($b['total'],2); ?></p>
      <p class="mb-6">Payment ID: <?php echo htmlspecialchars($b['payment_reference']); ?></p>
    <?php endif; ?>
    <a href="festival.php" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg">Back to Festivals</a>
  </div>
</body>
</html>
