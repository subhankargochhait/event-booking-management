<?php
include("../config/db.php");

// ================================
// Add New Event
// ================================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $name        = mysqli_real_escape_string($con, $_POST['name']);
    $date        = $_POST['event_date'];
    $price       = $_POST['price'];
    $capacity    = $_POST['capacity'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $category    = mysqli_real_escape_string($con, $_POST['category']);
    $status      = mysqli_real_escape_string($con, $_POST['status']);

    // Handle Image Upload
    $event_image = "";
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $targetDir = "../uploads/events/"; 
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['event_image']['name']);
        $targetFile = $targetDir . $fileName;

        $allowedTypes = ['jpg','jpeg','png','gif','webp'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedTypes)) {
            if (move_uploaded_file($_FILES['event_image']['tmp_name'], $targetFile)) {
                $event_image = $fileName;
            }
        }
    }

    $sql = "INSERT INTO events (name, description, event_date, price, capacity, status, event_image, category)
            VALUES ('$name', '$description', '$date', '$price', '$capacity', '$status', '$event_image', '$category')";
    
    if ($con->query($sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<script>alert('❌ Error: Could not add event');</script>";
    }
}

// ================================
// Fetch Events with booking counts
// ================================
$sql = "SELECT e.*, 
               COUNT(b.booking_id) AS total_bookings 
        FROM events e
        LEFT JOIN bookings b 
          ON e.event_id = b.event_id AND b.payment_status='Paid'
        GROUP BY e.event_id
        ORDER BY e.event_date ASC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Event Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">

  <?php include 'includes/sidebar.php'; ?>

  <!-- Main Content -->
  <div class="flex-1 overflow-auto">
    <?php include 'includes/header.php'; ?>

    <!-- Events Section -->
    <div id="events" class="content-section p-6">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-800">Event Management</h3>
        <button onclick="showAddEventForm()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
          ➕ Add New Event
        </button>
      </div>

      <!-- Add Event Form -->
      <div id="addEventForm" class="hidden bg-white rounded-lg shadow-md p-6 mb-6">
        <h4 class="text-lg font-bold text-gray-800 mb-4">Add New Event</h4>
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
              <label class="block text-gray-700 font-medium mb-2">Event Name</label>
              <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700 font-medium mb-2">Event Date</label>
              <input type="date" name="event_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
          </div>
          <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
              <label class="block text-gray-700 font-medium mb-2">Price (₹)</label>
              <input type="number" name="price" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700 font-medium mb-2">Capacity</label>
              <input type="number" name="capacity" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Event Category</label>
            <select name="category" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
              <option value="Cultural Events">Cultural Events</option>
              <option value="Festivals">Festivals</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Event Status</label>
            <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Event Image</label>
            <input type="file" name="event_image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
          </div>
          <div class="flex space-x-3">
            <button type="submit" name="add_event" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
              💾 Save Event
            </button>
            <button type="button" onclick="hideAddEventForm()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
              ❌ Cancel
            </button>
          </div>
        </form>
      </div>

      <!-- Events Table -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Event</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bookings</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td class="px-6 py-4">
                  <div>
                    <p class="font-medium text-gray-800"><?php echo $row['name']; ?></p>
                    <p class="text-sm text-gray-600"><?php echo $row['description']; ?></p>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <?php if (!empty($row['event_image'])): ?>
                    <img src="../uploads/events/<?php echo $row['event_image']; ?>" alt="Event Image" class="w-16 h-16 object-cover rounded">
                  <?php else: ?>
                    <span class="text-gray-400 italic">No Image</span>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-gray-800"><?php echo $row['category']; ?></td>
                <td class="px-6 py-4 text-gray-800"><?php echo date("M d, Y", strtotime($row['event_date'])); ?></td>
                <td class="px-6 py-4 text-gray-800">₹<?php echo $row['price']; ?></td>
                <td class="px-6 py-4 text-gray-800"><?php echo $row['total_bookings'] . " / " . $row['capacity']; ?></td>
                <td class="px-6 py-4">
                  <?php 
                    $statusClass = "bg-gray-100 text-gray-800"; 
                    if ($row['status'] == 'active') $statusClass = "bg-green-100 text-green-800";
                    elseif ($row['status'] == 'inactive') $statusClass = "bg-yellow-100 text-yellow-800";
                    elseif ($row['status'] == 'cancelled') $statusClass = "bg-red-100 text-red-800";
                  ?>
                  <span class="<?php echo $statusClass; ?> px-2 py-1 rounded text-sm">
                    <?php echo ucfirst($row['status']); ?>
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex space-x-2">
                    <a href="edit-event.php?id=<?php echo $row['event_id']; ?>" 
                       class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Edit</a>
                    <a href="delete-event.php?id=<?php echo $row['event_id']; ?>" 
                       onclick="return confirm('Are you sure?')" 
                       class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">Delete</a>
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

<script>
  function showAddEventForm() {
    document.getElementById('addEventForm').classList.remove('hidden');
  }
  function hideAddEventForm() {
    document.getElementById('addEventForm').classList.add('hidden');
  }
</script>
</body>
</html>
