<?php
session_start();
include 'db_connection.php';

// Redirect if not logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = trim($_POST["password"]);
    $userId = $_SESSION['user_id'];

    // Validate
    if (empty($newPassword)) {
        echo "<script>alert('Please enter a new password!'); window.location='home.php';</script>";
        exit;
    }

    // --- Update only the password_changes table ---
    $update = $conn->prepare("UPDATE password_changes SET new_password = ?, changed_at = NOW() WHERE user_id = ?");
    $update->bind_param("si", $newPassword, $userId);

    if ($update->execute()) {
        // If no existing record, insert instead
        if ($update->affected_rows === 0) {
            $insert = $conn->prepare("INSERT INTO password_changes (user_id, new_password, changed_at) VALUES (?, ?, NOW())");
            $insert->bind_param("is", $userId, $newPassword);
            $insert->execute();
            $insert->close();
        }

        echo "<script>alert('Locker password updated successfully!'); window.location='home.php';</script>";
    } else {
        echo "<script>alert('Error updating locker password!'); window.location='home.php';</script>";
    }

    $update->close();
}

$conn->close();
?>


