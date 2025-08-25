<?php

include("config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech Events</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Poppins', sans-serif; }
    .festival-card { transition: .3s; }
    .festival-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.1); }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
<?php include("includes/header.php"); ?>

<div class="container mx-auto px-4 py-8">
  <div class="text-center mb-12">
    <h1 class="text-5xl font-bold text-black mb-4">💻 Tech Events</h1>
    <p class="text-xl text-black opacity-90">Discover technology, innovation, and startup events</p>
  </div>

  <?php
  // Fetch only Tech active events
  $stmt = $con->prepare("SELECT event_id, name, description, price, event_date, start_time, end_time, 
                                location, highlights, category, event_image 
                         FROM events 
                         WHERE status='active' AND category='Tech'
                         ORDER BY event_date ASC");
  $stmt->execute();
  $res = $stmt->get_result();
  ?>

  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    <?php if ($res->num_rows > 0): ?>
      <?php while($e = $res->fetch_assoc()): ?>
        <div class="festival-card bg-white rounded-2xl p-6 shadow-lg hover:bg-gray-50">

          <!-- Top Image -->
          <div class="w-full h-48 mb-4 overflow-hidden rounded-xl bg-gray-100 relative">
            <?php if(!empty($e['event_image'])): ?>
              <img src="uploads/events/<?php echo htmlspecialchars($e['event_image']); ?>" 
                   class="w-full h-48 object-cover" alt="">
            <?php else: ?>
              <span class="absolute inset-0 flex items-center justify-center text-6xl">💻</span>
            <?php endif; ?>
            <span class="absolute top-3 right-3 bg-blue-600 text-white text-xs px-3 py-1 rounded-full">
              <?php echo htmlspecialchars($e['category']); ?>
            </span>
          </div>

          <!-- Event Content -->
          <h3 class="text-2xl font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($e['name']); ?></h3>
          <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars($e['description']); ?></p>
          
          <!-- Event Details -->
          <div class="space-y-2 text-sm text-gray-700 mb-5">
            <p>📅 <?php echo date("F j, Y", strtotime($e['event_date'])); ?></p>
            <p>⏰ 
              <?php 
                if (!empty($e['start_time']) && !empty($e['end_time'])) {
                    echo date("g:i A", strtotime($e['start_time'])) . " - " . date("g:i A", strtotime($e['end_time']));
                } else {
                    echo "All Day";
                }
              ?>
            </p>
            <p>📍 <?php echo htmlspecialchars($e['location']); ?></p>
            <p>✨ <?php echo htmlspecialchars($e['highlights']); ?></p>
          </div>

          <!-- Price & Button -->
          <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-bold text-blue-600">₹<?php echo number_format($e['price'],2); ?></span>
          </div>

          <a href="login.php?id=<?php echo (int)$e['event_id']; ?>"
             class="w-full block text-center bg-gradient-to-r from-blue-500 to-indigo-700 text-white font-bold py-3 px-6 rounded-xl hover:from-blue-600 hover:to-indigo-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
             🎟️ Book Now
          </a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-gray-600 col-span-3">No tech events available right now.</p>
    <?php endif; ?>
    <?php $stmt->close(); ?>
  </div>
</div>

<?php include("includes/footer.php"); ?>
</body>
</html>
