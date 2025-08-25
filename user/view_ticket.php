<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['un'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['booking_id'])) {
    die("Invalid Ticket Request.");
}

$booking_id = (int)$_GET['booking_id'];
$user_email = $_SESSION['email'] ?? $_SESSION['un'];

// ✅ Fetch booking + event details
$stmt = $con->prepare("SELECT b.*, e.name AS event_name, e.location, e.event_date, e.start_time, e.end_time, e.event_image
                       FROM bookings b
                       JOIN events e ON b.event_id = e.event_id
                       WHERE b.booking_id = ? AND b.email = ?");
$stmt->bind_param("is", $booking_id, $user_email);
$stmt->execute();
$ticket = $stmt->get_result()->fetch_assoc();

if (!$ticket) {
    die("❌ Ticket not found or you don’t have access.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🎫 Ticket - <?php echo htmlspecialchars($ticket['event_name']); ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-2xl rounded-2xl max-w-lg w-full p-8 relative border border-gray-200">
  
  <!-- Event Banner -->
  <div class="w-full h-48 rounded-xl overflow-hidden mb-6 relative">
    <?php if (!empty($ticket['event_image'])): ?>
      <img src="../uploads/events/<?php echo htmlspecialchars($ticket['event_image']); ?>" 
           class="w-full h-48 object-cover" alt="">
    <?php else: ?>
      <div class="w-full h-48 flex items-center justify-center text-6xl">🎉</div>
    <?php endif; ?>
    <span class="absolute top-3 right-3 bg-indigo-600 text-white text-xs px-3 py-1 rounded-full">
      <?php echo htmlspecialchars($ticket['payment_status']); ?>
    </span>
  </div>

  <!-- Ticket Info -->
  <h1 class="text-3xl font-bold text-indigo-700 mb-2"><?php echo htmlspecialchars($ticket['event_name']); ?></h1>
  <p class="text-gray-600 mb-1">📅 <?php echo date("F j, Y", strtotime($ticket['event_date'])); ?></p>
  <p class="text-gray-600 mb-1">⏰ 
    <?php echo !empty($ticket['start_time']) ? date("g:i A", strtotime($ticket['start_time'])) : 'All Day'; ?> 
    <?php echo (!empty($ticket['end_time'])) ? ' - ' . date("g:i A", strtotime($ticket['end_time'])) : ''; ?>
  </p>
  <p class="text-gray-600 mb-1">📍 <?php echo htmlspecialchars($ticket['location']); ?></p>
  
  <hr class="my-4">

  <!-- Booking Info -->
  <div class="space-y-2 text-gray-700">
    <p><strong>👤 Name:</strong> <?php echo htmlspecialchars($ticket['full_name']); ?></p>
    <p><strong>📧 Email:</strong> <?php echo htmlspecialchars($ticket['email']); ?></p>
    <p><strong>📞 Phone:</strong> <?php echo htmlspecialchars($ticket['phone']); ?></p>
    <p><strong>👥 Guests:</strong> <?php echo (int)$ticket['guests']; ?></p>
    <p><strong>💰 Paid:</strong> ₹<?php echo number_format($ticket['total'], 2); ?></p>
    <p><strong>Txn ID:</strong> <?php echo htmlspecialchars($ticket['payment_reference'] ?? 'N/A'); ?></p>
  </div>

  <hr class="my-4">

  <!-- QR Code (Optional: can use Google Chart API) -->
  <div class="flex justify-center mb-4">
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BookingID-<?php echo $ticket['booking_id']; ?>" alt="QR Code">
  </div>

  <!-- Buttons -->
  <div class="flex justify-between">
    <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-2 rounded-xl hover:bg-indigo-700 transition">
      🖨️ Print Ticket
    </button>
    <a href="my_bookings.php" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-xl hover:bg-gray-400 transition">
      🔙 Back
    </a>
  </div>
</div>

</body>
</html>
