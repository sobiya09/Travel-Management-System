<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Connect to the database
require 'config.php';

// Fetch booking details
$sql = "SELECT bookings.id, users.username, packages.name as package_name, bookings.booking_date, bookings.guests, bookings.email, bookings.address, bookings.phone 
        FROM bookings 
        JOIN users ON bookings.user_id = users.id 
        JOIN packages ON bookings.package_id = packages.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;
?>

<table border="1">
    <thead style="background-color:cadetblue;">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Package</th>
            <th>Booking Date</th>
            <th>Guests</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $booking) : ?>
            <tr>
                <td><?php echo $booking['id']; ?></td>
                <td><?php echo $booking['username']; ?></td>
                <td><?php echo $booking['package_name']; ?></td>
                <td><?php echo $booking['booking_date']; ?></td>
                <td><?php echo $booking['guests']; ?></td>
                <td><?php echo $booking['email']; ?></td>
                <td><?php echo $booking['address']; ?></td>
                <td><?php echo $booking['phone']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>