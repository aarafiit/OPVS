<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="M-1_P-OTP.css">
</head>
<body>
    <div class="otp-container">
        <h1>OTP Verification</h1>
        <p>Please enter the OTP sent to your email.</p>
        <form class="otp-input" action = "" method = "post">
            <input type="text" maxlength="1" id="digit1" name = "digit1">
            <input type="text" maxlength="1" id="digit2" name = "digit2">
            <input type="text" maxlength="1" id="digit3" name = "digit3">
            <input type="text" maxlength="1" id="digit4" name = "digit4">
            <input type="text" maxlength="1" id="digit5" name = "digit5">
            <input type="text" maxlength="1" id="digit6" name = "digit6">
        
        <button class="otp-button" type="submit">Verify OTP</button>
        
</form>
<p class="resend-link">Didn't receive the OTP? <a href="resendOTP.php">Resend OTP</a></p>
</div>
    <script>
        const otpInputs = document.querySelectorAll('.otp-input input');

otpInputs.forEach((input, index) => {
    input.addEventListener('input', (event) => {
        if (event.inputType === 'deleteContentBackward' || event.inputType === 'deleteContentForward') {
            // Handle backspace/delete key
            // if (index >= 0) {
                otpInputs[index].focus();
                otpInputs[index].value = ''; // Clear the previous box
            // }
        } else {
            // Handle regular input
            if (index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        }
    });

    // Prevent non-numeric input
    input.addEventListener('keydown', (event) => {
        if (!/^\d$/.test(event.key) && event.key !== 'Backspace') {
            event.preventDefault();
        }
    });
});





    </script>

</body>
</html>




<?php


session_start();


    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOTP = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'];
    

    include "connection.php";
    // include "M-1_P-3.php";

    // Replace 'user_email' with the actual user's email (or mobile number) for whom you want to verify OTP
    $userEmail = $_SESSION['userEmail'];

    // Query the database to get the stored OTP associated with the user's email
    $sql = "SELECT verification_code FROM individual_user WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedOTP = $row['verification_code'];

        // Compare the entered OTP with the stored OTP
        if ($enteredOTP === $storedOTP) {
            echo "<script> window.location.href = 'M-1_P-2.php';</script>";
                exit;
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } else {
        echo "User not found or multiple users with the same email exist.";
    }

    $conn->close();
// } else {
//     echo "Invalid request.";
}
?>

