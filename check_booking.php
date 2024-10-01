<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['booked' => true]); 
    exit();
}

$data = json_decode(file_get_contents("php://input"));
$appointment_date = $data->date;
$appointment_time = $data->time;

$stmt = $pdo->prepare("SELECT * FROM appointments WHERE appointment_date = ? AND appointment_time = ? AND status = 'approved'");
$stmt->execute([$appointment_date, $appointment_time]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['booked' => true]);
} else {
    echo json_encode(['booked' => false]);
}
?>
