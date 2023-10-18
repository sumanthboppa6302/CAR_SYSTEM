<?php
$host = 'localhost'; // Your database host
$port = 3307; // Your MySQL port (if different from the default)
$database = 'car_booking_system'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = 'my_password'; // Replace with your database password

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
