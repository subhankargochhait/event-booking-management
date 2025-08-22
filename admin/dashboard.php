<?php
session_start();
include '../config/db.php'; // DB connection file

// ================== Fetch Stats ==================
$totalEvents = $con->query("SELECT COUNT(*) AS cnt FROM events")->fetch_assoc()['cnt'] ?? 0;
$totalBookings = $con->query("SELECT COUNT(*) AS cnt FROM bookings")->fetch_assoc()['cnt'] ?? 0;
$activeUsers = $con->query("SELECT COUNT(*) AS cnt FROM user")->fetch_assoc()['cnt'] ?? 0; // correct table name
$revenue = $con->query("SELECT SUM(total) AS total FROM bookings WHERE payment_status='Paid'")->fetch_assoc()['total'] ?? 0;

// ================== Recent Bookings ==================
$recentBookings = $con->query("
    SELECT b.booking_id, b.payment_status, b.full_name, e.name AS event_name
    FROM bookings b
    JOIN events e ON b.event_id = e.event_id
    ORDER BY b.created_at DESC LIMIT 5
");

// ================== Upcoming Events ==================
$upcomingEvents = $con->query("
    SELECT e.event_id, e.name, e.event_date,
           (SELECT COUNT(*) FROM bookings b WHERE b.event_id = e.event_id) AS total_bookings
    FROM events e
    WHERE e.event_date >= CURDATE()
    ORDER BY e.event_date ASC LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Event Booking Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex h-screen">

  <?php include 'includes/sidebar.php'; ?>

  <!-- Main Content -->
  <div class="flex-1 overflow-auto">
    <?php include 'includes/header.php'; ?>

    <!-- Dashboard Section -->
    <div id="dashboard" class="content-section active p-6">

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Events -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <p class="text-gray-600 text-sm">Total Events</p>
          <p class="text-3xl font-bold text-blue-600"><?= (int)$totalEvents; ?></p>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <p class="text-gray-600 text-sm">Total Bookings</p>
          <p class="text-3xl font-bold text-green-600"><?= (int)$totalBookings; ?></p>
        </div>

        <!-- Active Users -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <p class="text-gray-600 text-sm">Active Users</p>
          <p class="text-3xl font-bold text-purple-600"><?= (int)$activeUsers; ?></p>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <p class="text-gray-600 text-sm">Revenue</p>
          <p class="text-3xl font-bold text-orange-600">₹<?= number_format((float)$revenue, 2); ?></p>
        </div>
      </div>

      <!-- Recent Bookings -->
      <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Bookings</h3>
          <div class="space-y-3">
            <?php if ($recentBookings->num_rows > 0) {
              while ($row = $recentBookings->fetch_assoc()) { ?>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                  <div>
                    <p class="font-medium"><?= htmlspecialchars($row['event_name']); ?></p>
                    <p class="text-sm text-gray-600">Booked by: <?= htmlspecialchars($row['full_name']); ?></p>
                  </div>
                  <span class="
                    <?php if ($row['payment_status']=='Paid') echo 'bg-green-100 text-green-800'; 
                          elseif ($row['payment_status']=='Pending') echo 'bg-yellow-100 text-yellow-800'; 
                          else echo 'bg-red-100 text-red-800'; ?>
                    px-2 py-1 rounded text-sm">
                    <?= ucfirst(htmlspecialchars($row['payment_status'])); ?>
                  </span>
                </div>
            <?php } } else { ?>
              <p class="text-gray-500 text-sm">No recent bookings found.</p>
            <?php } ?>
          </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-lg font-bold text-gray-800 mb-4">Upcoming Events</h3>
          <div class="space-y-3">
            <?php if ($upcomingEvents->num_rows > 0) {
              while ($row = $upcomingEvents->fetch_assoc()) { ?>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                  <div>
                    <p class="font-medium"><?= htmlspecialchars($row['name']); ?></p>
                    <p class="text-sm text-gray-600"><?= date("M d, Y", strtotime($row['event_date'])); ?></p>
                  </div>
                  <span class="text-blue-600 font-medium"><?= (int)$row['total_bookings']; ?> bookings</span>
                </div>
            <?php } } else { ?>
              <p class="text-gray-500 text-sm">No upcoming events found.</p>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
