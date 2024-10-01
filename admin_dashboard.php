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
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Helvetica', Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f5f7fa;
        }
        .sidebar {
            width: 240px;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 10px; 
        }
        .sidebar .logo img {
            width: 200px; 
            margin-bottom: 5px; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }
        .sidebar h2 {
            color: #ecf0f1;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding-top: 10px; 
            flex-grow: 1; 
        }
        .sidebar ul li {
            margin-bottom: 15px; 
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px; 
            display: block;
            border-radius: 6px;
            transition: background-color 0.3s ease-in-out;
        }
        .sidebar ul li a:hover {
            background-color: #1abc9c;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px;
            width: 100%;
            background-color: #fff;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ecf0f1;
            padding: 15px 30px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .top-bar h1 {
            font-size: 30px;
            font-weight: 600;
            color: #2c3e50;
        }
        .btn-logout {
            background-color: #e74c3c;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 20px;
            transition: background-color 0.3s ease-in-out;
            margin-left: 15px;
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
        hr {
            border: 0;
            height: 1px;
            background: #fff; 
            margin: 10px 0; 
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
    <div class="logo">
        <a href="admin_dashboard.php">
            <img src="aw-k9.png" alt="aw-k9 logo">
        </a>
    </div>
    <h2>Admin Dashboard</h2>
    <hr> 
    <ul>
        <li><a href="admin_appointments.php">Manage Appointments</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Welcome, <?php echo htmlspecialchars($admin['name']); ?></h1>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content-section">
        <p>You are logged in as <strong><?php echo htmlspecialchars($admin['email']); ?></strong>.</p>
    </div>
    
    <hr> 
</div>

</body>
</html>
