<?php
include "M-4_P-OTP.php";

$newOTP = rand(100000, 999999);

$_SESSION['userOTP'] = $newOTP;


$userEmail = $_SESSION['userEmail'];


include 'emailSender.php';

sendEmail($userEmail,$newOTP);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOTP = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'];

    include "connection.php";
   

    $sql = "UPDATE police SET verification_code = '$newOTP' WHERE official_mail = '$userEmail'";
    $result = $conn->query($sql);
    
    

   
    $sql = "SELECT verification_code FROM police WHERE official_mail = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedOTP = $row['verification_code'];

        // Compare the entered OTP with the stored OTP
        if ($newOTP === $storedOTP) {
            echo "<script> window.location.href = 'M-4_P-2.php';</script>";
                exit;
        } else {
            echo "Invalid OTP. Please try again.";
        }
    }
}

?>
