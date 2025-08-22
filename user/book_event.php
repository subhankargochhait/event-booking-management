<?php
// book_event.php
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

$event_id   = (int)($_POST['event_id'] ?? 0);
$fullName   = trim($_POST['fullName'] ?? '');
$phone      = trim($_POST['phone'] ?? '');
$email      = trim($_POST['email'] ?? '');
$guests     = (int)($_POST['guests'] ?? 1);
$eventDate  = $_POST['eventDate'] ?? '';
$requirements = trim($_POST['requirements'] ?? '');
$base_price = (float)($_POST['base_price'] ?? 0);
$payment_method = $_POST['payment_method'] ?? 'Cash';

if ($event_id <= 0 || $guests <= 0 || empty($fullName) || empty($phone) || empty($email) || empty($eventDate)) {
    die("Invalid data");
}

$total = $base_price * $guests;

// insert booking
$stmt = $con->prepare("INSERT INTO bookings (event_id, full_name, phone, email, guests, event_date, requirements, total, payment_method, payment_status)
                       VALUES (?,?,?,?,?,?,?,?,?, 'Pending')");
$stmt->bind_param("isssissds", $event_id, $fullName, $phone, $email, $guests, $eventDate, $requirements, $total, $payment_method);
if (!$stmt->execute()) {
    die("DB Error: " . $con->error);
}
$booking_id = $stmt->insert_id;
$stmt->close();

if ($payment_method === 'Cash') {
    // For Cash: keep status Pending (to be collected) or mark Paid if you collect upfront.
    echo "<script>alert('Booking saved! Please pay cash as instructed.'); window.location='festival.php';</script>";
    exit;
} else {
    // Razorpay flow
    header("Location: razorpay_payment.php?booking_id=$booking_id");
    exit;
}
