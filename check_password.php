<?php
include 'db_connection.php';

if (!isset($_GET['password'])) {
    echo "wrong";
    exit;
}

$pin = $_GET['password'];

/* Check saved password */
$sql1 = "SELECT * FROM password_changes
         WHERE new_password='$pin'
         ORDER BY changed_at DESC
         LIMIT 1";

$result1 = $conn->query($sql1);

if ($result1 && $result1->num_rows > 0) {
    echo "correct";
    exit;
}

/* Check OTP */
$sql2 = "SELECT * FROM otps
         WHERE otp_code='$pin'
         AND verified=0
         AND expiry_time > NOW()
         LIMIT 1";

$result2 = $conn->query($sql2);

if ($result2 && $result2->num_rows > 0) {

    $row = $result2->fetch_assoc();
    $otp_id = $row['otp_id'];

    $conn->query("UPDATE otps SET verified=1 WHERE otp_id='$otp_id'");

    echo "correct";
}
else {
    echo "wrong";
}

$conn->close();
?>