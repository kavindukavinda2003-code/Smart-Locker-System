<?php
include 'db_connection.php';

$sql = "SELECT locker_status_id, status, last_action_time 
        FROM lockers 
        ORDER BY last_action_time DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Locker Logs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Locker Logs</h1>
    <button class="account-btn">Account</button>
</header>

<main>

    <div class="card">
        <h2>Activity History</h2>

        <table style="width:100%; border-collapse: collapse;">
            <tr style="background:#2563eb; color:white;">
                <th style="padding:10px;">Locker Status ID</th>
                
                <th style="padding:10px;">Status</th>
                <th style="padding:10px;">Time</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    $statusClass = ($row['status'] == 'open') ? 'unlocked' : 'locked';

                    echo "<tr style='border-bottom:1px solid #ddd;'>
                            <td style='padding:10px;'>{$row['locker_status_id']}</td>
                            
                            <td style='padding:10px;' class='$statusClass'>{$row['status']}</td>
                            <td style='padding:10px;'>{$row['last_action_time']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='padding:10px;'>No logs available</td></tr>";
            }
            ?>
        </table>

    </div>

</main>

<footer>
    <p>Locker System © 2026</p>
</footer>

</body>
</html>