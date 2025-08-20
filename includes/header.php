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
          <p class="text-xs text-gray-600">भारतीय त्योहार</p>
        </div>
      </div>

      <!-- Desktop Nav -->
      <nav class="hidden md:flex space-x-8">
        <a href="index.php" class="nav-link text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</a>
        <a href="festival.php" class="nav-link text-gray-700 hover:text-orange-600 font-medium transition-colors">Festivals</a>
        <a href="cultural_events.php" class="nav-link text-gray-700 hover:text-orange-600 font-medium transition-colors">Cultural Events</a>
        <a href="about.php" class="nav-link text-gray-700 hover:text-orange-600 font-medium transition-colors">About</a>
        <a href="contact.php" class="nav-link text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</a>
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
      <a href="festival.php" class="text-gray-700 hover:text-orange-600 font-medium">Festivals</a>
      <a href="cultural_events.php" class="text-gray-700 hover:text-orange-600 font-medium">Cultural Events</a>
      <a href="about.php" class="text-gray-700 hover:text-orange-600 font-medium">About</a>
      <a href="contact.php" class="text-gray-700 hover:text-orange-600 font-medium">Contact</a>
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

<!-- Mobile Menu Script -->
<script>
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
