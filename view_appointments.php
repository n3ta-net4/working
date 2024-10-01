<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT appointments.*, users.name FROM appointments JOIN users ON appointments.user_id = users.id WHERE (status = 'approved' OR status = 'rejected') AND appointments.user_id = ?");
$stmt->execute([$user_id]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$approved_appointments = array_filter($appointments, function($appointment) {
    return $appointment['status'] === 'approved';
});

$rejected_appointments = array_filter($appointments, function($appointment) {
    return $appointment['status'] === 'rejected';
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View My Appointments</title>
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
        .sidebar .user-details {
            text-align: center;
            margin-bottom: 10px;
        }
        .sidebar .user-details h2 {
            font-size: 20px; 
            margin-bottom: 3px;
            font-weight: bold;
        }
        .sidebar .user-details p {
            font-size: 20px;
            color: #ecf0f1;
        }
        .sidebar .divider {
            border-bottom: 1px solid #fff;
            margin: 10px 0;
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
            overflow-y: auto;
        }
        h3 {
            color: #1976d2; /* Deep blue for headings */
            margin: 15px 0;
            font-size: 22px;
        }
        .appointment-card {
            border-radius: 6px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            color: #fff; /* White text for better contrast */
            position: relative;
        }
        .approved {
            background-color: #4caf50; /* Green for approved */
            border: 1px solid #388e3c; /* Darker green border */
        }
        .rejected {
            background-color: #f44336; /* Red for rejected */
            border: 1px solid #c62828; /* Darker red border */
        }
        .appointment-card:hover {
            transform: translateY(-2px);
            opacity: 0.9; /* Slightly fade on hover */
        }
        .appointment-details {
            margin: 5px 0;
            font-size: 16px; /* Slightly larger font for clarity */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Text shadow for better visibility */
        }
        @media (max-width: 600px) {
            .main-content {
                margin-left: 0;
            }
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <a href="user_dashboard.php">
            <img src="aw-k9.png" alt="aw-k9 logo">
        </a>
    </div>
    <div class="user-details">
        <h2><?php echo htmlspecialchars($_SESSION['user']['name']); ?></h2>
        <p><?php echo htmlspecialchars($_SESSION['user']['email']); ?></p>
    </div>
    <div class="divider"></div>
    <ul>
        <li><a href="index.php">Booking</a></li>
        <li><a href="view_appointments.php">View Appointments</a></li>
    </ul>
</div>

<div class="main-content">
    <h3>My Approved Appointments</h3>
    <?php if (count($approved_appointments) > 0): ?>
        <?php foreach ($approved_appointments as $appointment): ?>
            <div class="appointment-card approved">
                <div class="appointment-details"><strong>User:</strong> <?php echo htmlspecialchars($appointment['name']); ?></div>
                <div class="appointment-details"><strong>Date:</strong> <?php echo htmlspecialchars($appointment['appointment_date']); ?></div>
                <div class="appointment-details"><strong>Time:</strong> <?php echo htmlspecialchars($appointment['appointment_time']); ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have no approved appointments at this time.</p>
    <?php endif; ?>

    <h3>My Rejected Appointments</h3>
    <?php if (count($rejected_appointments) > 0): ?>
        <?php foreach ($rejected_appointments as $appointment): ?>
            <div class="appointment-card rejected">
                <div class="appointment-details"><strong>User:</strong> <?php echo htmlspecialchars($appointment['name']); ?></div>
                <div class="appointment-details"><strong>Date:</strong> <?php echo htmlspecialchars($appointment['appointment_date']); ?></div>
                <div class="appointment-details"><strong>Time:</strong> <?php echo htmlspecialchars($appointment['appointment_time']); ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have no rejected appointments at this time.</p>
    <?php endif; ?>
</div>
</body>
</html>
