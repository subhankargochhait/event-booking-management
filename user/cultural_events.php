<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Events Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .festival-card { transition: all 0.3s ease; }
        .festival-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .booking-form { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 to-yellow-50 min-h-screen">
<?php include("../includes/user_header.php"); ?>

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-black mb-4">🎭 Cultural Events</h1>
            <p class="text-xl text-black opacity-90">Book your celebration packages for diverse cultural events and festivals</p>
        </div>

        <!-- Cultural Events Cards Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Music Festival -->
            <div class="festival-card bg-white rounded-2xl p-6 shadow-lg">
                <div class="text-6xl mb-4 text-center">🎵</div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Music Festival</h3>
                <p class="text-gray-600 mb-4">Multi-genre music celebration with live performances, sound systems, and stage setup</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-purple-600">₹3,500</span>
                    <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm">3 Days</span>
                </div>
                <button onclick="selectFestival('Music Festival', 3500)" class="w-full bg-gradient-to-r from-purple-500 to-purple-700 text-white font-bold py-3 px-6 rounded-xl hover:from-purple-600 hover:to-purple-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    🎵 Book Now
                </button>
            </div>

            <!-- Art Exhibition -->
            <div class="festival-card bg-white rounded-2xl p-6 shadow-lg">
                <div class="text-6xl mb-4 text-center">🎨</div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Art Exhibition</h3>
                <p class="text-gray-600 mb-4">Contemporary and traditional art showcase with gallery setup and artist interactions</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-pink-600">₹2,200</span>
                    <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full text-sm">7 Days</span>
                </div>
                <button onclick="selectFestival('Art Exhibition', 2200)" class="w-full bg-gradient-to-r from-pink-500 to-pink-700 text-white font-bold py-3 px-6 rounded-xl hover:from-pink-600 hover:to-pink-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    🎨 Book Now
                </button>
            </div>

            <!-- Dance Performance -->
            <div class="festival-card bg-white rounded-2xl p-6 shadow-lg">
                <div class="text-6xl mb-4 text-center">💃</div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Dance Performance</h3>
                <p class="text-gray-600 mb-4">Classical and folk dance performances with professional choreography and costumes</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-orange-600">₹2,800</span>
                    <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm">1 Day</span>
                </div>
                <button onclick="selectFestival('Dance Performance', 2800)" class="w-full bg-gradient-to-r from-orange-500 to-orange-700 text-white font-bold py-3 px-6 rounded-xl hover:from-orange-600 hover:to-orange-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    💃 Book Now
                </button>
            </div>

            <!-- Food Festival -->
            <div class="festival-card bg-white rounded-2xl p-6 shadow-lg">
                <div class="text-6xl mb-4 text-center">🍽️</div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Food Festival</h3>
                <p class="text-gray-600 mb-4">Culinary celebration featuring diverse cuisines, cooking demos, and tasting sessions</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-green-600">₹4,200</span>
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">5 Days</span>
                </div>
                <button onclick="selectFestival('Food Festival', 4200)" class="w-full bg-gradient-to-r from-green-500 to-green-700 text-white font-bold py-3 px-6 rounded-xl hover:from-green-600 hover:to-green-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    🍽️ Book Now
                </button>
            </div>

            <!-- Theater Festival -->
            <div class="festival-card bg-white rounded-2xl p-6 shadow-lg">
                <div class="text-6xl mb-4 text-center">🎭</div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Theater Festival</h3>
                <p class="text-gray-600 mb-4">Drama and theatrical performances with professional stage setup and lighting</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-red-600">₹3,000</span>
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">4 Days</span>
                </div>
                <button onclick="selectFestival('Theater Festival', 3000)" class="w-full bg-gradient-to-r from-red-500 to-red-700 text-white font-bold py-3 px-6 rounded-xl hover:from-red-600 hover:to-red-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    🎭 Book Now
                </button>
            </div>

            <!-- Cultural Heritage -->
            <div class="festival-card bg-white rounded-2xl p-6 shadow-lg">
                <div class="text-6xl mb-4 text-center">🏛️</div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Cultural Heritage</h3>
                <p class="text-gray-600 mb-4">Traditional crafts, storytelling, and heritage preservation activities</p>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold text-blue-600">₹2,600</span>
                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">6 Days</span>
                </div>
                <button onclick="selectFestival('Cultural Heritage', 2600)" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold py-3 px-6 rounded-xl hover:from-blue-600 hover:to-blue-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    🏛️ Book Now
                </button>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="booking-form max-w-2xl mx-auto rounded-2xl p-8 shadow-2xl">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Book Your Cultural Event</h2>
            
            <form id="bookingForm" onsubmit="submitBooking(event)">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Full Name *</label>
                        <input type="text" id="fullName" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Phone Number *</label>
                        <input type="tel" id="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Email Address *</label>
                    <input type="email" id="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Selected Event</label>
                        <input type="text" id="selectedFestival" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Number of Guests</label>
                        <select id="guests" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" onchange="calculateTotal()">
                            <option value="1">1-10 people</option>
                            <option value="2">11-25 people</option>
                            <option value="3">26-50 people</option>
                            <option value="4">51-100 people</option>
                            <option value="5">100+ people</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Event Date</label>
                    <input type="date" id="eventDate" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Special Requirements</label>
                    <textarea id="requirements" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Any special arrangements, dietary requirements, or additional services..."></textarea>
                </div>

                <div class="bg-purple-50 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center text-lg">
                        <span class="font-medium text-gray-700">Base Package:</span>
                        <span id="basePrice" class="font-bold text-purple-600">₹0</span>
                    </div>
                    <div class="flex justify-between items-center text-lg mt-2">
                        <span class="font-medium text-gray-700">Guest Multiplier:</span>
                        <span id="multiplier" class="font-bold text-purple-600">x1</span>
                    </div>
                    <hr class="my-3 border-purple-200">
                    <div class="flex justify-between items-center text-xl">
                        <span class="font-bold text-gray-800">Total Amount:</span>
                        <span id="totalPrice" class="font-bold text-purple-600 text-2xl">₹0</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-4 px-8 rounded-lg hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    🎭 Book Cultural Event
                </button>
            </form>
        </div>

        <!-- Success Message -->
        <div id="successMessage" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-md mx-4 text-center">
                <div class="text-6xl mb-4">🎉</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Booking Confirmed!</h3>
                <p class="text-gray-600 mb-6">Thank you for booking with us! We'll contact you within 24 hours to confirm all details.</p>
                <button onclick="closeSuccess()" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
        <?php include("../includes/footer.php"); ?>

</body>
</html>
