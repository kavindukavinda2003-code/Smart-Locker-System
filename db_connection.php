<?php
// db_connection.php

$host = "fdb1034.awardspace.net";       // Replace with your host
$db_user = "4703526_locker";       // Replace with your InfinityFree MySQL username
$db_pass = "thatsmaboy@12345";    // Replace with your DB password
$db_name = "4703526_locker";    // Replace with your DB name

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
