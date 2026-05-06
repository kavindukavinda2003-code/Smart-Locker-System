<?php
session_start();
include 'db_connection.php';

// Redirect if not logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

// 1. Generate random 6-digit OTP
$otp = rand(1000, 9999);

// 2. Set expiry time (5 minutes from now)
$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// 3. Insert OTP record
$sql = "INSERT INTO otps (user_id, otp_code, expiry_time) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $userId, $otp, $expiry);

if ($stmt->execute()) {
    echo "<script>alert('OTP generated successfully!'); window.location='home.php';</script>";
} else {
    echo "<script>alert('Error generating OTP'); window.location='home.php';</script>";
}
?>
