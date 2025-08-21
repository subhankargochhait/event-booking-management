<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bharat Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-gradient-to-b from-purple-600 to-indigo-700 text-white flex flex-col">
            <div class="p-6 text-center border-b border-purple-500">
                <h1 class="text-2xl font-bold">👑 Admin</h1>
                <p class="text-sm mt-1">Welcome, <?php echo $_SESSION["admin_name"]; ?>!</p>
            </div>
        
            <div class="p-4 border-t border-purple-500">
                <a href="logout.php" class="block text-center bg-red-500 py-2 rounded-lg hover:bg-red-600">🚪 Logout</a>
            </div>
        </aside>

      
    </div>

</body>
</html>
