

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Police Verification System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ITC+Benguiat&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/M-1/M-1_P-Home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ITC+Benguiat&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php
session_start();

// Check if the user is not logged in (not set in the session)
if (!isset($_SESSION["user_email"])) {
    // Redirect the user to the login page
    header("Location: /M-1/M-1_P-2.php");
    exit(); // Make sure to exit after a header redirection
}

?>
    <header>
        <div class="top-bar">
            <div class="logo">
                <img src="/images/sb-logo.jpeg" alt="Logo">
                <h1>Online Police Verification System</h1>
            </div>
        </div>
    </header>

    <div class="buttons">
        <a href="M-1_P-New.php" class="button" id="new-button">
            <i class="fa-duotone fa-plus"></i>
            <span>New</span>
        </a>
        <a href="M-1_P-Status.php" class="button" id="status-button">
            <!-- <img src="New folder (2)/OPVS/images/status-logo.png" alt="Status"> -->
            <i class="fa-solid fa-circle-check"></i>
            <span>Status</span>
        </a>
        <a href="M-1_P-MyInfo.php" class="button" id="myinfo-button">
            <!-- <img src="New folder (2)/OPVS/images/helpdesk-logo.png" alt="My Info"> -->
            <i class="fa-solid fa-circle-info"></i>
            <span>My Info</span>
        </a>
        <a href="M-1_P-Help.php" class="button" id="helpdesk-button">
            <!-- <img src="New folder (2)/OPVS/images/myinfo-logo.png" alt="Help Desk"> -->
            <i class="fa-solid fa-handshake-angle"></i>
            <span>Help Desk</span>
        </a>

        <a href="/M-1/logOut.php" class="button" id="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Log Out</span>
        </a>


    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                <img src="/images/logo.png" alt="Logo">
                <!-- <h2>Online Police Verification System</h2> -->
                @All rights reserved by IIT,NSTU
            </div>
            <ul>
                <li><a href="M-1_P-PP.php">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="M-1_P-Contacts.php">Contact Us</a></li>
            </ul>
        </div>
    </footer>
    
    

    
</body>
</html>


