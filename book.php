<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Your PHPMailer settings
$mail = new PHPMailer(true);
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'sumanth.boppa3009@gmail.com'; // Replace with your email
$mail->Password = 'lizx lolu cugk cghu'; // Replace with your Gmail app password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

try {
    // Handle the booking data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'));

        if ($data) {
            $source = $data->source;
            $destination = $data->destination;
            $email = $data->email;
            $car = $data->car;
            $pricePerMinute = $data->pricePerMinute;
            $totalCost = $data->totalCost;

            // Include your database connection file
            include 'db.php';

            // Insert user information into the 'users' table if it doesn't already exist
            $stmt = $conn->prepare("INSERT IGNORE INTO users (email) VALUES (:email)");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Retrieve the user's ID from the 'users' table
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();
            $user_id = $user['user_id'];

            // Insert booking details into the 'bookings' table
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, source, destination, car, price_per_minute, total_cost) VALUES (:user_id, :source, :destination, :car, :pricePerMinute, :totalCost)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':source', $source);
            $stmt->bindParam(':destination', $destination);
            $stmt->bindParam(':car', $car);
            $stmt->bindParam(':pricePerMinute', $pricePerMinute);
            $stmt->bindParam(':totalCost', $totalCost);
            $stmt->execute();

            // Prepare email content
            $emailContent = "Booking Details:\n\n";
            $emailContent .= "Source: $source\n";
            $emailContent .= "Destination: $destination\n";
            $emailContent .= "Car: $car\n";
            $emailContent .= "Email: $email\n";
            $emailContent .= "Total Cost: $totalCost\n";

            // Recipients
            $mail->setFrom('your.email@gmail.com', 'Your Name');
            $mail->addAddress($email, 'Recipient Name'); // Sending to the user's email

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'Booking Details';
            $mail->Body = $emailContent;
// Add your PHP code for sending an email here.
// Replace this with your email sending logic.
// Send confirmation email to the user's email address.

            // Send the email
            $mail->send();
            echo "Booking request received. Booking details sent to your email.";
        } else {
            echo "Failed to parse JSON data.";
        }
    }
} catch (Exception $e) {
    echo "Error occurred while sending email: {$mail->ErrorInfo}";
}
?>