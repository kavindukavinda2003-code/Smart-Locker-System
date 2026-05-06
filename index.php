<?php
session_start(); 
include 'db_connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $uname, $db_password);
        $stmt->fetch();

        if ($password === $db_password) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $uname;
            header("Location: home.php");
            exit;
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "User not found.";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Smart Locker Login</title>
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
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
    }

    .login-box {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 40px 35px;
        width: 350px;
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
        font-size: 1.6em;
    }

    label {
        display: block;
        text-align: left;
        margin: 10px 0 5px 5px;
        font-size: 0.9em;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        text-align: center;
        outline: none;
        font-size: 1em;
        color: #333;
    }

    input[type="submit"] {
        margin-top: 20px;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        background-color: #2563eb;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #1e40af;
    }

    .register-btn {
        margin-top: 15px;
        display: inline-block;
        padding: 8px 15px;
        background: transparent;
        border: 1px solid #fff;
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s;
    }

    .register-btn:hover {
        background: #fff;
        color: #2563eb;
    }

    p.message {
        margin-top: 10px;
        font-size: 0.9em;
        color: #ffcccb;
    }
</style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Smart Locker Login</h2>
        <form method="post" action="">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>

        <p class="message"><?php echo $message; ?></p>

        <a href="register.php" class="register-btn">Register</a>
    </div>
</body>
</html>


