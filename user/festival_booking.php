<?php
session_start();
if (!isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if (!isset($_GET['id'])) { die("Invalid request"); }
$event_id = (int)$_GET['id'];

$stmt = $con->prepare("SELECT * FROM events WHERE event_id=? AND status='active'");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$event) { die("Event not found or inactive"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($event['name']); ?> - Booking</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<?php include("../includes/user_header.php"); ?>
<div class="container mx-auto px-4 py-8">
  <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
    <div class="grid md:grid-cols-2 gap-6">
      <div>
        <img src="../uploads/events/<?php echo htmlspecialchars($event['event_image']); ?>" class="w-full h-80 object-cover rounded-xl" alt="">
      </div>
      <div>
        <h2 class="text-3xl font-bold mb-2"><?php echo htmlspecialchars($event['name']); ?></h2>
        <p class="text-gray-600 mb-4"><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
        <div class="flex flex-col gap-2 text-lg font-semibold">
          <span>📅 Date: <?php echo date("d M Y", strtotime($event['event_date'])); ?></span>
          <span>💰 Price per booking: ₹<?php echo number_format($event['price'],2); ?></span>
          <span>🏷️ Category: <?php echo htmlspecialchars($event['category']); ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Booking Form -->
  <div class="max-w-2xl mx-auto bg-white rounded-2xl p-8 shadow-2xl">
    <h3 class="text-2xl font-bold mb-6 text-center">Book This Festival</h3>
    <form action="book_event.php" method="POST">
      <input type="hidden" name="event_id" value="<?php echo (int)$event['event_id']; ?>">
      <input type="hidden" name="base_price" value="<?php echo (float)$event['price']; ?>">

      <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div>
          <label class="block mb-2">Full Name *</label>
          <input type="text" name="fullName" required class="w-full px-4 py-3 border rounded-lg">
        </div>
        <div>
          <label class="block mb-2">Phone *</label>
          <input type="tel" name="phone" required class="w-full px-4 py-3 border rounded-lg">
        </div>
      </div>

      <div class="mb-6">
        <label class="block mb-2">Email *</label>
        <input type="email" name="email" required class="w-full px-4 py-3 border rounded-lg">
      </div>

      <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div>
          <label class="block mb-2">Guests</label>
          <input type="number" name="guests" value="1" min="1" required class="w-full px-4 py-3 border rounded-lg">
        </div>
        <div>
          <label class="block mb-2">Event Date</label>
          <input type="date" name="eventDate" value="<?php echo htmlspecialchars($event['event_date']); ?>" min="<?php echo date('Y-m-d'); ?>" required class="w-full px-4 py-3 border rounded-lg">
        </div>
      </div>

      <div class="mb-6">
        <label class="block mb-2">Special Requirements</label>
        <textarea name="requirements" rows="3" class="w-full px-4 py-3 border rounded-lg"></textarea>
      </div>

      <div class="mb-6">
        <label class="block mb-2">Payment Method *</label>
        <select name="payment_method" class="w-full px-4 py-3 border rounded-lg" required>
          <option value="Cash">Cash</option>
          <option value="Razorpay">Razorpay</option>
        </select>
      </div>

      <div class="flex justify-between mb-6 font-bold text-xl">
        <span>Total (Guests × Price):</span>
        <span id="totalText">₹<?php echo number_format($event['price'],2); ?></span>
      </div>

      <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-4 rounded-lg hover:scale-105 transition">
        ✅ Confirm Booking
      </button>
    </form>
  </div>
</div>
<?php include("../includes/footer.php"); ?>
</body>
</html>
