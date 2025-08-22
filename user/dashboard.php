<?php
session_start();
include("../config/db.php"); // <-- make sure this file connects to DB

if (!isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}

$username = htmlspecialchars($_SESSION["un"]);

// Fetch User Info
$user_query = $con->prepare("SELECT uid, name, email FROM user WHERE email = ?");
$user_query->bind_param("s", $_SESSION["un"]);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();
// $uid = $user['uid'];

// Count Upcoming Events
$today = date("Y-m-d");
$upcoming_query = $con->prepare("SELECT COUNT(*) as total FROM events WHERE event_date >= ? AND status = 'active'");
$upcoming_query->bind_param("s", $today);
$upcoming_query->execute();
$upcoming_result = $upcoming_query->get_result()->fetch_assoc();
$upcoming_events = $upcoming_result['total'];

// Count Tickets Booked
$booked_query = $con->prepare("SELECT COUNT(*) as total FROM bookings WHERE email = ?");
$booked_query->bind_param("s", $user['email']);
$booked_query->execute();
$booked_result = $booked_query->get_result()->fetch_assoc();
$tickets_booked = $booked_result['total'];

// Count Notifications (Example: pending payments or failed bookings)
$notify_query = $con->prepare("SELECT COUNT(*) as total FROM bookings WHERE email = ? AND payment_status IN ('Pending','Failed')");
$notify_query->bind_param("s", $user['email']);
$notify_query->execute();
$notify_result = $notify_query->get_result()->fetch_assoc();
$notifications = $notify_result['total'];

// Fetch Bookings List
$bookings_query = $con->prepare("SELECT b.booking_id, e.name as event_name, e.event_date, e.category, b.payment_status 
                                  FROM bookings b 
                                  JOIN events e ON b.event_id = e.event_id 
                                  WHERE b.email = ? ORDER BY e.event_date ASC");
$bookings_query->bind_param("s", $user['email']);
$bookings_query->execute();
$bookings_result = $bookings_query->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-r from-orange-200 via-pink-200 to-teal-200 min-h-screen">

  <!-- Header -->
  <?php include("../includes/user_header.php"); ?>

  <!-- Welcome -->
<div class="max-w-7xl mx-auto px-6 pt-8">
  <div class="bg-white/60 rounded-3xl p-8 mb-8 shadow-lg text-center">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
      🙏 Welcome, <?php echo isset($user['un']); ?>! 🎉
    </h1>
    <p class="text-lg text-gray-600">Here is your event booking dashboard</p>
  </div>
</div>


  <!-- Overview -->
  <main class="max-w-7xl mx-auto px-6 pb-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
      <div class="bg-white/70 rounded-3xl p-8 text-center shadow-lg">
        <div class="text-5xl mb-4">🎪</div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Upcoming Events</h3>
        <p class="text-4xl font-bold text-orange-600 mt-4"><?php echo $upcoming_events; ?></p>
      </div>
      <div class="bg-white/70 rounded-3xl p-8 text-center shadow-lg">
        <div class="text-5xl mb-4">🎟️</div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Tickets Booked</h3>
        <p class="text-4xl font-bold text-green-600 mt-4"><?php echo $tickets_booked; ?></p>
      </div>
      <div class="bg-white/70 rounded-3xl p-8 text-center shadow-lg">
        <div class="text-5xl mb-4">🔔</div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Notifications</h3>
        <p class="text-4xl font-bold text-blue-600 mt-4"><?php echo $notifications; ?></p>
      </div>
    </div>

    <!-- Bookings -->
    <div class="bg-white/80 rounded-3xl p-8 shadow-lg">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">🎟 My Bookings</h2>
      <div class="space-y-6">
        <?php if ($bookings_result->num_rows > 0) { 
          while ($row = $bookings_result->fetch_assoc()) { ?>
            <div class="bg-white/60 rounded-2xl p-6 shadow-md border-l-4 border-orange-400">
              <div class="flex justify-between items-center">
                <div>
                  <h4 class="text-xl font-bold text-gray-800"><?php echo $row['event_name']; ?></h4>
                  <p class="text-gray-700">📅 <?php echo date("M d, Y", strtotime($row['event_date'])); ?></p>
                  <p class="text-sm text-gray-500">Category: <?php echo $row['category']; ?></p>
                  <p class="text-sm <?php echo ($row['payment_status']=="Paid")?"text-green-600":"text-red-600"; ?>">
                    Status: <?php echo $row['payment_status']; ?>
                  </p>
                </div>
                <a href="view_ticket.php?booking_id=<?php echo $row['booking_id']; ?>" 
                   class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-lg font-semibold shadow hover:scale-105 transition">
                   🎫 View Ticket
                </a>
              </div>
            </div>
        <?php } } else { ?>
            <p class="text-gray-600">No bookings yet.</p>
        <?php } ?>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include("../includes/footer.php"); ?>

</body>
</html>
