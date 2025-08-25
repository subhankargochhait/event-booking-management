<?php
// Start Session
session_start();

// Check if user is logged in
if (!isset($_SESSION['un'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bharat Events - Indian Festivals & Cultural Celebrations</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
    
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
   
        .diya-glow {
            box-shadow: 0 0 20px rgba(255, 165, 0, 0.6);
        }
        
        .festival-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(255, 107, 53, 0.1);
        }
        
        .price-tag {
            background: linear-gradient(45deg, #ff6b35, #f7931e);
        }
        
        .cultural-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 to-yellow-50 min-h-screen">

<?php include("../includes/user_header.php"); ?>

    <!-- Main Content Container -->
    <div id="home" class="page">
   <!-- Hero Section -->
    <section class="hero-gradient text-white min-h-screen flex items-center indian-pattern relative">
        <!-- Floating Elements -->
        <div class="floating-elements">
            <div class="floating-element text-4xl" style="left: 10%; animation-delay: 0s;">🪔</div>
            <div class="floating-element text-3xl" style="left: 20%; animation-delay: 2s;">🎊</div>
            <div class="floating-element text-4xl" style="left: 80%; animation-delay: 4s;">🌺</div>
            <div class="floating-element text-3xl" style="left: 70%; animation-delay: 6s;">🎭</div>
            <div class="floating-element text-4xl" style="left: 30%; animation-delay: 8s;">🕉️</div>
            <div class="floating-element text-3xl" style="left: 90%; animation-delay: 10s;">🪷</div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 text-center relative z-10 py-20">
            <!-- Festival Icons -->
            <div class="mb-8 fade-in">
                <div class="flex justify-center space-x-4 mb-6">
                    <span class="festival-emoji">🎊</span>
                    <span class="festival-emoji" style="animation-delay: 0.2s;">🪔</span>
                    <span class="festival-emoji" style="animation-delay: 0.4s;">🌺</span>
                </div>
            </div>
            
            <!-- Main Heading -->
         <div class="mb-12">
  <h1 class="title-text text-6xl md:text-7xl lg:text-8xl font-bold mb-6 fade-in delay-1">
    <span class="text-white">
      Celebrate India's
    </span>
    <br>
    <span class="bg-gradient-to-r from-orange-500 to-red-600 bg-clip-text text-transparent">
      Rich Heritage
    </span>
  </h1>
  
  <p class="subtitle-text text-2xl md:text-3xl mb-8 fade-in delay-2 max-w-4xl mx-auto leading-relaxed text-white/90">
    Experience authentic Indian festivals, cultural events, and traditional celebrations that bring communities together
  </p>
  
  <p class="mb-8 fade-in delay-2 max-w-4xl mx-auto leading-relaxed text-white/90">
    त्योहारों का जश्न मनाएं • संस्कृति को जीवित रखें • परंपराओं का सम्मान करें
  </p>
</div>

        </div>
    </section>
     

    <!-- Featured Festivals -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Indian Festivals</h2>
                <p class="text-xl text-gray-600">Immerse yourself in India's vibrant cultural celebrations</p>
                <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Diwali Event -->
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-56 bg-gradient-to-br from-yellow-400 via-orange-500 to-red-600 flex items-center justify-center relative">
                        <span class="text-8xl diya-glow">🪔</span>
                        <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Popular
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Diwali Celebration</h3>
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">
                                ₹299
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Festival of Lights with traditional diyas, rangoli, fireworks, and authentic Indian sweets</p>
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <span class="mr-3 text-orange-500">📅</span>
                                <span>November 12, 2024 • 6:00 PM - 11:00 PM</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-orange-500">📍</span>
                                <span>Cultural Center, Delhi</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-orange-500">🎭</span>
                                <span>Traditional dance, music & food</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-3 px-4 rounded-xl font-medium transition-all">
                            Book Tickets
                        </button>
                    </div>
                </div>

                <!-- Holi Event -->
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-56 bg-gradient-to-br from-pink-400 via-purple-500 to-blue-600 flex items-center justify-center relative">
                        <span class="text-8xl">🎨</span>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Trending
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Holi Festival</h3>
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">
                                ₹199
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Festival of Colors with organic gulal, traditional music, dance, and delicious thandai</p>
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <span class="mr-3 text-pink-500">📅</span>
                                <span>March 14, 2025 • 10:00 AM - 4:00 PM</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-pink-500">📍</span>
                                <span>Vrindavan Gardens, Mathura</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-pink-500">🌈</span>
                                <span>Organic colors & traditional sweets</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white py-3 px-4 rounded-xl font-medium transition-all">
                            Book Tickets
                        </button>
                    </div>
                </div>

                <!-- Navratri Event -->
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-56 bg-gradient-to-br from-red-500 via-yellow-500 to-green-600 flex items-center justify-center relative">
                        <span class="text-8xl">💃</span>
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            9 Days
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Navratri Garba</h3>
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">
                                ₹499
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">9 nights of traditional Garba and Dandiya dance with live music and authentic Gujarati cuisine</p>
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <span class="mr-3 text-red-500">📅</span>
                                <span>October 3-11, 2024 • 7:00 PM - 12:00 AM</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-red-500">📍</span>
                                <span>GMDC Ground, Ahmedabad</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-red-500">🥁</span>
                                <span>Live dhol, traditional costumes</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-red-500 to-yellow-500 hover:from-red-600 hover:to-yellow-600 text-white py-3 px-4 rounded-xl font-medium transition-all">
                            Book Tickets
                        </button>
                    </div>
                </div>

                <!-- Durga Puja Event -->
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-56 bg-gradient-to-br from-red-600 via-orange-500 to-yellow-400 flex items-center justify-center relative">
                        <span class="text-8xl">🛕</span>
                        <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Cultural
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Durga Puja</h3>
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">
                                ₹149
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Traditional Bengali celebration with beautiful pandals, cultural programs, and authentic Bengali food</p>
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <span class="mr-3 text-red-600">📅</span>
                                <span>October 9-13, 2024 • All Day</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-red-600">📍</span>
                                <span>Pandal Park, Kolkata</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-red-600">🎪</span>
                                <span>Pandal hopping, cultural shows</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white py-3 px-4 rounded-xl font-medium transition-all">
                            Book Tickets
                        </button>
                    </div>
                </div>

                <!-- Karva Chauth Event -->
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-56 bg-gradient-to-br from-pink-500 via-red-500 to-orange-500 flex items-center justify-center relative">
                        <span class="text-8xl">🌙</span>
                        <div class="absolute top-4 right-4 bg-pink-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Special
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Karva Chauth</h3>
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">
                                ₹399
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Traditional celebration for married women with mehendi, sargi, and moonrise ceremony</p>
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <span class="mr-3 text-pink-500">📅</span>
                                <span>November 1, 2024 • 4:00 PM - 9:00 PM</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-pink-500">📍</span>
                                <span>Heritage Hotel, Jaipur</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-pink-500">✨</span>
                                <span>Mehendi, traditional attire, gifts</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white py-3 px-4 rounded-xl font-medium transition-all">
                            Book Tickets
                        </button>
                    </div>
                </div>

                <!-- Onam Event -->
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-56 bg-gradient-to-br from-green-500 via-yellow-400 to-orange-500 flex items-center justify-center relative">
                        <span class="text-8xl">🌺</span>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Kerala
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Onam Festival</h3>
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-bold">
                                ₹349
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Kerala's harvest festival with Pookalam, Kathakali dance, boat races, and traditional Sadhya feast</p>
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <span class="mr-3 text-green-500">📅</span>
                                <span>September 15, 2024 • 11:00 AM - 8:00 PM</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-green-500">📍</span>
                                <span>Backwaters Resort, Kochi</span>
                            </div>
                            <div class="flex items-center">
                                <span class="mr-3 text-green-500">🛶</span>
                                <span>Boat race, Kathakali, Sadhya</span>
                            </div>
                        </div>
                        <button class="w-full bg-gradient-to-r from-green-500 to-yellow-500 hover:from-green-600 hover:to-yellow-600 text-white py-3 px-4 rounded-xl font-medium transition-all">
                            Book Tickets
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cultural Categories -->
    <section class="py-20 bg-gradient-to-br from-red-600 via-orange-500 to-yellow-400">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Explore by Category</h2>
                <p class="text-xl text-white/80">Discover India's diverse cultural celebrations</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all cursor-pointer">
                    <div class="text-5xl mb-4">🕉️</div>
                    <h3 class="font-semibold text-white">Religious</h3>
                    <p class="text-white/70 text-sm mt-1">Sacred celebrations</p>
                </div>
                <div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all cursor-pointer">
                    <div class="text-5xl mb-4">🌾</div>
                    <h3 class="font-semibold text-white">Harvest</h3>
                    <p class="text-white/70 text-sm mt-1">Seasonal festivals</p>
                </div>
                <div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all cursor-pointer">
                    <div class="text-5xl mb-4">💃</div>
                    <h3 class="font-semibold text-white">Dance</h3>
                    <p class="text-white/70 text-sm mt-1">Classical & folk</p>
                </div>
                <div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all cursor-pointer">
                    <div class="text-5xl mb-4">🎵</div>
                    <h3 class="font-semibold text-white">Music</h3>
                    <p class="text-white/70 text-sm mt-1">Traditional concerts</p>
                </div>
                <div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all cursor-pointer">
                    <div class="text-5xl mb-4">🍛</div>
                    <h3 class="font-semibold text-white">Food</h3>
                    <p class="text-white/70 text-sm mt-1">Culinary experiences</p>
                </div>
                <div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all cursor-pointer">
                    <div class="text-5xl mb-4">🎪</div>
                    <h3 class="font-semibold text-white">Regional</h3>
                    <p class="text-white/70 text-sm mt-1">State festivals</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What People Say</h2>
                <p class="text-xl text-gray-600">Experiences from our festival community</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-orange-50 to-red-50 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                            P
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Priya Sharma</h4>
                            <p class="text-gray-600 text-sm">Delhi</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"The Diwali celebration was absolutely magical! Authentic decorations, delicious food, and such a warm community feeling. Felt like celebrating at home!"</p>
                    <div class="flex text-yellow-400 mt-4">
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>
                <div class="bg-gradient-to-br from-pink-50 to-purple-50 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            R
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Rajesh Kumar</h4>
                            <p class="text-gray-600 text-sm">Mumbai</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Holi celebration was incredible! Organic colors, traditional music, and the best thandai I've ever had. My kids loved every moment of it!"</p>
                    <div class="flex text-yellow-400 mt-4">
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-blue-50 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Anita Patel</h4>
                            <p class="text-gray-600 text-sm">Ahmedabad</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Navratri Garba nights were phenomenal! Live dhol, beautiful costumes, and such energetic dancing. Best 9 nights of the year!"</p>
                    <div class="flex text-yellow-400 mt-4">
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

<?php include("../includes/footer.php"); ?>
<!-- <script src="assets/js/app.js"></script> -->
</body>
</html>
