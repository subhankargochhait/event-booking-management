<?php
include("../config/db.php");

// ================================
// Fetch All Bookings
// ================================
$sql = "SELECT b.booking_id, b.full_name, b.email, b.phone, b.guests, b.total, 
               b.payment_method, b.payment_status, b.created_at, 
               e.name AS event_name, e.event_date
        FROM bookings b
        JOIN events e ON b.event_id = e.event_id
        ORDER BY b.created_at DESC";

$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Bookings</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">

  <?php include 'includes/sidebar.php'; ?>

  <!-- Main Content -->
  <div class="flex-1 overflow-auto">
    <?php include 'includes/header.php'; ?>

    <!-- Bookings Section -->
    <div id="bookings" class="content-section p-6">
      <h3 class="text-2xl font-bold text-gray-800 mb-6">📋 All Bookings</h3>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs sticky top-0 z-10">
              <tr>
                <th class="px-6 py-3">Booking ID</th>
                <th class="px-6 py-3">User</th>
                <th class="px-6 py-3">Event</th>
                <th class="px-6 py-3">Guests</th>
                <th class="px-6 py-3">Payment Method</th>
                <th class="px-6 py-3">Payment Status</th>
                <th class="px-6 py-3">Total</th>
                <th class="px-6 py-3">Booked On</th>
                <th class="px-6 py-3 text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="hover:bg-gray-50 transition">
                  <td class="px-6 py-4 font-semibold text-gray-800">#<?= $row['booking_id']; ?></td>
                  <td class="px-6 py-4">
                    <p class="font-medium text-gray-900"><?= htmlspecialchars($row['full_name']); ?></p>
                    <p class="text-xs text-gray-500"><?= htmlspecialchars($row['email']); ?></p>
                    <p class="text-xs text-gray-500"><?= htmlspecialchars($row['phone']); ?></p>
                  </td>
                  <td class="px-6 py-4">
                    <p class="font-medium text-gray-900"><?= htmlspecialchars($row['event_name']); ?></p>
                    <p class="text-xs text-gray-500">📅 <?= date("M d, Y", strtotime($row['event_date'])); ?></p>
                  </td>
                  <td class="px-6 py-4"><?= $row['guests']; ?></td>
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                      <?= $row['payment_method']=='Cash' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700'; ?>">
                      <?= $row['payment_method']; ?>
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <?php 
                      $statusClass = "bg-gray-100 text-gray-700";
                      if ($row['payment_status'] == 'Paid') $statusClass = "bg-green-100 text-green-700";
                      elseif ($row['payment_status'] == 'Pending') $statusClass = "bg-yellow-100 text-yellow-700";
                      elseif ($row['payment_status'] == 'Failed') $statusClass = "bg-red-100 text-red-700";
                    ?>
                    <span class="<?= $statusClass; ?> px-3 py-1 rounded-full text-xs font-semibold">
                      <?= $row['payment_status']; ?>
                    </span>
                  </td>
                  <td class="px-6 py-4 font-bold text-gray-900">₹<?= number_format($row['total'], 2); ?></td>
                  <td class="px-6 py-4 text-xs text-gray-600"><?= date("M d, Y H:i", strtotime($row['created_at'])); ?></td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center space-x-2">
                      <a href="view-booking.php?id=<?= $row['booking_id']; ?>" 
                         class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full" title="View">
                         🔍
                      </a>
                      <a href="delete-booking.php?id=<?= $row['booking_id']; ?>" 
                         onclick="return confirm('Are you sure you want to delete this booking?')" 
                         class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full" title="Delete">
                         🗑️
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
