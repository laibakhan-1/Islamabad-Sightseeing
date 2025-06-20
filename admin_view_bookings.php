<?php
session_start();
require_once 'php/config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

// Handle Accept/Reject actions
if (isset($_GET['action'], $_GET['booking_id'])) {
    $action = $_GET['action'];
    $booking_id = (int)$_GET['booking_id'];

    if (in_array($action, ['accept', 'reject'])) {
        $new_status = $action === 'accept' ? 'accepted' : 'rejected';

        // Update the booking status in the database
        $stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        if ($stmt->execute([$new_status, $booking_id])) {
            $_SESSION['message'] = "Booking status updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update booking status.";
        }

        // Redirect to prevent resubmission
        header("Location: admin_view_bookings.php");
        exit();
    }
}

// Fetch all bookings with package titles
$sql = "SELECT b.*, p.title AS package_title 
        FROM bookings b
        LEFT JOIN packages p ON b.package_id = p.id
        ORDER BY b.booking_date DESC";
$stmt = $pdo->query($sql);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin - View Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-4">All Bookings</h2>

    <!-- Success message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Error message -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Booking ID</th>
                <th>User ID</th>
                <th>Package</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>People</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $b): ?>
            <?php 
                $status = !empty($b['status']) ? $b['status'] : 'pending';

                switch ($status) {
                    case 'accepted':
                        $class = 'bg-success text-white';
                        break;
                    case 'rejected':
                        $class = 'bg-danger text-white';
                        break;
                    default:
                        $class = 'bg-warning text-dark';
                }
            ?>
            <tr>
                <td><?= htmlspecialchars($b['id']) ?></td>
                <td><?= htmlspecialchars($b['user_id']) ?></td>
                <td><?= htmlspecialchars($b['package_title'] ?? 'Unknown') ?></td>
                <td><?= htmlspecialchars($b['booking_date']) ?></td>
                <td><?= htmlspecialchars($b['time_slot'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($b['people'] ?? 'N/A') ?></td>
                <td><span class="badge <?= $class ?>"><?= ucfirst(htmlspecialchars($status)) ?></span></td>
                <td>
                    <?php if ($status === 'pending'): ?>
                        <a href="?action=accept&booking_id=<?= $b['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Accept this booking?')">Accept</a>
                        <a href="?action=reject&booking_id=<?= $b['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Reject this booking?')">Reject</a>
                    <?php else: ?>
                        <em>No actions</em>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
