<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Connect to the database
require 'config.php';

// Fetch user details
$sql = "SELECT id, username, email_address, phone_number, address FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;
?>

<table border="1">
    <thead style="background-color:cadetblue;">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email_address']; ?></td>
                <td><?php echo $user['phone_number']; ?></td>
                <td><?php echo $user['address']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>