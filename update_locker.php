<?php
session_start();
include 'db_connection.php';

// Ensure user is logged in
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

// Validate allowed values
if ($status !== 'Locked' && $status !== 'Unlocked') {
    echo "invalid";
    exit;
}

// Check if locker record already exists for this user
$check = $conn->prepare("SELECT lockerid FROM locker_status WHERE user_id = ?");
$check->bind_param("i", $userId);
$check->execute();
$res = $check->get_result();

if ($res->num_rows === 0) {
    // Insert new record if none exists
    $insert = $conn->prepare("INSERT INTO locker_status (user_id, status) VALUES (?, ?)");
    $insert->bind_param("is", $userId, $status);
    $insert->execute();
    $insert->close();
} else {
    // Update existing record if found
    $update = $conn->prepare("UPDATE locker_status SET status = ? WHERE user_id = ?");
    $update->bind_param("si", $status, $userId);
    $update->execute();
    $update->close();
}

echo "success";
$conn->close();
?>
