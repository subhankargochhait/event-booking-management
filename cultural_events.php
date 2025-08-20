
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
    <!-- Cultural Events Page -->
    <div id="cultural">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Cultural Events</h1>
                <p class="text-xl text-gray-600">Experience India's diverse cultural performances and traditions</p>
                <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                        <span class="text-6xl">🎭</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Classical Dance Performance</h3>
                        <p class="text-gray-600 mb-4">Bharatanatyam, Kathak, and Odissi performances</p>
                        <div class="text-orange-600 font-bold">₹399</div>
                    </div>
                </div>

                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center">
                        <span class="text-6xl">🎵</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Indian Classical Music</h3>
                        <p class="text-gray-600 mb-4">Hindustani and Carnatic music concerts</p>
                        <div class="text-orange-600 font-bold">₹299</div>
                    </div>
                </div>

                <div class="festival-card rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-teal-500 flex items-center justify-center">
                        <span class="text-6xl">🎨</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Art & Craft Workshop</h3>
                        <p class="text-gray-600 mb-4">Traditional Indian arts and handicrafts</p>
                        <div class="text-orange-600 font-bold">₹199</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
<script src="assets/js/app.js"></script>
</body>
</html>
