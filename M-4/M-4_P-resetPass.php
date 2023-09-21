<?php

session_start(); 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $official_mail = $_POST['official_mail'];

    include "connection.php";

    // Validate the email (you can add more validation if needed)
    if (!filter_var($official_mail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Generate a random temporary password
    $temporaryPassword = bin2hex(random_bytes(8)); // Change 8 to the desired length

    $_SESSION['temporaryPassword'] = $temporaryPassword;

    $_SESSION['userEmail'] = $official_mail;

    
    $subject = "Password Reset";
    $message = "Your temporary password: $temporaryPassword"; // You can customize the message

    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'jannatietu.nstu@gmail.com'; // Replace with your email address
    $mail->Password = 'zjpohbjujbgehlst '; // Replace with your email password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('jannatietu.nstu@gmail.com', 'Your Name');
    $mail->addAddress($official_mail);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        echo "<script>window.location.href = 'changePassword.php'</script>";
    } else {
        echo "Error sending email: " . $mail->ErrorInfo;
    }    
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="M-4_P-resetPassword.css">
</head>
<body>
    <div class="container">
        <h1>Password Reset</h1>
        <p>Enter your email address to reset your password.</p>
        <form action = "" method="post">
            <label for="official_mail">Official Eail:</label>
            <input type="email" id="official_mail" name="official_mail" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
