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
        .appointments-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f9;
        }
        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="appointments-container">
        <h2>My Approved Appointments</h2>
        <?php if (count($approved_appointments) > 0): ?>
            <table>
                <tr>
                    <th></th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                <?php foreach ($approved_appointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>You have no approved appointments at this time.</p>
        <?php endif; ?>

        <h2>My Rejected Appointments</h2>
        <?php if (count($rejected_appointments) > 0): ?>
            <table>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                <?php foreach ($rejected_appointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>You have no rejected appointments at this time.</p>
        <?php endif; ?>

        <form action="user_dashboard.php" method="get">
            <br>
            <button type="submit">Back to User Dashboard</button>
        </form>
    </div>
</body>
</html>
