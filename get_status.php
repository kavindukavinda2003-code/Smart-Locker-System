<?php
header("Content-Type: text/plain");
include 'db_connection.php';

$sql = "SELECT status FROM lockers ORDER BY locker_status_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    // Output only the word
    echo trim($row['status']);
} else {
    echo "NoData";
}
?>

