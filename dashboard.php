<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Islamabad Sightseeing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
    background-color: skyblue;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
    .navbar {
      background-color: #007bff;
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
      font-weight: bold;
    }
    .dashboard-card {
      background-color: #fff;
      padding: 30px;
      margin-top: 80px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.html">Islamabad Sightseeing</a>
    <div class="ms-auto">
      <span class="text-white me-3">Welcome, <?php echo $_SESSION['username']; ?>!</span>
      <a href="php/logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<!-- Dashboard Content -->
<div class="container">
  <div class="dashboard-card mt-5">
    <h3>Your Dashboard</h3>
    <p>Here you can see your bookings and explore available packages.</p>

    <a href="packages.php" class="btn btn-primary mt-3">View Available Packages</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
