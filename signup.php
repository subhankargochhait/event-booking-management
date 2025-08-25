<?php
session_start();
include("config/db.php");

$error = "";
$success = "";

if (isset($_POST['signup'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password= trim($_POST['password'] ?? '');
    $cpassword = trim($_POST['cpassword'] ?? '');

    if (!$name || !$email || !$phone || !$address || !$password || !$cpassword) {
        $error = "All fields are required!";
    } elseif ($password !== $cpassword) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $con->prepare("SELECT uid FROM user WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO user (name,email,phone,address,password) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss", $name, $email, $phone, $address, $hashed_password);
            if ($stmt->execute()) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Error registering user: " . $stmt->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up - Bharat Events</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center">

<div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl">
    <h2 class="text-2xl font-bold mb-4 text-center">Sign Up</h2>

    <?php if($error): ?>
        <p class="text-red-600 mb-4"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if($success): ?>
        <p class="text-green-600 mb-4"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <input type="text" name="name" placeholder="Full Name" required class="w-full border rounded-xl px-4 py-2">
        <input type="email" name="email" placeholder="Email" required class="w-full border rounded-xl px-4 py-2">
        <input type="text" name="phone" placeholder="Phone" required class="w-full border rounded-xl px-4 py-2">
        <input type="text" name="address" placeholder="Address" required class="w-full border rounded-xl px-4 py-2">
        <input type="password" name="password" placeholder="Password" required class="w-full border rounded-xl px-4 py-2">
        <input type="password" name="cpassword" placeholder="Confirm Password" required class="w-full border rounded-xl px-4 py-2">
        <button type="submit" name="signup" class="w-full bg-orange-500 text-white py-3 rounded-xl hover:bg-orange-600">Sign Up</button>
    </form>
    <p class="mt-4 text-center text-gray-600">Already have an account? <a href="login.php" class="text-orange-600">Login</a></p>
</div>
</body>
</html>
