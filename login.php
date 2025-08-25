<?php
session_start();
include("config/db.php");

$error = "";

if (isset($_POST["login"])) {
    $email    = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (!$email || !$password) {
        $error = "Please enter both email and password!";
    } else {
        $stmt = $con->prepare("SELECT * FROM user WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // ✅ store user info in session
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['un'] = $user['email'];
            $_SESSION['full_name'] = $user['name'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['address'] = $user['address'];

            header("Location: user/dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - Bharat Events</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center">

<div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl">
    <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

    <?php if($error): ?>
        <p class="text-red-600 mb-4"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <input type="email" name="email" placeholder="Email" required class="w-full border rounded-xl px-4 py-2">
        <input type="password" name="password" placeholder="Password" required class="w-full border rounded-xl px-4 py-2">
        <button type="submit" name="login" class="w-full bg-orange-500 text-white py-3 rounded-xl hover:bg-orange-600">Login</button>
    </form>

    <p class="mt-4 text-center text-gray-600">Don't have an account? <a href="signup.php" class="text-orange-600">Sign Up</a></p>
</div>
</body>
</html>
