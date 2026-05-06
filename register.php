<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = ($_POST["password"]);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $success = "Registration successful!";
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Registration</title>
<style>
    * {
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
    }

    .register-box {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 40px 35px;
        width: 380px;
        color: #fff;
        text-align: center;
        box-shadow: 0 4px 30px rgba(0,0,0,0.2);
        animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        margin-bottom: 25px;
        font-size: 1.8em;
    }

    label {
        display: block;
        text-align: left;
        margin: 10px 0 5px 5px;
        font-size: 0.9em;
    }

    input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        text-align: center;
        outline: none;
        font-size: 1em;
        color: #333;
    }

    button, input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        background-color: #4f46e5;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
    }

    button:hover, input[type="submit"]:hover {
        background-color: #312e81;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .login-btn {
        margin-top: 10px;
        display: inline-block;
        width: 100%;
        border: 1px solid #fff;
        padding: 10px;
        border-radius: 8px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        background: #fff;
        color: #2563eb;
    }

    p.success {
        color: #a7f3d0;
        font-weight: 500;
    }

    p.error {
        color: #fca5a5;
        font-weight: 500;
    }
</style>
</head>
<body>
    <div class="register-box">
        <h2>🧾 Create New Account</h2>

        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="post" action="">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Register">
        </form>

        <a href="index.php" class="login-btn">Login</a>
    </div>
</body>
</html>

