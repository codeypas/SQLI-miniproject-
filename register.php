<?php
error_reporting(E_ALL);
session_start();
include('connection.php');

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pswd']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    // Check if user already exists
    $sql_check = "SELECT * FROM user WHERE uname = '$username'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "<div class='alert alert-danger'>User already exists. Please choose a different username.</div>";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO user (uname, upwd, name) VALUES ('$username', '$password', '$name')";
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Registration successful. You can now <a href='index.php'>login</a>.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h2>Register an Account</h2>
    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Username</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password</label>
            <input type="password" class="form-control" id="pwd" name="pswd" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>
