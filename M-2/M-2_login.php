<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institute Log IN</title>
    <!-- <link rel="stylesheet" href="/M-1/M-1_P-2.css"> -->
    <link rel="stylesheet" href="/M-2/loginTest.css">
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
            <input type="text" placeholder="Institute Email" id="email" name="email" required>
            
            <div id="password-container">
                <input type="password" placeholder="Password" id="password" name="password" required >
                <span id="toggle-password" onclick="togglePasswordVisibility()">&#x1F441;</span>
            </div>
            <!-- <div id="password-error"><p id="password-error-show"></p></div> -->
            <button type="submit" style="position: absolute;top : 65%;left : 10%">Log In</button>
        </form>


        <div id="register">
            <p>Forgot your password? <a href="/M-2/M-2_resetPass.php" id="forgotPasswordLink">Reset it</a></p>
        </div>

        <button id="login" style="position: absolute; top : 75%; left : 10%;" onclick="window.location.href = '/index1.php';"><img src="/images/939729_google icon_icon.png" width="20px" height="20px" style="vertical-align: middle; margin-right: 10px;">Log In with google</button>
        
      

        

       

    </div>

    <div id="right">

    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.getElementById("toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.innerHTML = "&#x1F440;"; // Eye icon with a slash
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = "&#x1F441;"; // Eye icon
            }
        }

        var errorMessage = "<?php echo $error_message; ?>"; // Get the error message from PHP
        if (errorMessage !== "") {
            var errorContainer = document.getElementById("password-error-show");
            errorContainer.textContent = errorMessage;
            errorContainer.style.display = "block"; // Display the error message div
        }
    </script>

   
</body>
</html>


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

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
    $sql = "SELECT * FROM institute WHERE inst_email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        // Login successful
        $_SESSION["inst_email"] = $email;
        header("Location: M_2_Home.php"); 
    } else {
        // Login failed
        echo "<script>alert('The information is incorrect!'); </script>";
        $error_message =  "Incorrect email or password";
    }

    // Close the database connection
    $conn->close();
}
?>
