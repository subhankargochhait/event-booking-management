  
  
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

 <!-- Calendar Page -->
    <div id="calendar">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Event Calendar</h1>
                <p class="text-gray-600">Browse events by date and discover what's happening</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Calendar -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-900" id="calendarMonth">March 2024</h2>
                            <div class="flex space-x-2">
                                <button onclick="previousMonth()" class="p-2 hover:bg-gray-100 rounded-md">←</button>
                                <button onclick="nextMonth()" class="p-2 hover:bg-gray-100 rounded-md">→</button>
                            </div>
                        </div>
                        <div id="eventCalendar" class="calendar-grid text-center">
                            <!-- Calendar will be generated here -->
                        </div>
                    </div>
                </div>

                <!-- Selected Date Events -->
                <div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4" id="selectedDate">Today's Events</h3>
                        <div id="dateEvents" class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 mb-1">Tech Conference</h4>
                                <p class="text-sm text-gray-600 mb-2">9:00 AM - 5:00 PM</p>
                                <p class="text-sm text-gray-600">Convention Center</p>
                                <button onclick="viewEventDetails('tech-conf')" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium mt-2">View Details</button>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 mb-1">Art Workshop</h4>
                                <p class="text-sm text-gray-600 mb-2">2:00 PM - 6:00 PM</p>
                                <p class="text-sm text-gray-600">Art Studio Downtown</p>
                                <button onclick="viewEventDetails('art-workshop')" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium mt-2">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php include("includes/footer.php"); ?>
<script src="assets/js/app.js"></script>
</body>
</html>
