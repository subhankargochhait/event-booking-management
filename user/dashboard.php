
<?php
session_start();
if (!isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}
$username = htmlspecialchars($_SESSION["un"]);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { 
      font-family: 'Poppins', sans-serif; 
      background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 25%, #4ecdc4 50%, #45b7d1 75%, #96ceb4 100%);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      min-height: 100vh;
    }
    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .indian-pattern {
      background-image: 
        radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 2px, transparent 2px),
        radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 2px, transparent 2px),
        linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.05) 50%, transparent 60%);
      background-size: 50px 50px, 50px 50px, 100px 100px;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }
    .festival-glow {
      box-shadow: 0 0 30px rgba(255, 154, 86, 0.4), 0 0 60px rgba(255, 107, 107, 0.2);
    }
    .hover-lift {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .hover-lift:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    }
    .mandala-bg {
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3Ccircle cx='30' cy='30' r='8'/%3E%3Ccircle cx='30' cy='30' r='14'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .gradient-text {
      background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .pulse-glow {
      animation: pulseGlow 2s ease-in-out infinite alternate;
    }
    @keyframes pulseGlow {
      from { box-shadow: 0 0 20px rgba(255, 154, 86, 0.5); }
      to { box-shadow: 0 0 40px rgba(255, 154, 86, 0.8), 0 0 60px rgba(255, 107, 107, 0.4); }
    }
  </style>
</head>
<body class="indian-pattern mandala-bg">

  <!-- Header -->
  <?php include("../includes/user_header.php"); ?>

  <!-- Welcome Banner -->
  <div class="max-w-7xl mx-auto px-6 pt-8">
    <div class="glass-card rounded-3xl p-8 mb-8 festival-glow text-center">
      <h1 class="text-3xl md:text-3xl font-bold text-black mb-4">
        🙏 Welcome, <?php echo $username; ?>! 🎉
      </h1>
      <p class="text-xl text-black opacity-90">Experience the magic of Indian festivals and cultural celebrations</p>
      <div class="flex justify-center mt-6 space-x-4">
        <span class="text-3xl animate-bounce">🪔</span>
        <span class="text-3xl animate-bounce" style="animation-delay: 0.1s">🎨</span>
        <span class="text-3xl animate-bounce" style="animation-delay: 0.2s">💃</span>
        <span class="text-3xl animate-bounce" style="animation-delay: 0.3s">🎭</span>
        <span class="text-3xl animate-bounce" style="animation-delay: 0.4s">🎵</span>
      </div>
    </div>
  </div>

  <!-- Dashboard Content -->
  <main class="max-w-7xl mx-auto px-6 pb-12">
    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
      <div class="glass-card rounded-3xl p-8 text-center hover-lift pulse-glow">
        <div class="text-5xl mb-4">🎪</div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Upcoming Events</h3>
        <p class="text-4xl font-bold text-orange-600 mt-4">3</p>
        <div class="mt-4 bg-gradient-to-r from-orange-400 to-pink-400 h-2 rounded-full"></div>
      </div>
      <div class="glass-card rounded-3xl p-8 text-center hover-lift pulse-glow" style="animation-delay: 0.2s">
        <div class="text-5xl mb-4">🎟️</div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Tickets Booked</h3>
        <p class="text-4xl font-bold text-green-600 mt-4">5</p>
        <div class="mt-4 bg-gradient-to-r from-green-400 to-blue-400 h-2 rounded-full"></div>
      </div>
      <div class="glass-card rounded-3xl p-8 text-center hover-lift pulse-glow" style="animation-delay: 0.4s">
        <div class="text-5xl mb-4">🔔</div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Notifications</h3>
        <p class="text-4xl font-bold text-blue-600 mt-4">2</p>
        <div class="mt-4 bg-gradient-to-r from-blue-400 to-purple-400 h-2 rounded-full"></div>
      </div>
    </div>

    <!-- My Bookings -->
    <div class="glass-card rounded-3xl p-8 festival-glow">
      <div class="flex items-center mb-8">
        <span class="text-4xl mr-4">🎟</span>
        <h2 class="text-3xl font-bold text-gray-800">My Festival Bookings</h2>
      </div>
      
      <div class="space-y-6">
        <!-- Booking 1 -->
        <div class="glass-card rounded-2xl p-6 hover-lift border-l-4 border-orange-400">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 text-center md:text-left">
              <div class="text-4xl">🪔</div>
              <div>
                <h4 class="text-xl font-bold text-gray-800">Durga Puja Celebration</h4>
                <p class="text-gray-700 font-medium">📅 Date: Oct 10, 2025</p>
                <p class="text-gray-600 text-sm">🎭 Traditional Dance & Music</p>
              </div>
            </div>
            <button class="mt-4 md:mt-0 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold px-6 py-3 rounded-2xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
              🎫 View Ticket
            </button>
          </div>
        </div>

        <!-- Booking 2 -->
        <div class="glass-card rounded-2xl p-6 hover-lift border-l-4 border-yellow-400">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 text-center md:text-left">
              <div class="text-4xl">✨</div>
              <div>
                <h4 class="text-xl font-bold text-gray-800">Diwali Night Festival</h4>
                <p class="text-gray-700 font-medium">📅 Date: Nov 2, 2025</p>
                <p class="text-gray-600 text-sm">🎆 Fireworks & Light Show</p>
              </div>
            </div>
            <button class="mt-4 md:mt-0 bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-bold px-6 py-3 rounded-2xl hover:from-yellow-600 hover:to-orange-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
              🎫 View Ticket
            </button>
          </div>
        </div>

        <!-- Booking 3 -->
        <div class="glass-card rounded-2xl p-6 hover-lift border-l-4 border-green-400">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 text-center md:text-left">
              <div class="text-4xl">🌾</div>
              <div>
                <h4 class="text-xl font-bold text-gray-800">Baisakhi Mela</h4>
                <p class="text-gray-700 font-medium">📅 Date: Apr 14, 2026</p>
                <p class="text-gray-600 text-sm">🎪 Cultural Fair & Food Stalls</p>
              </div>
            </div>
            <button class="mt-4 md:mt-0 bg-gradient-to-r from-green-500 to-teal-500 text-white font-bold px-6 py-3 rounded-2xl hover:from-green-600 hover:to-teal-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
              🎫 View Ticket
            </button>
          </div>
        </div>
      </div>

    
    </div>

   
  </main>

  <!-- Footer -->
  <?php include("../includes/footer.php"); ?>

<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'972947868600473d',t:'MTc1NTc3MDM4NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
