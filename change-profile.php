<?php
session_start();
include('connection.php');

if (!isset($_SESSION['userid'])) {
    echo "Please log in to update your profile.";
    exit();
}

$uid = $_SESSION['userid'];

// Fetch current user data to display in the form
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $photo_path = null;

    // Server-side input validation
    if (empty($name) || empty($phone) || empty($username)) {
        echo "All fields are required.";
        exit();
    }

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $photo_name = basename($_FILES['photo']['name']);
        $target_file = $upload_dir . uniqid() . "_" . $photo_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        
        // Check file type
        if (in_array($file_type, $allowed_types)) {
            // Check file size (5MB max)
            if ($_FILES['photo']['size'] <= 5000000) {
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                    $photo_path = $target_file;
                } else {
                    echo "Failed to upload photo.";
                    exit();
                }
            } else {
                echo "File is too large. Maximum allowed size is 5MB.";
                exit();
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit();
        }
    }

    // Update user profile in the database
    $sql = "UPDATE user SET name = ?, phone = ?, uname = ?" . ($photo_path ? ", photo = ?" : "") . " WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($photo_path) {
        $stmt->bind_param("ssssi", $name, $phone, $username, $photo_path, $uid);
    } else {
        $stmt->bind_param("sssi", $name, $phone, $username, $uid);
    }
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        header("Location: view_profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h2>Edit Profile</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="username">Email:</label>
                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['uname']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="photo">Profile Photo:</label>
                <input type="file" class="form-control" name="photo">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>
