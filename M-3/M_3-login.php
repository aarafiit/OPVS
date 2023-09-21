<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/M-1/M-1_P-2.css">
    <style>
        #login{
            top : 35%;
            left : 35%;
        }
    </style>
</head>
<body>
    <div id="left">


        <div id="name">
           <strong>Online Police Verification System</strong> 
        </div>

        <form action="" method="post"> 
            <input type="text" placeholder="Email" id="email" name="email" required>
            <input type="password" placeholder="Password" id="password" name="password" required>
            <!-- <button type="submit" id="login">Log In</button> -->
            <div id="password-error" style="color: red;position: fixed;top: 61%;left: 12%;font-size: 15px;font-weight: bold;background-color: greenyellow;"></div>
            <button type="submit" style="position: absolute;top : 60%;left : 15%">Log In</button>
        </form>

        <div id="register">
            <p>Forgot your password? <a href="M-3_resetPass.php" id="forgotPasswordLink">Reset it</a></p>
        </div>

        <button id="login" style="position: absolute; top : 75%; left : 15%;" onclick="window.location.href = '/M-3/M_3-Home.php';">Log In with google</button>

      

        

       

    </div>

    <div id="right">

    </div>

   
</body>
</html>


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $_SESSION['sb_email'] = $email;

    // Replace these with your database credentials
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "opvs";

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input to prevent SQL injection (you should use prepared statements)
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // SQL query to verify the email and password
    $sql = "SELECT * FROM sb WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        // Login successful
        $_SESSION["sb_email"] = $email;
        header("Location: M_3-Home.php"); 
    } else {
        // Login failed
        echo "Incorrect email or password";
    }

    // Close the database connection
    $conn->close();
}
?>
