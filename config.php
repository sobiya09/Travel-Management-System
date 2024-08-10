<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_management";

try {
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO:: ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $conn = new PDO($dsn, $username, $password, $options);
   // echo "Connection successful";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>