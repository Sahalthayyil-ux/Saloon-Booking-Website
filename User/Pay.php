<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$amount = $_GET['amount'];
if(isset($_POST['btn_payment']))
{
    $update = "update tbl_booking set booking_status=3 where booking_id=".$_GET['bid'];
    if($con->query($update))
    {
        ?>
        <script>
        window.location = "Loader.html";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Salon Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    :root {
        --primary: #7e81ff;
        --primary-dark: #7e81ff;
        --secondary: #7AF0FF;
        --dark: #2E2E2E;
        --light: #F8F8F8;
        --gray: #E0E0E0;
        --success: #4BB543;
    }
    
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--light);
        color: var(--dark);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    
    .payment-wrapper {
        width: 100%;
        max-width: 480px;
    }
    
    .payment-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .payment-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 28px;
        text-align: center;
        position: relative;
    }
    
    .payment-header::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 0;
        width: 100%;
        height: 40px;
        background: white;
        border-radius: 50% 50% 0 0 / 30px;
    }
    
    .payment-icon {
        font-size: 42px;
        margin-bottom: 12px;
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        width: 80px;
        height: 80px;
        line-height: 80px;
        border-radius: 50%;
    }
    
    .payment-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .payment-subtitle {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .payment-body {
        padding: 32px;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 14px;
        color: var(--dark);
    }
    
    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--gray);
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
        background: white;
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 126, 185, 0.2);
        outline: none;
    }
    
    .form-row {
        display: flex;
        gap: 16px;
    }
    
    .form-col {
        flex: 1;
    }
    
    .amount-display {
        background: rgba(255, 126, 185, 0.1);
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        margin: 28px 0;
        border: 1px dashed var(--primary);
    }
    
    .amount-label {
        font-size: 14px;
        color: var(--primary-dark);
        margin-bottom: 4px;
    }
    
    .amount-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-dark);
    }
    
    .btn-pay {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        width: 100%;
        padding: 16px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 126, 185, 0.3);
    }
    
    .payment-methods {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 20px;
        background: var(--light);
        border-top: 1px solid var(--gray);
    }
    
    .payment-method {
        font-size: 32px;
        color: var(--dark);
        opacity: 0.7;
        transition: all 0.3s;
    }
    
    .payment-method:hover {
        opacity: 1;
        transform: translateY(-3px);
    }
    
    .fa-cc-visa {
        color: #1A1F71;
    }
    
    .fa-cc-mastercard {
        color: #EB001B;
    }
    
    .fa-cc-paypal {
        color: #003087;
    }
    
    @media (max-width: 480px) {
        .payment-body {
            padding: 24px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 24px;
        }
    }
</style>

<body>
    <form action="" method="post">
        <div class="payment-wrapper">
            <div class="payment-card">
                <div class="payment-header">
                    <div class="payment-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h1 class="payment-title">Complete Your Booking</h1>
                    <p class="payment-subtitle">Secure payment for your salon experience</p>
                </div>
                
                <div class="payment-body">
                    <div class="form-group">
                        <label for="credit-card" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="credit-card" required autocomplete="off"
                            placeholder="1234 5678 9012 3456" title="Enter Correct Card Number" maxlength="19"
                            name="txtacno">
                    </div>
                    
                    <div class="form-group">
                        <label for="card-name" class="form-label">Cardholder Name</label>
                        <input type="text" class="form-control" name="txtname" required autocomplete="off"
                            pattern="[a-zA-z ]{3,15}" title="Enter Correct Name" minlength="3" 
                            placeholder="Name on Card">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="credit-card-exp" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="credit-card-exp" name="txtexpdate" 
                                required autocomplete="off" placeholder="MM/YY" pattern="[0-9/]{5,5}"
                                title="Enter Correct Date" minlength="5" maxlength="5">
                            <span id="datecheck"></span>
                        </div>
                        
                        <div class="form-col">
                            <label for="credit-card-ccv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="credit-card-ccv" name="txtccv" 
                                required autocomplete="off" placeholder="123" pattern="[0-9]{3,3}"
                                title="Enter Correct CVV" minlength="3" maxlength="3">
                        </div>
                    </div>
                    
                    <div class="amount-display">
                        <div class="amount-label">Total Amount</div>
                        <div class="amount-value">₹<?php echo $amount; ?></div>
                    </div>
                    
                    <button type="submit" name="btn_payment" class="btn-pay">
                        <i class="fas fa-lock"></i> Confirm Payment
                    </button>
                </div>
                
                <div class="payment-methods">
                    <i class="fab fa-cc-visa payment-method"></i>
                    <i class="fab fa-cc-mastercard payment-method"></i>
                    <i class="fab fa-cc-paypal payment-method"></i>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const creditCardInput = document.getElementById("credit-card");
        const creditCardExp = document.getElementById("credit-card-exp");
        const creditCardCcv = document.getElementById("credit-card-ccv");

        creditCardInput.addEventListener("input", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            const formattedValue = formatCreditCard(inputValue);
            this.value = formattedValue;
        });

        creditCardExp.addEventListener("input", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            const formattedValue = formatExpirationDate(inputValue);
            this.value = formattedValue;
        });

        // Function to validate expiration date
        function validateExpirationDate(inputValue) {
            const month = inputValue.slice(0, 2); // Extract month (assuming format MMYY)
            const year = inputValue.slice(2, 4); // Extract year (assuming format MMYY)

            // Get current date
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() % 100; // Get last two digits of current year
            const currentMonth = currentDate.getMonth() + 1; // getMonth() returns 0-11, so add 1

            // Validate month is between 1 and 12
            const isValidMonth = /^\d{2}$/.test(month) && parseInt(month, 10) >= 1 && parseInt(month, 10) <= 12;

            // Validate year is equal to or greater than current year
            const isValidYear = /^\d{2}$/.test(year) && parseInt(year, 10) >= currentYear;

            let isValidDate = false;

            if (isValidMonth && isValidYear) {
                const expYear = parseInt(year, 10);
                const expMonth = parseInt(month, 10);

                if (expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth)) {
                    isValidDate = true;
                }
            }

            if (!isValidDate) {
                console.log('Invalid expiration date');
                alert('Invalid expiration date');
                document.getElementById("credit-card-exp").value = '';
            }
        }

        // Event listener for onchange
        creditCardExp.addEventListener("change", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            validateExpirationDate(inputValue);
        });

        creditCardCcv.addEventListener("input", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            const formattedValue = formatCVV(inputValue);
            this.value = formattedValue;
        });
    });

    function formatCreditCard(value) {
        const groups = value.match(/(\d{1,4})/g) || [];
        return groups.join(' ');
    }

    function formatExpirationDate(value) {
        const groups = value.match(/(\d{1,2})/g) || [];
        return groups.join('/').slice(0, 5);
    }

    function formatCVV(value) {
        return value.slice(0, 3);
    }
</script>