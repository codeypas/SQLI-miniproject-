<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['userid'];
$sql = "SELECT * FROM user WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      font-family: 'Arial', sans-serif;
    }
    .profile-card {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 600px;
      margin: 0 auto;
      margin-top: 50px;
    }
    .profile-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: 5px solid #2575fc;
      margin-bottom: 20px;
    }
    .profile-card h3 {
      font-size: 24px;
      color: #333;
      margin-bottom: 15px;
    }
    .profile-card p {
      font-size: 18px;
      color: #555;
      margin-bottom: 20px;
    }
    .btn-custom {
      background-color: #2575fc;
      color: #fff;
      border-radius: 30px;
      padding: 10px 20px;
      text-decoration: none;
      font-weight: bold;
    }
    .btn-custom:hover {
      background-color: #6a11cb;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <div class="profile-card">
    <!-- Profile Picture -->
    <img src="<?php echo !empty($user['photo']) ? $user['photo'] : 'default-avatar.png'; ?>" alt="Profile Picture">

    <!-- User Details -->
    <h3>Hello, <?php echo htmlspecialchars($user['name'] ?? 'No Name'); ?></h3>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['uname'] ?? 'No Username'); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['uname'] ?? 'No Email'); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone'] ?? 'No Phone'); ?></p>
    
    <!-- Buttons -->
    <a href="change-profile.php" class="btn-custom">Change Profile</a>
    <a href="logout.php" class="btn-custom">Logout</a>
  </div>
</div>

</body>
</html>
