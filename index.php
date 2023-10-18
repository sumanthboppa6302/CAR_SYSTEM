<!DOCTYPE html>
<html>
<head>
    <title>Cab Booking System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>

/* style.css */

body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('car_images\body.jpg'); /* Set the car image as the background */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Don't repeat the background */
        }

h1 {
    text-align: center;
    background-color: #333;
    color: #fff;
    padding: 20px;
    margin: 0;
}

.container {
    display: flex;
    justify-content: center; /* Center align the car information */
    padding: 60px;
}

.car-info {
    overflow-y: scroll;
    height: 100vh; /* Adjust the height as needed */
}

.car {
    cursor: pointer;
    margin: 0 0 20px;
    background-color: grey;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    transition: transform 0.1s ease;
    max-width: 100%; /* Limit the max width to center-align */
    margin: 10px auto; /* Center-align each car */
}

.car:hover {
    transform: scale(1.0);
}

.car-image {
    max-width: 100%;
}

.car p {
    margin-top: 10px;
    font-weight: bold;
}

.booking-form {
    flex: 1;
    padding: 20px;
    background-color: lightgray;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
}

/* Style for the booking form elements */
.booking-form label {
    font-weight: bold;
}

.booking-form input {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.booking-form input[type="submit"] {
    background-color: #333;
    color: #fff;
    cursor: pointer;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
}

    </style>
</head>
<body>
    <h1>Cab Booking System</h1>

    <!-- Main container for car information and booking form -->
    <div class="container">
        <!-- Car Information -->
        <div class="car-info">
            <!-- Car A -->
            <div class="car" data-car="INNOVA" data-price="15rs" onclick="showBookingForm('INNOVA', 15)">
                <img src="car_images/innova.jpg" alt="Car A" class="car-image">
                <p>INNOVA - 15rs per minute</p>
            </div>

            <!-- Car B -->
            <div class="car" data-car="SAFARI" data-price="12rs" onclick="showBookingForm('SAFARI', 12)">
                <img src="car_images/safari.jpg" alt="Car B" class="car-image">
                <p>SAFARI - 12rs per minute</p>
            </div>

            <!-- Car C -->
            <div class="car" data-car="SCORPIO" data-price="12rs" onclick="showBookingForm('SCORPIO', 12)">
                <img src="car_images/scorpio.jpg" alt="Car C" class="car-image">
                <p>SCORPIO - 12rs per minute</p>
            </div>

            <!-- Car D -->
            <div class="car" data-car="SWIFT DZIRE" data-price="10rs" onclick="showBookingForm('SWIFT DZIRE', 10)">
                <img src="car_images/swift_dzire.jpg" alt="Car D" class="car-image">
                <p>SWIFT DZIRE - 10rs per minute</p>
            </div>

            <!-- Car E -->
            <div class="car" data-car="SWIFT" data-price="8rs" onclick="showBookingForm('SWIFT', 8)">
                <img src="car_images/swift.jpg" alt="Car E" class="car-image">
                <p>SWIFT - 8rs per minute</p>
            </div>
        </div>

        <!-- Booking Form (Initially Hidden) -->
        <div class="booking-form" style="display: none;">
            <h2>Booking Details</h2>
            <form action="book.php" method="post">
                <label for="source">Source:</label>
                <input type="text" id="source" name="source" required><br>
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="selectedCar">Selected Car:</label>
                <input type="text" id="selectedCar" name="selectedCar" readonly><br>
                <label for="pricePerMinute">Price/Minute:</label>
                <input type="text" id="pricePerMinute" name="pricePerMinute" readonly><br>
                <label for="timeInHours">Time (in hours):</label>
                <input type="text" id="timeInHours" name="timeInHours" required><br>
                <label for="totalPrice">Total Price:</label>
                <input type="text" id="totalPrice" name="totalPrice" readonly><br>
                <input type="submit" value="Book Cab">
            </form>
            <p id="confirmation-message" style="display: none;">Booking confirmed. Details will be sent to your email.</p>
        </div>
    </div>

    <div id="result"></div>
    <script src="script.js"></script>
</body>
</html>
