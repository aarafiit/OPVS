<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Police Verification System</title>
    <link rel="stylesheet" href="M-4_P-2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ITC+Benguiat&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ITC+Benguiat&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div id="left">
        <div id="name">
           <strong>Online Police Verification System</strong> 
        </div>

        <div id="signin">
            <strong>Sign In</strong>
        </div>
       
        <form action="" method="post"> 
            <input type="text" placeholder="official_mail" id="official_mail" name="official_mail" required>
            <input type="password" placeholder="Password" id="password" name="password" required>
            <button type="submit" id="login">Log In</button>
            <div id="password-error" style="color: red;position: fixed;top: 61%;left: 12%;font-size: 15px;font-weight: bold;background-color: greenyellow;"></div> 
        </form>

        <div id="register">
            <p>Forgot your password? <a href="M-4_P-resetPass.php" id="forgotPasswordLink">Reset it</a></p>
            <p>Don't have an account? <a href="M-4_P-3.php" id="registerLink">Register now</a></p>
        </div>
    </div>

    <div id="right"></div>


    
</body>
</html>

 <!-- police_id,designation,official_mail,password,verification_code,district_name -->
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $official_mail = $_POST['official_mail'];
    $password = $_POST['password'];

    include "connection.php";


    $_SESSION['userEmail'] = $official_mail;
    // $_SESSION['police_id'] = 
    
    $sql = "SELECT password	FROM police WHERE official_mail = '$official_mail';";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $passwordfromdb = $row['password']; 

        if (password_verify($password, $passwordfromdb)) {
            echo "<script>window.location.href = 'M_4_Home.php';</script>";
            exit;
        } else {
            echo "<script>
                    document.getElementById('password-error').innerHTML = 'The password is incorrect';
                  </script>";
        }
    }
    else{
        echo "<script>document.getElementById('password-error').innerHTML = 'The password is incorrect';</script>";
    }
   
    $conn->close();
}
?>