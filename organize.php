<?php

include("config/db.php");

// ===============================
// Insert New Event
// ===============================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $name        = mysqli_real_escape_string($con, $_POST['name']);
    $date        = $_POST['event_date'];
    $start_time  = $_POST['start_time'];
    $end_time    = $_POST['end_time'];
    $price       = $_POST['price'];
    $capacity    = $_POST['capacity'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $category    = mysqli_real_escape_string($con, $_POST['category']);
    $location    = mysqli_real_escape_string($con, $_POST['location']);
    $highlights  = mysqli_real_escape_string($con, $_POST['highlights']);
    $status      = "active"; // default status

    // Handle Image Upload
    $event_image = "";
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $targetDir = "uploads/events/"; 
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

    // Insert Event
    $sql = "INSERT INTO events (name, description, event_date, start_time, end_time, price, capacity, 
                                status, event_image, category, location, highlights) 
            VALUES ('$name', '$description', '$date', '$start_time', '$end_time', 
                    '$price', '$capacity', '$status', '$event_image', '$category', '$location', '$highlights')";
    if ($con->query($sql)) {
        echo "<script>alert('✅ Event Created Successfully!');</script>";
    } else {
        echo "<script>alert('❌ Error: Could not create event');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Organize Event</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
<?php include("includes/header.php"); ?>

<div class="container mx-auto px-4 py-8">
  <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">🎉 Organize Your Custom Event</h1>
    
    <!-- Event Form -->
    <form method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-6">
      
      <div>
        <label class="block font-medium">Event Name *</label>
        <input type="text" name="name" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">Event Date *</label>
        <input type="date" name="event_date" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">Start Time *</label>
        <input type="time" name="start_time" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">End Time *</label>
        <input type="time" name="end_time" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">Price (₹) *</label>
        <input type="number" name="price" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">Capacity *</label>
        <input type="number" name="capacity" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">Category *</label>
         <select name="category" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
    <option value="">-- Select Category --</option>
    <option value="Festival">Festival</option>
    <option value="Tech">Tech</option>
    <option value="Cultural">Cultural</option>
    <option value="Sports">Sports</option>
    <option value="Workshops">Workshops</option>
    <option value="Conferences">Conferences</option>
    <option value="Concerts">Concerts</option>
    <option value="Educational">Educational</option>
    <option value="Community">Community</option>
    <option value="Art & Exhibitions">Art & Exhibitions</option>
    <option value="Film & Theatre">Film & Theatre</option>
    <option value="Meetups">Meetups</option>
    <option value="Networking">Networking</option>
    <option value="Seminars & Training">Seminars & Training</option>
    <option value="Fairs & Expos">Fairs & Expos</option>
    <option value="Wedding">Wedding</option>
  </select>
      </div>

      <div>
        <label class="block font-medium">Location *</label>
        <input type="text" name="location" required class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium">Highlights</label>
        <input type="text" name="highlights" class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="e.g. Music, Food, Dance">
      </div>

      <div>
        <label class="block font-medium">Event Image</label>
        <input type="file" name="event_image" accept="image/*" class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium">Description</label>
        <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <div class="md:col-span-2 text-center">
        <button type="submit" name="add_event" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
          ➕ Create Event
        </button>
      </div>
    </form>
  </div>
</div>

<?php include("includes/footer.php"); ?>
</body>
</html>
