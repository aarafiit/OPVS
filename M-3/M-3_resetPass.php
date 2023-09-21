<?php

session_start(); 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    include "connection.php";

    // Validate the email (you can add more validation if needed)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Generate a random temporary password
    $temporaryPassword = bin2hex(random_bytes(8)); // Change 8 to the desired length

    $_SESSION['temporaryPassword'] = $temporaryPassword;

    $_SESSION['userEmail'] = $email;

    // Hash the temporary password (just like during registration)
    // $hashedTemporaryPassword = password_hash($temporaryPassword, PASSWORD_DEFAULT);

    // Store the hashed temporary password in your database for the user with the provided email
    // You should have a database table to store users and their passwords
    // Update the user's password field with $hashedTemporaryPassword where the email matches

    // $updatePasswordSql = "UPDATE individual_user SET password = '$hashedTemporaryPassword' WHERE email = '$email'";
    // if ($conn->query($updatePasswordSql)) {
    //     // Password updated successfully
    // } else {
    //     echo "Error updating password: " . $conn->error;
    //     exit;
    // }

    // Send the temporary password to the user via email
    $subject = "Password Reset";
    $message = "Your temporary password: $temporaryPassword"; // You can customize the message

    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rafiabdullah748@gmail.com';
    $mail->Password = 'qszdxafklfjtthdl';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('rafiabdullah748@gmail.com', 'Your Name');
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        echo "<script>window.location.href = 'M-3_changePass.php'</script>";
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
    <link rel="stylesheet" href="/M-1/M-1_P-resetPassword.css">
</head>
<body>
    <div class="container">
        <h1>Password Reset</h1>
        <p>Enter your email address to reset your password.</p>
        <form action = "" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
