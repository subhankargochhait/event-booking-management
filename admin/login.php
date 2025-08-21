<?php
session_start();
include("../config/db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $access_code = trim($_POST["access_code"]);

    // Use prepared statement (more secure than direct query)
    $stmt = $con->prepare("SELECT * FROM admin WHERE email = ? AND access_code = ?");
    $stmt->bind_param("ss", $email, $access_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // If you are using password_hash() while inserting admin
        // if (password_verify($password, $row["password"])) {
        
        if ($password === $row["password"]) {  // plain text password check
            $_SESSION["admin_name"] = $row["name"];
            $_SESSION["admin_email"] = $row["email"];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "❌ Invalid password!";
        }
    } else {
        $error = "❌ Invalid email or access code!";
    }

    $stmt->close();
}
?>


             
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
   
   <!-- Admin Login Page -->
    <div id="admin" >
        <div class="min-h-screen flex items-center justify-center py-12 px-4">
            <div class="max-w-md w-full">
                <div class="text-center mb-8">
                    <div class="text-4xl mb-4">👑</div>
                    <h2 class="text-3xl font-bold text-gray-900">Admin Portal</h2>
                    <p class="text-gray-600 mt-2">Administrative access to Bharat Events</p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-purple-200">
                    <form class="space-y-6" action="" method="POST">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Admin Email</label>
                            <input type="email" name="email" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Admin Password</label>
                            <input type="password" name="password"  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Access Code</label>
                            <input type="text" name="access_code" placeholder="Enter admin access code" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white py-3 px-6 rounded-xl font-medium hover:from-purple-600 hover:to-indigo-600 transition-all">
                            Admin Login
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-sm">
                            🔒 Secure admin access only
                        </p>
                        <a href="../index.php"><button onclick="showPage('home')" class="text-purple-600 hover:text-purple-700 font-medium text-sm mt-2">
                            Back to Home
                        </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <script src="assets/js/app.js"></script>
</body>
</html>
