<?php
session_start();

include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pswd']);

    // Query for information of user
    $stmt = $conn->prepare("SELECT * FROM user WHERE uname = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check if the user has exceeded the failed attempts limit
        if ($user['failed_attempts'] >= 3) {
            $last_failed_time = strtotime($user['last_failed_attempt']);
            $current_time = time();
            $time_diff = $current_time - $last_failed_time;

            // If it's been more than 10 minutes, reset the failed attempts
            if ($time_diff > 600) {
                $reset_stmt = $conn->prepare("UPDATE user SET failed_attempts = 0 WHERE id = ?");
                $reset_stmt->bind_param("i", $user['id']);
                $reset_stmt->execute();
            } else {
                // Send email alert for too many failed attempts
                sendAlertEmail($user['uname'], $username);

                echo "<script>alert('Too many failed login attempts. Please check your email.');</script>";
                $error_message = "Too many failed login attempts. Please check your email.";
            }
        } else {
            // Check password
            if (password_verify($password, $user['upwd'])) {
                $_SESSION['userid'] = $user['id'];
                $_SESSION['username'] = $user['uname'];

                // Reset failed attempts after successful login
                $stmt_reset = $conn->prepare("UPDATE user SET failed_attempts = 0 WHERE id = ?");
                $stmt_reset->bind_param("i", $user['id']);
                $stmt_reset->execute();

                header('Location: home.php');
                exit();
            } else {
                $failed_attempts = $user['failed_attempts'] + 1;
                $stmt_update = $conn->prepare("UPDATE user SET failed_attempts = ?, last_failed_attempt = NOW() WHERE id = ?");
                $stmt_update->bind_param("ii", $failed_attempts, $user['id']);
                $stmt_update->execute();

                // Check if failed attempts exceed 3 after increment
                if ($failed_attempts >= 3) {
                    sendAlertEmail($user['uname'], $username);
                    echo "<script>alert('Too many failed login attempts. Please check your email.');</script>";
                    $error_message = "Too many failed login attempts. Please check your email.";
                } else {
                    $error_message = "Invalid username or password.";
                }
            }
        }
    } else {
        $error_message = "Invalid username or password.";
    }
}

function sendAlertEmail($toEmail, $username)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bijay.ci22@bmsce.ac.in'; 
        $mail->Password = 'ngkj zyoi cpjp fakl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'SQLI-TEAM');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Account Locked Due to Failed Login Attempts';
        $mail->Body = "Dear $username,<br><br>
                       Your account has been locked due to too many failed login attempts.<br>
                       Please try again after 10 minutes or contact support for assistance.<br><br>
                       Regards,<br>Your Website Team";

        $mail->send();
    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">


    <style>
        body {
            background-color: #f4f6f9;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            margin-bottom: 20px;
        }
    </style>



</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SQLI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Login Form -->
<div class="container">
    <div class="login-container">
        <h2 class="text-center mb-4">Login to Your Account</h2>

        <!-- Display error message if login fails -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
            <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" name="pswd" placeholder="Enter password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-center mt-3">
            <a href="register.php">Don't have an account? Register here</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
