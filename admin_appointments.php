<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

$stmt = $pdo->prepare("SELECT appointments.*, users.name FROM appointments JOIN users ON appointments.user_id = users.id WHERE status = 'pending'");
$stmt->execute();
$appointments = $stmt->fetchAll();

$confirmation_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $query = "UPDATE appointments SET status = 'approved' WHERE id = ?";
        $confirmation_message = 'The appointment has been approved.';
    } elseif ($action === 'reject') {
        $query = "UPDATE appointments SET status = 'rejected' WHERE id = ?";
        $confirmation_message = 'The appointment has been rejected.';
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute([$appointment_id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Appointments</title>
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
            width: calc(100% - 240px);
            background-color: #fff;
            overflow-y: auto;
        }
        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .confirmation-message {
            color: green;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
            color: #fff;
        }
        button {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
        .approve {
            background-color: #4caf50; 
        }
        .reject {
            background-color: #f44336; 
        }
        .approve:hover {
            background-color: #388e3c;
        }
        .reject:hover {
            background-color: #c62828;
        }
        hr {
            border: 0;
            height: 1px;
            background: #fff; 
            margin: 10px 0; 
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
    <h2>Manage Appointments</h2>
    <?php if ($confirmation_message): ?>
        <p class="confirmation-message"><?php echo htmlspecialchars($confirmation_message); ?></p>
    <?php endif; ?>
    <table>
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                <td>
                    <form action="admin_appointments.php" method="POST" style="display: inline;">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                        <button type="submit" name="action" value="approve" class="approve">Approve</button>
                        <button type="submit" name="action" value="reject" class="reject">Reject</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
