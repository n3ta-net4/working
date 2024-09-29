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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="admin-container">
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
                        <form action="admin_appointments.php" method="POST">
                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                            <button type="submit" name="action" value="approve">Approve</button>
                            <button type="submit" name="action" value="reject">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form action="admin_dashboard.php" method="get">
            <button type="submit">Back to Admin Dashboard</button>
        </form>
    </div>
</body>
</html>
