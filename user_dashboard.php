<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>


<div class="sidebar">
    <h2>User_Dashboard</h2>
    <ul>
        <li><a href="index.html">Booking</a></li>
        <li><a href="view_appointments.php">View Appointments</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
    </ul>
</div>


<div class="main-content">
    <div class="top-bar">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content-section">
        <p>You are logged in as <?php echo htmlspecialchars($user['email']); ?></p>
    </div>
</div>

</body>
</html>
