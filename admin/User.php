<?php
include("../config/db.php"); // DB connection

// Handle Add User Form Submission
if (isset($_POST['addUser'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash

    // ✅ Prepared Statement
    $stmt = $con->prepare("INSERT INTO user (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $password);

    if ($stmt->execute()) {
        // Prevent form re-submit on refresh
        echo "<script>alert('✅ User added successfully'); window.location.href=window.location.href;</script>";
        exit();
    } else {
        echo "<script>alert('❌ Error: Could not add user');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
    <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <?php include 'includes/header.php'; ?>
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h3 class="text-xl font-bold text-gray-800">User Management</h3>
    <button onclick="showAddUserForm()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
      👤 Add New User
    </button>
  </div>

  <!-- Add User Form -->
  <div id="addUserForm" class="hidden bg-white rounded-lg shadow-md p-6 mb-6">
    <h4 class="text-lg font-bold text-gray-800 mb-4">Add New User</h4>
    <form method="POST">
      <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-gray-700 font-medium mb-2">Full Name</label>
          <input type="text" name="name" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2">Email</label>
          <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
      </div>
      <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-gray-700 font-medium mb-2">Phone</label>
          <input type="text" name="phone" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2">Address</label>
          <input type="text" name="address" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Password</label>
        <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="flex space-x-3">
        <button type="submit" name="addUser" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
          💾 Save User
        </button>
        <button type="button" onclick="hideAddUserForm()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
          ❌ Cancel
        </button>
      </div>
    </form>
  </div>

  <!-- Users Table -->
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <?php
        $sql = "SELECT * FROM user ORDER BY uid DESC";
        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $firstLetter = strtoupper(substr($row['name'], 0, 1));
                echo "
                <tr>
                  <td class='px-6 py-4'>
                    <div class='flex items-center'>
                      <div class='w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3'>
                        $firstLetter
                      </div>
                      <div>
                        <p class='font-medium text-gray-800'>{$row['name']}</p>
                        <p class='text-sm text-gray-600'>User ID: {$row['uid']}</p>
                      </div>
                    </div>
                  </td>
                  <td class='px-6 py-4 text-gray-800'>{$row['email']}</td>
                  <td class='px-6 py-4 text-gray-800'>{$row['phone']}</td>
                  <td class='px-6 py-4 text-gray-800'>{$row['address']}</td>
                  <td class='px-6 py-4'>
                    <div class='flex space-x-2'>
                      <button class='bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700'>Edit</button>
                      <button class='bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700'>Block</button>
                    </div>
                  </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='px-6 py-4 text-center text-gray-600'>No users found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<!-- Show/Hide Form Scripts -->
<script>
function showAddUserForm() {
  document.getElementById('addUserForm').classList.remove('hidden');
}
function hideAddUserForm() {
  document.getElementById('addUserForm').classList.add('hidden');
}
</script>

</body>
</html>
