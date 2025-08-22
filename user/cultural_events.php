<?php
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cultural Events</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; }
    .festival-card { transition: .3s; }
    .festival-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.1); }
  </style>
</head>
<body class="bg-gradient-to-br from-orange-50 to-yellow-50 min-h-screen">
<?php include("../includes/user_header.php"); ?>

<div class="container mx-auto px-4 py-8">
  <div class="text-center mb-12">
    <h1 class="text-5xl font-bold text-black mb-4">🎭 Cultural Events</h1>
    <p class="text-xl text-black opacity-90">Book celebration packages for cultural events</p>
  </div>

  <?php
  // Fetch only active events in category "Cultural Events"
  $stmt = $con->prepare("SELECT event_id, name, description, price, event_date, event_image 
                         FROM events 
                         WHERE status='active' AND category='Cultural Events' 
                         ORDER BY event_date ASC");
  $stmt->execute();
  $res = $stmt->get_result();
  ?>

  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    <?php if ($res->num_rows > 0): ?>
      <?php while($e = $res->fetch_assoc()): ?>
        <div class="festival-card bg-white rounded-2xl p-6 shadow-lg hover:bg-gray-50">
          <div class="w-full h-48 mb-4 overflow-hidden rounded-xl bg-gray-100">
            <?php if(!empty($e['event_image'])): ?>
              <img src="../uploads/events/<?php echo htmlspecialchars($e['event_image']); ?>" class="w-full h-48 object-cover" alt="">
            <?php endif; ?>
          </div>
          <h3 class="text-2xl font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($e['name']); ?></h3>
          <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars($e['description']); ?></p>
          <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-bold text-purple-600">₹<?php echo number_format($e['price'],2); ?></span>
            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
              <?php echo date("d M Y", strtotime($e['event_date'])); ?>
            </span>
          </div>

          <a href="cultural_booking.php?id=<?php echo (int)$e['event_id']; ?>"
             class="w-full block text-center bg-gradient-to-r from-purple-500 to-purple-700 text-white font-bold py-3 px-6 rounded-xl hover:from-purple-600 hover:to-purple-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
             🎟️ Book Now
          </a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-gray-600 col-span-3">No cultural events available at the moment.</p>
    <?php endif; ?>
    <?php $stmt->close(); ?>
  </div>
</div>

<?php include("../includes/footer.php"); ?>
</body>
</html>
