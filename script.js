document.addEventListener('DOMContentLoaded', function () {
    const carImages = document.querySelectorAll('.car-image');
    const bookingForm = document.querySelector('.booking-form');
    const resultDiv = document.getElementById('result');

    // Initialize selectedCar, pricePerMinute, and totalMinutes variables
    let selectedCar = '';
    let pricePerMinute = 0;
    let totalMinutes = 0;
    let totalCost = 0;

    // Add a click event listener to each car image
    carImages.forEach(carImage => {
        carImage.addEventListener('click', function () {
            selectedCar = this.parentElement.getAttribute('data-car');
            pricePerMinute = parseFloat(this.parentElement.getAttribute('data-price'));

            // Update the selected car in the form
            document.getElementById('selectedCar').value = selectedCar;

            // Update the price per minute in the form
            document.getElementById('pricePerMinute').value = 'RS-' + pricePerMinute.toFixed(2);

            // Calculate and update the total price
            calculateTotalPrice();

            // Show the booking form
            bookingForm.style.display = 'block';
        });
    });

    function calculateTotalPrice() {
        const timeInHoursInput = document.getElementById('timeInHours');
        const totalPriceInput = document.getElementById('totalPrice');

        timeInHoursInput.addEventListener('input', updateTotalPrice);

        function updateTotalPrice() {
            const timeInHours = parseFloat(timeInHoursInput.value);

            if (!isNaN(timeInHours)) {
                totalMinutes = timeInHours * 60;
                totalCost = pricePerMinute * totalMinutes; // Calculate totalCost here
                totalPriceInput.value = 'RS-' + totalCost.toFixed(2);
            } else {
                totalCost = 0; // Reset totalCost if timeInHours is not a number
                totalPriceInput.value = '';
            }
        }
    }

    function showBookingForm(car, price) {
        const selectedCarInput = document.getElementById('selectedCar');
        const pricePerMinuteInput = document.getElementById('pricePerMinute');
        const bookingForm = document.querySelector('.booking-form');
        const confirmationMessage = document.getElementById('confirmation-message');
    
        selectedCarInput.value = car;
        pricePerMinuteInput.value = price + ' per minute';
        bookingForm.style.display = 'block';
        confirmationMessage.style.display = 'none';
    }
    
    function bookCab() {
        // Handle the form submission here, then display the confirmation message
        // and send details to the user's email using AJAX.
    
        // Replace this with your AJAX request to send details to the user's email.
        // Example success message:
        const confirmationMessage = document.getElementById('confirmation-message');
        confirmationMessage.style.display = 'block';
        return false; // Prevent the form from submitting.
    }
    

    // Handle the form submission
    bookingForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const source = document.getElementById('source').value;
        const destination = document.getElementById('destination').value;
        const email = document.getElementById('email').value;
        const timeInHours = parseFloat(document.getElementById('timeInHours').value);

        if (selectedCar && source && destination && email && !isNaN(timeInHours)) {
            const data = {
                source,
                destination,
                email,
                car: selectedCar,
                pricePerMinute,
                totalCost, // Include the calculated totalCost
            };

            // Send data to book.php using an AJAX request
            fetch('book.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' },
            })
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error(error);
                resultDiv.innerHTML = 'Error occurred.';
            });
        } else {
            resultDiv.innerHTML = 'Please fill in all the required fields and enter a valid time.';
        }
    });
});