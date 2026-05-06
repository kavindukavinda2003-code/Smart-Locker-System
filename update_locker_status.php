<?php
session_start();
include 'db_connection.php';

// Ensure user logged in
if (empty($_SESSION['user_id'])) {
    echo "unauthorized";
    exit;
}

// Check if status is provided
if (!isset($_POST['status'])) {
    echo "missing";
    exit;
}

$userId = intval($_SESSION['user_id']);
$status = $_POST['status'];

// Validate
if ($status !== 'Locked' && $status !== 'Unlocked') {
    echo "invalid";
    exit;
}

// Insert a new log entry (keep full history)
$stmt = $conn->prepare("INSERT INTO lockers (user_id, status, last_action_time) VALUES (?, ?, NOW())");
$stmt->bind_param("is", $userId, $status);
$stmt->execute();
$stmt->close();

echo "success";
$conn->close();
?>

