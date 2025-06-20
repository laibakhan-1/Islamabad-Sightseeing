<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .dashboard-container {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
        }
        .btn-lg {
            margin: 20px;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?> 👋</h2>
        <p>What would you like to do?</p>
        <a href="admin_add_package.php" class="btn btn-primary btn-lg">➕ Add New Package</a>
        <a href="admin_view_bookings.php" class="btn btn-success btn-lg">📋 View Bookings</a>
        <br><br>
        <a href="admin_login.php" class="btn btn-danger">Logout</a>
        <a href="index.html" class="btn btn-secondary ms-2">Back to Home</a>
    </div>
</body>
</html>
