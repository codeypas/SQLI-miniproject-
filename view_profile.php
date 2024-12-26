<?php
session_start();
include('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    echo "Please log in to view your profile.";
    exit();
}

$uid = $_SESSION['userid']; // Retrieve user ID from session

// Fetch user details using a prepared statement
$sql = "SELECT uname, name, phone, photo FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Error fetching user details.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
    <h2>User Profile</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p> 
<!--  -->
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['uname']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
    
    <?php if (!empty($user['photo'])): ?>
        <p><strong>Profile Photo:</strong></p>
        <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Photo" width="150">
    <?php else: ?>
        <p><strong>Profile Photo:</strong> No photo uploaded.</p>
    <?php endif; ?>
    
    <a href="index.php" class="btn btn-primary mt-3">HOME</a>
</div>
</body>
</html>