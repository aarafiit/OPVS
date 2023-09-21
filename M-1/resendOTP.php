<?php
include "M-1_P-OTP.php";


// if (!isset($_SESSION['userEmail'])) {
//     echo "User email not found. Please log in or provide an email.";
//     exit;
// }



// Generate a new OTP
$newOTP = rand(100000, 999999);

// Store the new OTP in the session or your database (you can modify this part as needed)
$_SESSION['userOTP'] = $newOTP;

// Send the new OTP via email (you can reuse your email sending code)
$userEmail = $_SESSION['userEmail'];


include 'emailSender.php';


sendEmail($userEmail,$newOTP);

// echo "New OTP sent to your email: $newOTP";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOTP = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'];

    include "connection.php";
    // include "M-1_P-3.php";

    $sql = "UPDATE individual_user SET verification_code = '$newOTP' WHERE email = '$userEmail'";
    $result = $conn->query($sql);
    // Replace 'user_email' with the actual user's email (or mobile number) for whom you want to verify OTP
    

    // Query the database to get the stored OTP associated with the user's email
    $sql = "SELECT verification_code FROM individual_user WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedOTP = $row['verification_code'];

        // Compare the entered OTP with the stored OTP
        if ($newOTP === $storedOTP) {
            echo "<script> window.location.href = 'M-1_P-2.php';</script>";
                exit;
        } else {
            echo "Invalid OTP. Please try again.";
        }
    }
}

?>
