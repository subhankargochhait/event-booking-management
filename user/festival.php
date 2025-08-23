<?php
session_start();
if (!isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Festivals</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-orange-50 min-h-screen">
<?php include("../includes/user_header.php"); ?>

<div class="container mx-auto px-4 py-10">
  <!-- Page Heading -->
  <div class="text-center mb-12">
    <h1 class="text-5xl font-bold text-gray-800 mb-4">🎉 Indian Festivals</h1>
    <p class="text-lg text-gray-600">Book celebration packages for traditional Indian festivals</p>
  </div>

  <?php
  // Fetch events in "Festivals" category
  $stmt = $con->prepare("SELECT event_id, name, description, price, event_date, category, event_image, location, highlights 
                         FROM events 
                         WHERE status='active' AND category='Festivals' 
                         ORDER BY event_date ASC");
  $stmt->execute();
  $res = $stmt->get_result();
  ?>

  <!-- Events Grid -->
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php while($e = $res->fetch_assoc()): ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
        
        <!-- Top Banner -->
        <div class="relative bg-gradient-to-r from-orange-500 to-yellow-500 h-40 flex items-center justify-center">
          <?php if(!empty($e['event_image'])): ?>
            <img src="../uploads/events/<?php echo htmlspecialchars($e['event_image']); ?>" 
                 class="h-24 w-24 object-contain drop-shadow-xl" alt="">
          <?php else: ?>
            <span class="text-6xl">🎪</span>
          <?php endif; ?>
          <span class="absolute top-3 right-3 bg-purple-600 text-white text-xs px-3 py-1 rounded-full">
            <?php echo htmlspecialchars($e['category']); ?>
          </span>
        </div>

        <!-- Content -->
        <div class="p-6">
          <div class="flex justify-between items-center mb-3">
            <h3 class="text-2xl font-bold text-gray-800"><?php echo htmlspecialchars($e['name']); ?></h3>
            <span class="bg-orange-500 text-white px-3 py-1 rounded-full font-semibold text-sm">
              ₹<?php echo number_format($e['price'],0); ?>
            </span>
          </div>
          <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars($e['description']); ?></p>
          
          <div class="space-y-2 text-sm text-gray-700 mb-5">
            <p>📅 <?php echo date("F j, Y", strtotime($e['event_date'])); ?></p>
            <?php if (!empty($e['location'])): ?>
              <p>📍 <?php echo htmlspecialchars($e['location']); ?></p>
            <?php endif; ?>
            <?php if (!empty($e['highlights'])): ?>
              <p>🎭 <?php echo htmlspecialchars($e['highlights']); ?></p>
            <?php endif; ?>
          </div>

          <!-- Book Button -->
          <a href="festival_booking.php?id=<?php echo (int)$e['event_id']; ?>"
             class="block text-center bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold py-3 rounded-xl hover:from-orange-600 hover:to-red-600 transition-all">
             🎟️ Book Tickets
          </a>
        </div>
      </div>
    <?php endwhile; $stmt->close(); ?>
  </div>
</div>

<?php include("../includes/footer.php"); ?>
</body>
</html>
