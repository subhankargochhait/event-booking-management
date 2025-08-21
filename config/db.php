<?php
$host = "localhost";
$user = "root";
$pass = "";   
$db   = "event_booking_management";

// Create connection (procedural)
$con = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
