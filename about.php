<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SQLI Prevention and Detection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .about-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .about-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .about-container p {
            color: #555;
            line-height: 1.6;
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
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="about.php">About</a>
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

<!-- About Section -->
<div class="about-container">
    <h2>About Us</h2>
    <section>
        <h3>Our Mission</h3>
        <p>Welcome to our website dedicated to SQL Injection (SQLI) prevention and detection. Our mission is to provide resources and tools to help developers secure their applications against SQL Injection attacks.</p>
    </section>
    <section>
        <h3>What is SQL Injection?</h3>
        <p>SQL Injection is a code injection technique that exploits a security vulnerability in an application's software. It allows attackers to interfere with the queries that an application makes to its database, potentially leading to unauthorized access to sensitive data.</p>
    </section>
    <section>
        <h3>How We Help</h3>
        <p>We offer comprehensive guides, tutorials, and tools to help you understand and implement best practices for preventing and detecting SQL Injection attacks. Our goal is to make the web a safer place by empowering developers with the knowledge they need to secure their applications.</p>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>