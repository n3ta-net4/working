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
    <style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    display: flex;
    height: 100vh;
    background-color: #f4f4f9;
}

.sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: #ecf0f1;
    padding: 20px;
    position: fixed;
    height: 100%;
    top: 0;
    left: 0;
}

.sidebar h2 {
    color: #ecf0f1;
    margin-bottom: 20px;
    text-align: center;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 20px;
}

.sidebar ul li a {
    color: #ecf0f1;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 10px 15px;
    transition: background 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #34495e;
    border-radius: 4px;
}

.main-content {
    margin-left: 250px;
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #3498db;
    padding: 15px;
    color: #fff;
    border-radius: 5px;
}

.top-bar h1 {
    margin: 0;
}

.btn-logout {
    background-color: #e74c3c;
    padding: 10px 20px;
    color: #fff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    transition: background 0.3s ease;
}

.btn-logout:hover {
    background-color: #c0392b;
}

.content-section {
    margin-top: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.content-section p {
    font-size: 18px;
    color: #333;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .sidebar {
        width: 100px;
        padding: 10px;
    }

    .sidebar ul li a {
        font-size: 16px;
    }

    .main-content {
        margin-left: 100px;
    }

    .top-bar h1 {
        font-size: 18px;
    }

    .btn-logout {
        padding: 8px 15px;
        font-size: 14px;
    }
}
</style>
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
