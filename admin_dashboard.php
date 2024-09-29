<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$admin = $_SESSION['user'];
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
    <h2>Admin_Dashboard</h2>
    <ul>
        <li><a href="admin_appointments.php">Manage Appointments</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Welcome, admin</h1>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content-section">
        <p>You are logged in as admin </p>
    </div>
</div>

</body>
</html>
