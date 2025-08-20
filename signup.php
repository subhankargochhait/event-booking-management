          
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
<body class="bg-gradient-to-br from-orange-50 to-yellow-50 min-h-screen"></body>

<!-- Sign Up Page -->
    <div id="signup" >
        <div class="min-h-screen flex items-center justify-center py-12 px-4">
            <div class="max-w-md w-full">
                <div class="text-center mb-8">
                    <div class="text-4xl mb-4">🎊</div>
                    <h2 class="text-3xl font-bold text-gray-900">Join Bharat Events</h2>
                    <p class="text-gray-600 mt-2">Create your account to book festival tickets</p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <form class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                          <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                      
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-orange-600">
                                <span class="ml-2 text-sm text-gray-600">I agree to the Terms of Service and Privacy Policy</span>
                            </label>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 px-6 rounded-xl font-medium hover:from-orange-600 hover:to-red-600 transition-all">
                            Create Account
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Already have an account? 
                            <a href="login.php"><button onclick="showPage('login')" class="text-orange-600 hover:text-orange-700 font-medium">Sign in</button></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="assets/js/app.js"></script>
</body>
</html>
