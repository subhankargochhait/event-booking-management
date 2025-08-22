<?php
$booking_id = (int)($_GET['booking_id'] ?? 0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Payment Failed</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50">
  <div class="max-w-xl mx-auto bg-white p-8 mt-16 rounded-2xl shadow">
    <div class="text-6xl mb-2">❌</div>
    <h1 class="text-2xl font-bold mb-2">Payment Failed</h1>
    <p class="text-gray-700 mb-6">We couldn’t process your payment for booking #<?php echo $booking_id; ?>.</p>
    <div class="flex gap-3">
      <a href="razorpay_payment.php?booking_id=<?php echo $booking_id; ?>" class="bg-purple-600 text-white px-6 py-3 rounded-lg">Try Again</a>
      <a href="festival.php" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg">Back</a>
    </div>
  </div>
</body>
</html>
