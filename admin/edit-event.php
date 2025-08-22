<?php
include("../config/db.php");

// Get Event ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Event ID");
}
$event_id = intval($_GET['id']);

// ================================
// Fetch Event Data
// ================================
$sql = "SELECT * FROM events WHERE event_id = $event_id";
$result = $con->query($sql);
if ($result->num_rows == 0) {
    die("❌ Event not found");
}
$event = $result->fetch_assoc();

// ================================
// Update Event
// ================================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_event'])) {
    $name        = mysqli_real_escape_string($con, $_POST['name']);
    $date        = $_POST['event_date'];
    $price       = $_POST['price'];
    $capacity    = $_POST['capacity'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $category    = mysqli_real_escape_string($con, $_POST['category']);
    $status      = mysqli_real_escape_string($con, $_POST['status']);

    // Handle Image Upload
    $event_image = $event['event_image']; // keep old if not replaced
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
                // delete old image if exists
                if (!empty($event['event_image']) && file_exists("../uploads/events/" . $event['event_image'])) {
                    unlink("../uploads/events/" . $event['event_image']);
                }
                $event_image = $fileName;
            }
        }
    }

    $update_sql = "UPDATE events 
                   SET name='$name', description='$description', event_date='$date', price='$price',
                       capacity='$capacity', status='$status', event_image='$event_image', category='$category'
                   WHERE event_id = $event_id";

    if ($con->query($update_sql)) {
        header("Location: events.php");
        exit();
    } else {
        echo "<script>alert('❌ Error: Could not update event');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Event</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-4">✏️ Edit Event</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-gray-700 font-medium mb-2">Event Name</label>
          <input type="text" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required class="w-full px-3 py-2 border rounded-lg">
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2">Event Date</label>
          <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required class="w-full px-3 py-2 border rounded-lg">
        </div>
      </div>
      <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-gray-700 font-medium mb-2">Price (₹)</label>
          <input type="number" name="price" value="<?php echo $event['price']; ?>" required class="w-full px-3 py-2 border rounded-lg">
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2">Capacity</label>
          <input type="number" name="capacity" value="<?php echo $event['capacity']; ?>" required class="w-full px-3 py-2 border rounded-lg">
        </div>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Event Category</label>
        <select name="category" required class="w-full px-3 py-2 border rounded-lg">
          <option value="Cultural Events" <?php if($event['category']=="Cultural Events") echo "selected"; ?>>Cultural Events</option>
          <option value="Festivals" <?php if($event['category']=="Festivals") echo "selected"; ?>>Festivals</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Event Status</label>
        <select name="status" required class="w-full px-3 py-2 border rounded-lg">
          <option value="active" <?php if($event['status']=="active") echo "selected"; ?>>Active</option>
          <option value="inactive" <?php if($event['status']=="inactive") echo "selected"; ?>>Inactive</option>
          <option value="cancelled" <?php if($event['status']=="cancelled") echo "selected"; ?>>Cancelled</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Event Image</label>
        <?php if (!empty($event['event_image'])): ?>
          <img src="../uploads/events/<?php echo $event['event_image']; ?>" alt="Event Image" class="w-24 h-24 object-cover rounded mb-2">
        <?php endif; ?>
        <input type="file" name="event_image" accept="image/*" class="w-full px-3 py-2 border rounded-lg">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Description</label>
        <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg"><?php echo htmlspecialchars($event['description']); ?></textarea>
      </div>
      <div class="flex space-x-3">
        <button type="submit" name="update_event" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">💾 Update Event</button>
        <a href="events.php" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">⬅ Back</a>
      </div>
    </form>
  </div>
</body>
</html>
