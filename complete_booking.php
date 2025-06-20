<?php
session_start();
include('php/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$packageId = $_GET['id'];
$query = "SELECT * FROM packages WHERE id = $packageId";
$result = mysqli_query($conn, $query);
$package = mysqli_fetch_assoc($result);

// Generate 3 random time slots
$all_slots = ["08:00 AM", "10:30 AM", "01:00 PM", "03:00 PM", "05:30 PM", "07:00 PM"];
shuffle($all_slots);
$time_slots = array_slice($all_slots, 0, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complete Your Booking - Islamabad Sightseeing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #007bff, #00c6ff);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        .info {
            background: #f1f7ff;
            padding: 15px;
            border-left: 4px solid #007bff;
            border-radius: 6px;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        select, input[type="date"], input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
        }
        select:focus, input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }
        #totalAmount {
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
            margin-top: 10px;
        }
        button {
            background: #007bff;
            color: #fff;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
        .fa-calendar, .fa-clock, .fa-users {
            margin-right: 8px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-map-marker-alt"></i> Complete Your Booking</h2>

        <div class="info">
            <p><strong>Package:</strong> <?= $package['title']; ?></p>
            <p><strong>Price per Person:</strong> Rs <?= $package['price']; ?></p>
        </div>

        <form action="php/confirm_booking.php" method="POST">
            <input type="hidden" name="package_id" value="<?= $packageId; ?>">

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Select Time Slot:</label>
                <select name="time_slot" required>
                    <?php foreach ($time_slots as $slot): ?>
                        <option value="<?= $slot ?>"><?= $slot ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-calendar"></i> Select Date:</label>
                <input type="date" name="visit_date" required min="<?= date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label><i class="fas fa-users"></i> Number of People:</label>
                <input type="number" name="people_count" id="peopleCount" min="1" required>
            </div>

            <div id="totalAmount">Total: Rs 0</div>

            <br>
            <button type="submit"><i class="fas fa-check-circle"></i> Confirm Booking</button>
        </form>
    </div>

    <script>
        const peopleInput = document.getElementById("peopleCount");
        const totalAmount = document.getElementById("totalAmount");
        const pricePerPerson = <?= $package['price']; ?>;

        peopleInput.addEventListener("input", () => {
            const count = parseInt(peopleInput.value) || 0;
            const total = count * pricePerPerson;
            totalAmount.textContent = "Total: Rs " + total;
        });
    </script>
</body>
</html>
