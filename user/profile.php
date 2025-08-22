<?php
session_start();
if (!isset($_SESSION["un"]) || !isset($_SESSION["un"])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

// Use session email (not name)
$email = $_SESSION["un"];

$sql = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
$result = mysqli_query($con, $sql);

$user = mysqli_fetch_assoc($result);

// If no user found, fallback to session values
if (!$user) {
    $user = [
        "name"    => $_SESSION["un"],
        "email"   => $_SESSION["un"],
        "phone"   => "",
        "address" => ""
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Header -->
  <?php include("../includes/user_header.php"); ?>

  <!-- Profile Section -->
  <section class="max-w-5xl mx-auto px-6 py-12">
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">👤 My Profile</h1>

      <!-- Profile Card -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div class="flex flex-col items-center">
          <div class="w-28 h-28 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white text-4xl font-bold">
           
          </div>
          <h2 class="mt-4 text-xl font-semibold text-gray-700">
            <?php echo htmlspecialchars($user["name"]); ?>
          </h2>
          <p class="text-gray-500 text-sm">
            <?php echo htmlspecialchars($user["email"]); ?>
          </p>
        </div>

        <div class="md:col-span-2">
          <h3 class="text-lg font-semibold text-gray-700 mb-4">Account Information</h3>
          <ul class="space-y-3">
            <li><span class="font-medium text-gray-600">📧 Email:</span> <?php echo htmlspecialchars($user["email"]); ?></li>
            <li><span class="font-medium text-gray-600">📱 Phone:</span> <?php echo htmlspecialchars($user["phone"]); ?></li>
            <li><span class="font-medium text-gray-600">🏠 Address:</span> <?php echo htmlspecialchars($user["address"]); ?></li>
          </ul>
        </div>
      </div>

      <!-- Update Form -->
      <h3 class="text-xl font-bold text-gray-800 mb-4">✏️ Edit Profile</h3>
      <form action="profile_update.php" method="POST" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-gray-600 font-medium mb-2">Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION["un"]); ?>" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-500">
          </div>
          <div>
            <label class="block text-gray-600 font-medium mb-2">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-500">
          </div>
          <div>
            <label class="block text-gray-600 font-medium mb-2">Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-500">
          </div>
          <div>
            <label class="block text-gray-600 font-medium mb-2">Address</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-500">
          </div>
        </div>
        <div>
          <label class="block text-gray-600 font-medium mb-2">Password</label>
          <input type="password" name="password" placeholder="Enter new password" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-500">
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl hover:from-orange-600 hover:to-red-600">
            💾 Save Changes
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <?php include("../includes/footer.php"); ?>

</body>
</html>
