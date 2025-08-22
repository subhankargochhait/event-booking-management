<?php
// DB Connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "event_booking_management";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ==============================
// Monthly Revenue (last 6 months)
// ==============================
$monthlyLabels = [];
$monthlyRevenue = [];

for ($i = 5; $i >= 0; $i--) {
    $month = date("M", strtotime("-$i months"));
    $yearMonth = date("Y-m", strtotime("-$i months"));
    $monthlyLabels[] = $month;

    $query = "SELECT SUM(total) as total 
              FROM bookings 
              WHERE payment_status='Paid' 
              AND DATE_FORMAT(created_at,'%Y-%m')='$yearMonth'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    $monthlyRevenue[] = $row['total'] ? $row['total'] : 0;
}

// ==============================
// Event Popularity (Top 4 Events)
// ==============================
$eventLabels = [];
$eventBookings = [];

$popQuery = "SELECT e.name, COUNT(b.booking_id) as total_bookings
             FROM events e
             LEFT JOIN bookings b ON e.event_id = b.event_id AND b.payment_status='Paid'
             GROUP BY e.event_id
             ORDER BY total_bookings DESC
             LIMIT 4";
$popResult = mysqli_query($conn, $popQuery);

while ($row = mysqli_fetch_assoc($popResult)) {
    $eventLabels[] = $row['name'];
    $eventBookings[] = $row['total_bookings'];
}

// ==============================
// Performance Metrics
// ==============================
// Booking Success Rate
$totalBookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as cnt FROM bookings"))['cnt'];
$confirmedBookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as cnt FROM bookings WHERE payment_status='Paid'"))['cnt'];
$successRate = $totalBookings > 0 ? round(($confirmedBookings / $totalBookings) * 100) : 0;

// Average Monthly Revenue (last 6 months)
$avgRevenue = array_sum($monthlyRevenue) / 6;

// Customer Satisfaction (dummy for now, unless you have ratings table)
$customerSatisfaction = "4.8/5";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Event Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
  <?php include 'includes/sidebar.php'; ?>
  <div class="flex-1 overflow-auto">
    <?php include 'includes/header.php'; ?>

    <!-- Analytics Section -->
    <div id="analytics" class="content-section p-6">
      <h3 class="text-xl font-bold text-gray-800 mb-6">📊 Revenue Analytics</h3>
      
      <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Monthly Revenue Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <h4 class="text-lg font-bold text-gray-800 mb-4">Monthly Revenue</h4>
          <canvas id="revenueChart"></canvas>
        </div>

        <!-- Event Popularity Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <h4 class="text-lg font-bold text-gray-800 mb-4">Event Popularity</h4>
          <canvas id="popularityChart"></canvas>
        </div>
      </div>

      <!-- Performance Metrics -->
      <div class="bg-white rounded-xl shadow-md p-6">
        <h4 class="text-lg font-bold text-gray-800 mb-4">Performance Metrics</h4>
        <div class="grid md:grid-cols-3 gap-6">
          <div class="text-center">
            <p class="text-3xl font-bold text-blue-600"><?php echo $successRate; ?>%</p>
            <p class="text-gray-600">Booking Success Rate</p>
          </div>
          <div class="text-center">
            <p class="text-3xl font-bold text-green-600">₹<?php echo number_format($avgRevenue,0); ?></p>
            <p class="text-gray-600">Average Monthly Revenue</p>
          </div>
          <div class="text-center">
            <p class="text-3xl font-bold text-purple-600"><?php echo $customerSatisfaction; ?></p>
            <p class="text-gray-600">Customer Satisfaction</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Monthly Revenue Chart
new Chart(document.getElementById('revenueChart'), {
  type: 'line',
  data: {
    labels: <?php echo json_encode($monthlyLabels); ?>,
    datasets: [{
      label: 'Revenue (₹)',
      data: <?php echo json_encode($monthlyRevenue); ?>,
      borderColor: 'rgb(37, 99, 235)',
      backgroundColor: 'rgba(37, 99, 235, 0.2)',
      borderWidth: 2,
      fill: true,
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } }
  }
});

// Event Popularity Chart
new Chart(document.getElementById('popularityChart'), {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($eventLabels); ?>,
    datasets: [{
      label: 'Bookings',
      data: <?php echo json_encode($eventBookings); ?>,
      backgroundColor: [
        'rgb(37, 99, 235)',
        'rgb(34, 197, 94)',
        'rgb(139, 92, 246)',
        'rgb(239, 68, 68)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { position: 'bottom' } }
  }
});
</script>
</body>
</html>
