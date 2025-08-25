<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['un'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $event_id    = (int)($_POST['event_id'] ?? 0);
    $full_name   = trim($_POST['full_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $address     = trim($_POST['address'] ?? '');
    $guests      = (int)($_POST['guests'] ?? 1);
    $requirements= trim($_POST['requirements'] ?? '');
    $method      = $_POST['method'] ?? 'Cash';
    $payment_id  = $_POST['payment_id'] ?? '';
    
    // Fetch user ID (assuming $_SESSION['un'] is email)
    $stmt = $con->prepare("SELECT uid FROM user WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $_SESSION['un']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $user_id = $user['uid'] ?? 0;

    if (!$user_id) {
        die("User not found. Please login again.");
    }

    // Fetch event price
    $stmt = $con->prepare("SELECT price FROM events WHERE event_id=? LIMIT 1");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();
    $price = $event['price'] ?? 0;

    // Total = price * guests
    $total = $price * $guests;

    // Payment status
    $payment_status = ($method === 'Cash') ? 'Pending' : 'Paid';

    // Insert booking
    $stmt = $con->prepare("INSERT INTO bookings 
        (user_id, event_id, full_name, email, phone, address, guests, requirements, 
         payment_method, payment_id, payment_status, total) 
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param("iissssissssd", 
        $user_id, $event_id, $full_name, $email, $phone, $address, $guests, $requirements, 
        $method, $payment_id, $payment_status, $total
    );

    if ($stmt->execute()) {
        // ✅ Booking successful
        header("Location: my_bookings.php?success=1");
        exit();
    } else {
        die("Error saving booking: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}
