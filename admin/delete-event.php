<?php
include("../config/db.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Event ID");
}
$event_id = intval($_GET['id']);

// fetch image before delete
$sql = "SELECT event_image FROM events WHERE event_id = $event_id";
$result = $con->query($sql);
if ($result->num_rows == 0) {
    die("❌ Event not found");
}
$event = $result->fetch_assoc();

// delete image if exists
if (!empty($event['event_image']) && file_exists("../uploads/events/" . $event['event_image'])) {
    unlink("../uploads/events/" . $event['event_image']);
}

// delete event
$delete_sql = "DELETE FROM events WHERE event_id = $event_id";
if ($con->query($delete_sql)) {
    header("Location: events.php");
    exit();
} else {
    echo "<script>alert('❌ Error: Could not delete event'); window.location='events.php';</script>";
}
?>
