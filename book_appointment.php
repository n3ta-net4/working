<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$confirmation_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];  
    $appointment_date = $_POST['date'];
    $appointment_time = $_POST['time'];

    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE appointment_date = ? AND appointment_time = ? AND status = 'approved'");
    $stmt->execute([$appointment_date, $appointment_time]);

    if ($stmt->rowCount() > 0) {
        $confirmation_message = "This time slot is already booked!";
        $message_class = "error";
    } else {
        $stmt = $pdo->prepare("INSERT INTO appointments (user_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, 'pending')");
        $stmt->execute([$user_id, $appointment_date, $appointment_time]);
        $confirmation_message = "Your appointment is pending approval.";
        $message_class = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .appointment-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .confirmation-message {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .error {
            background-color: #f2dede;
            color: #a94442;
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
            display: block;
            margin: 20px auto;
        }

        button:hover {
            background-color: #2980b9;
        }

        .btn-back {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s;
        }

        .btn-back:hover {
            transform: scale(1.05);
            background-color: #0072ff;
        }
    </style>
</head>
<body>
    <div class="appointment-container">
       
        <?php if ($confirmation_message): ?>
            <div class="confirmation-message <?php echo $message_class; ?>">
                <?php echo htmlspecialchars($confirmation_message); ?>
            </div>
        <?php endif; ?>
        
        <form action="user_dashboard.php" method="get">
            <button type="submit" class="btn-back">Back to User Dashboard</button>
        </form>
    </div>
</body>
</html>