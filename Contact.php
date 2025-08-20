  
  
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
  <!-- Contact Page -->
    <div id="contact" >
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h1>
                <p class="text-xl text-gray-600">Get in touch for festival bookings and cultural event inquiries</p>
                <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea rows="5" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 px-6 rounded-xl font-medium hover:from-orange-600 hover:to-red-600 transition-all">
                            Send Message
                        </button>
                    </form>
                </div>

                <div class="space-y-8">
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white text-xl">📧</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Email</h4>
                                    <p class="text-gray-600">info@bharatevents.com</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white text-xl">📞</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Phone</h4>
                                    <p class="text-gray-600">+91 98765 43210</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white text-xl">📍</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Address</h4>
                                    <p class="text-gray-600">123 Cultural Street, New Delhi, India</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Office Hours</h3>
                        <div class="space-y-2 text-gray-600">
                            <p><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
                            <p><strong>Saturday:</strong> 10:00 AM - 4:00 PM</p>
                            <p><strong>Sunday:</strong> Closed</p>
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
