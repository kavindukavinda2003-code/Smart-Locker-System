<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status = $_POST['status']; // Expecting 'Locked' or 'Unlocked'
    $user_id = $_POST['user_id'];

    // Insert new record instead of updating existing one
    $sql = "INSERT INTO lockers (user_id, status, last_action_time) VALUES ('$user_id', '$status', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}

$conn->close();
?>
