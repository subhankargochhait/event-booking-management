      
  
       <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bharat Events - Indian Festivals & Cultural Celebrations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 25%, #ffd23f 50%, #06d6a0 75%, #118ab2 100%);
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
        
        .indian-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, #ffd23f 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, #ff6b35 2px, transparent 2px);
            background-size: 50px 50px;
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

<?php include("includes/header.php"); ?>
    <!-- About Page -->
    <div id="about">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">About Bharat Events</h1>
                <p class="text-xl text-gray-600">Preserving and celebrating India's rich cultural heritage</p>
                <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                    <p class="text-gray-600 mb-6">
                        At Bharat Events, we are dedicated to preserving and celebrating India's incredible cultural diversity. 
                        Our mission is to bring authentic Indian festivals and cultural events to communities worldwide, 
                        ensuring that our rich traditions continue to thrive for future generations.
                    </p>
                    <p class="text-gray-600 mb-6">
                        We believe that festivals are not just celebrations, but powerful ways to connect people, 
                        share stories, and build bridges between different communities. Through our carefully curated events, 
                        we aim to create meaningful experiences that honor our heritage while embracing modern sensibilities.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-orange-100 to-red-100 p-8 rounded-2xl">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🇮🇳</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Celebrating Unity in Diversity</h3>
                        <p class="text-gray-600">
                            From the colorful Holi celebrations to the spiritual Diwali festivities, 
                            we bring you authentic experiences that showcase the beauty of Indian culture.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🎪</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">500+ Events</h3>
                    <p class="text-gray-600">Successfully organized cultural celebrations across India</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">👥</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">100K+ Participants</h3>
                    <p class="text-gray-600">People have joined our festivals and cultural events</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">50+ Awards</h3>
                    <p class="text-gray-600">Recognition for promoting Indian culture and heritage</p>
                </div>
            </div>
        </div>
    </div>
            <?php include("includes/footer.php"); ?>
<script src="assets/js/app.js"></script>
</body>
</html>