



<?php

session_start();




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $joiningId = $_POST['joiningId'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['userEmail'] = $email;
    $_SESSION['sendEmailFunction'] = 'sendEmail';
    include 'connection.php';
    include 'emailSender.php';

    $checkEmailQuery = "SELECT email FROM individual_user WHERE email = '$email'";
    $emailResult = $conn->query($checkEmailQuery);

    if ($emailResult->num_rows > 0) {
        // Email is already registered, handle this case
        echo "<script>
                    alert('The email is already registered!'); window.location.href = 'M-1_P-3.php';
                  </script>";
    } else {
    

    $verificationCode = rand(100000, 999999);

    // Store the verification code in your database along with the user's email
    $sql = "INSERT INTO individual_user (email, password, joining_id, verification_code)
            VALUES ('$email', '$hashedPassword', '$joiningId', '$verificationCode')";

    if ($conn->query($sql) === TRUE) {
        // $mail = new PHPMailer(true);

        // try {
            
        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com'; 
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'rafiabdullah748@gmail.com'; 
        //     $mail->Password = 'qszdxafklfjtthdl'; 
        //     $mail->SMTPSecure = 'tls';
        //     $mail->Port = 587;

        //     // Recipients
        //     $mail->setFrom('rafiabdullah748@gmail.com');
        //     $mail->addAddress($email);

        //     // Content
        //     $mail->isHTML(true);
        //     $mail->Subject = 'Email Verification Code : ';
        //     $mail->Body = "Verification Code: $verificationCode";

        //     // Send email
        //     if ($mail->send()) {
        //         echo "<script>alert('OKk!!'); window.location.href = 'M-1_P-OTP.php';</script>";
        //         exit;
        //     } else {
        //         echo "<script>alert('Email could not be sent!!'); window.location.href = 'registration.php';</script>";
        //     }
        // } catch (Exception $e) {
        //     echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        // }
        // include 'emailSender.php';
        if (sendEmail($email, $verificationCode)) {
            echo "<script> window.location.href = 'M-1_P-OTP.php';</script>";
            exit;
        } else {
            echo "<script>alert('Email could not be sent!!'); window.location.href = 'M-1_P-3.php';</script>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>alert('issue!!'); window.location.href = 'registration.php';</script>";
    }

    // Close the database connection
    $conn->close();
}

}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="M-1_P-3.css">
</head>
<body>
    <div id="left">
        <h2>Online Police Verification System Registration</h2>
        <form action="" method="post" onsubmit="return validateForm();">
            
            <input type="text" id="joiningId" name="joiningId" placeholder="Joining Id" required>
            <input type="text" id="code" name="email" placeholder="Email" required>
            <input type="password" id="pasword" name="password"  placeholder = "Password" required>        
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <!-- <p id="passwordMismatch" style="color: red;"></p> -->
            <button type="submit" >Submit</button>
            
        </form>

        

        

    </div>

    <div id="right">
        
    </div>


    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
           

            if (password !== confirmPassword) {
                // passwordMismatchMessage.textContent = "Passwords do not match!";
                alert('Passwords do not match!');
                return false; // Prevent form submission
            } else {
                // passwordMismatchMessage.textContent = "";
                return true; // Allow form submission
            }
        }
    </script>
</body>
</html>