<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: view_package.php');
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['id'];

$booking_id = $_GET['id'];
$sql = "DELETE FROM bookings WHERE id = :booking_id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':booking_id', $booking_id);
$stmt->bindParam(':user_id', $user_id);

if ($stmt->execute()) {
    header('Location: dashboard.php');
    exit();
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
?>
