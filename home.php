<?php
session_start();

// Redirect if not logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Locker Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- ---------- HEADER ---------- -->
  <header>
    <h1>Smart Locker</h1>
    <div>
          
      <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <a href="locker_logs.php"><button class="account-btn">Details</button></a>
      <a href="logout.php"><button class="account-btn">Logout</button></a>
      
    </div>
  </header>

  <!-- ---------- MAIN CONTENT ---------- -->
  <main>

<!-- Locker Status Card -->
<section class="card">
  <h2>🔐 Locker Status</h2>
  <p id="lockerStatus" class="status locked">Locked 🔒</p>
  <div class="btn-group">
    <button onclick="unlockLocker()" class="unlock-btn">Unlock</button>
    <button onclick="lockLocker()" class="lock-btn">Lock</button>
  </div>
  <p id="responseMsg"></p>
</section>

    <!-- OTP Card -->
   <!-- OTP Card -->
<section class="card">
  <h2>📲 Generate OTP</h2>
  <form action="generate_otp.php" method="POST">
    <input type="submit" value="Generate OTP" class="otp-btn">
  </form>
  <p id="otpDisplay"></p>
    <?php

    // show latest OTP for current user
    include 'db_connection.php';
    $userId = $_SESSION['user_id'];
    $sql = "SELECT otp_code, expiry_time, verified FROM otps WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "Your OTP is: " . htmlspecialchars($row['otp_code']) . "<br>";
        echo "Expires at: " . $row['expiry_time'] . "<br>";
        echo "Status: " . ($row['verified'] ? "Verified ✅" : "Pending ⏳");
    }
    ?>
  </p>
</section>


    <!-- Change Password Card -->
    <section class="card">
  <h2>🔑 Change Password</h2>
  <form action="update_password.php" method="POST">
    <label for="password">New Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Update Password" class="primary-btn">
  </form>
</section>

  </main>

  <!-- ---------- FOOTER ---------- -->
  <footer>
    Smart Locker System © 2025
  </footer>

  <script src="script.js"></script>
 

</body>
</html>