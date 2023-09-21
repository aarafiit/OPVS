<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/SMTP.php';


function sendEmail($email, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'rafiabdullah748@gmail.com'; // Replace with your email address
        $mail->Password = 'qszdxafklfjtthdl'; // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('rafiabdullah748@gmail.com');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification Code';
        $mail->Body = "Verification Code: $verificationCode";

        // Send email
        if ($mail->send()) {
            return true; // Email sent successfully
        } else {
            return false; // Email could not be sent
        }
    } catch (Exception $e) {
        return false; // Exception occurred
    }
}





?>