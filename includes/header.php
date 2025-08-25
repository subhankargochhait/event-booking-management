<!-- Header -->
<header class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center py-4">
      
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <div class="text-3xl">🪔</div>
        <div>
          <h1 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
            Bharat Events
          </h1>
          <p class="text-xs text-gray-600">Event Booking & Management</p>
        </div>
      </div>

      <!-- Desktop Nav -->
      <nav class="hidden md:flex space-x-8 items-center">
        <a href="index.php" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</a>
        <a href="all_events.php" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">All Events</a>
        <a href="upcoming.php" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Upcoming</a>
        
        <!-- Categories Dropdown -->
        <div class="relative">
          <button id="cat-btn" class="text-gray-700 hover:text-orange-600 font-medium flex items-center transition-colors">
            Categories ▼
          </button>
          <div id="cat-menu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-40">
            <a href="festival.php" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Festival</a>
            <a href="tech_events.php" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Tech</a>
            <a href="cultural_events.php" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600">Cultural</a>
          </div>
        </div>
        <a href="organize.php" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Organize</a>
      </nav>

      <!-- Desktop Buttons -->
      <div class="hidden md:flex items-center space-x-3">
        <a href="login.php" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Login</a>
        <a href="signup.php" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-full font-medium hover:from-orange-600 hover:to-red-600 transition-all">
          Sign Up
        </a>
        <a href="admin/login.php" class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-4 py-2 rounded-full font-medium hover:from-purple-600 hover:to-indigo-600 transition-all text-sm">
          Admin
        </a>
      </div>

      <!-- Mobile Hamburger -->
      <button id="menu-btn" class="md:hidden text-gray-700 text-3xl focus:outline-none">
        ☰
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-sm shadow-lg">
    <nav class="flex flex-col space-y-4 px-6 py-4">
      <a href="index.php" class="text-gray-700 hover:text-orange-600 font-medium">Home</a>
      <a href="all_events.php" class="text-gray-700 hover:text-orange-600 font-medium">All Events</a>
      <a href="upcoming_events.php" class="text-gray-700 hover:text-orange-600 font-medium">Upcoming</a>

      <!-- Mobile Dropdown -->
      <div>
        <button id="mobile-cat-btn" class="w-full text-left text-gray-700 font-medium flex justify-between items-center">
          Categories ▼
        </button>
        <div id="mobile-cat-menu" class="hidden pl-4 flex flex-col space-y-2">
          <a href="festival.php" class="text-gray-700 hover:text-orange-600">Festival</a>
          <a href="tech_events.php" class="text-gray-700 hover:text-orange-600">Tech</a>
          <a href="cultural_events.php" class="text-gray-700 hover:text-orange-600">Cultural</a>
        </div>
      </div>

      <a href="my_bookings.php" class="text-gray-700 hover:text-orange-600 font-medium">My Bookings</a>
      <a href="organize_event.php" class="text-gray-700 hover:text-orange-600 font-medium">Organize</a>
      <hr class="border-gray-300">
      <a href="login.php" class="text-gray-700 hover:text-orange-600 font-medium">Login</a>
      <a href="signup.php" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-full font-medium hover:from-orange-600 hover:to-red-600 transition-all text-center">
        Sign Up
      </a>
      <a href="admin/login.php" class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-4 py-2 rounded-full font-medium hover:from-purple-600 hover:to-indigo-600 transition-all text-sm text-center">
        Admin
      </a>
    </nav>
  </div>
</header>

<!-- Script -->
<script>
  // Mobile menu toggle
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  // Desktop category dropdown toggle
  const catBtn = document.getElementById('cat-btn');
  const catMenu = document.getElementById('cat-menu');
  catBtn.addEventListener('click', () => {
    catMenu.classList.toggle('hidden');
  });

  // Mobile category dropdown toggle
  const mobileCatBtn = document.getElementById('mobile-cat-btn');
  const mobileCatMenu = document.getElementById('mobile-cat-menu');
  mobileCatBtn.addEventListener('click', () => {
    mobileCatMenu.classList.toggle('hidden');
  });
</script>
