<?php
// razorpay_callback.php
include("../config/db.php");
include("../config/razorpay.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

$booking_id = (int)($_POST['booking_id'] ?? 0);
$razorpay_payment_id = $_POST['razorpay_payment_id'] ?? '';
$razorpay_order_id   = $_POST['razorpay_order_id'] ?? '';
$razorpay_signature  = $_POST['razorpay_signature'] ?? '';

if ($booking_id<=0 || !$razorpay_payment_id || !$razorpay_order_id || !$razorpay_signature) {
    die("Invalid callback");
}

// Verify HMAC sha256: hmac(order_id + "|" + payment_id, secret)
$payload = $razorpay_order_id . '|' . $razorpay_payment_id;
$expected = hash_hmac('sha256', $payload, RAZORPAY_KEY_SECRET);

if (hash_equals($expected, $razorpay_signature)) {
    // Update booking to Paid
    $stmt = $con->prepare("UPDATE bookings SET payment_status='Paid', payment_reference=? WHERE booking_id=? AND razorpay_order_id=?");
    $stmt->bind_param("sis", $razorpay_payment_id, $booking_id, $razorpay_order_id);
    $stmt->execute();
    $stmt->close();
    header("Location: payment_success.php?booking_id=" . $booking_id);
    exit;
} else {
    // Signature mismatch
    $stmt = $con->prepare("UPDATE bookings SET payment_status='Failed' WHERE booking_id=?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();
    header("Location: payment_failed.php?booking_id=" . $booking_id);
    exit;
}
