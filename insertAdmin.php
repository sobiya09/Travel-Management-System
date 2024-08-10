<?php
require 'config.php';

$adminUsername = 'admin';
$plain_password = '1234';
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (adminUsername, adminPassword) VALUES (:adminUsername, :adminPassword)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":adminUsername", $adminUsername);
$stmt->bindParam(":adminPassword", $hashed_password);

if ($stmt->execute()) {
    echo "Admin user added successfully.";
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error: " . $errorInfo[2]; // Display the error message
}

$conn = null;
?>
