<?php
session_start();
if (!isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if (!isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}

$user_email = $_SESSION["un"];

// Fetch all events booked by the user
$events_query = $con->prepare("
    SELECT b.booking_id, b.payment_status, b.created_at, 
           e.event_id, e.name, e.description, e.category, e.event_date, e.price, e.capacity, e.status, e.event_image
    FROM bookings b
    JOIN events e ON b.event_id = e.event_id
    WHERE b.email = ?
    ORDER BY e.event_date DESC
");
$events_query->bind_param("s", $user_email);
$events_query->execute();
$events_result = $events_query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Events</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-r from-orange-200 via-pink-200 to-teal-200 min-h-screen">

  <!-- Header -->
  <?php include("../includes/user_header.php"); ?>

  <!-- Page Title -->
  <div class="max-w-7xl mx-auto px-6 pt-8">
    <div class="bg-white/70 rounded-3xl p-6 shadow-lg text-center">
      <h1 class="text-3xl font-bold text-gray-800">🎉 My Booked Events</h1>
      <p class="text-gray-600">Here is your event booking history</p>
    </div>
  </div>

  <!-- Events List -->
  <main class="max-w-7xl mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php if ($events_result->num_rows > 0) { 
        while ($event = $events_result->fetch_assoc()) { ?>
        
        <div class="bg-white/80 rounded-2xl shadow-md hover:shadow-2xl transition transform hover:-translate-y-2">
          <!-- Event Image -->
          <?php if (!empty($event['event_image'])) { ?>
            <img src="../uploads/events/<?php echo htmlspecialchars($event['event_image']); ?>" 
                 alt="<?php echo htmlspecialchars($event['name']); ?>" 
                 class="w-full h-48 object-cover rounded-t-2xl">
          <?php } else { ?>
            <div class="w-full h-48 bg-gray-300 rounded-t-2xl flex items-center justify-center text-gray-600">
              No Image
            </div>
          <?php } ?>
          
          <!-- Event Details -->
          <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['name']); ?></h2>
            <p class="text-gray-600 text-sm mb-3"><?php echo htmlspecialchars(substr($event['description'], 0, 80)); ?>...</p>
            <p class="text-gray-700 mb-1">📅 <?php echo date("M d, Y", strtotime($event['event_date'])); ?></p>
            <p class="text-sm text-gray-600">Booked On: <?php echo date("M d, Y", strtotime($event['created_at'])); ?></p>
            <p class="text-sm text-gray-500 mb-3">Category: <?php echo htmlspecialchars($event['category']); ?></p>
            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        <?php echo ($event['payment_status']=="Paid") ? "bg-green-100 text-green-700" : "bg-red-100 text-red-700"; ?>">
              <?php echo htmlspecialchars($event['payment_status']); ?>
            </span>

            <!-- View Ticket Button -->
            <div class="mt-4">
              <a href="view_ticket.php?booking_id=<?php echo $event['booking_id']; ?>" 
                 class="block w-full text-center bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:scale-105 transition">
                 🎫 View Ticket
              </a>
            </div>
          </div>
        </div>

      <?php } } else { ?>
        <p class="text-gray-600">You haven’t booked any events yet.</p>
      <?php } ?>
    </div>
  </main>

  <!-- Footer -->
  <?php include("../includes/footer.php"); ?>

</body>
</html>
