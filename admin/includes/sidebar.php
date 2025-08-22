<?php
// Start session (make sure this is at the very top of the file, before any HTML output)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Sidebar -->
<div class="w-64 bg-white shadow-lg relative">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-gray-800">🎪 Admin Panel</h1>
        <p class="text-gray-600 text-sm">Event Management System</p>
    </div>
    
    <nav class="mt-6">
        <a href="dashboard.php" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors sidebar-active">
            <span class="mr-3">📊</span>
            Dashboard
        </a>
        <a href="events.php" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <span class="mr-3">🎉</span>
            Events
        </a>
        <a href="bookings.php" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <span class="mr-3">🎫</span>
            Bookings
        </a>
        <a href="user.php" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <span class="mr-3">👥</span>
            Users
        </a>
        <a href="analytics.php" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <span class="mr-3">📈</span>
            Analytics
        </a>
        <a href="settings.php" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <span class="mr-3">⚙️</span>
            Settings
        </a>
    </nav>
    
    <!-- Bottom User Info -->
    <div class="absolute bottom-0 w-64 p-6 border-t">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                <?php echo strtoupper(substr($_SESSION['admin_name'] ?? "A", 0, 1)); ?>
            </div>
            <div class="ml-3">
                <p class="font-medium text-gray-800">
                    <?php echo $_SESSION['admin_name'] ?? "Admin User"; ?>
                </p>
                <p class="text-sm text-gray-600">
                    <?php echo $_SESSION['admin_email'] ?? "admin@events.com"; ?>
                </p>
            </div>
        </div>
    </div>
</div>
