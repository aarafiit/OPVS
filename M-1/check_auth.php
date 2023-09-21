<?php
session_start();

// Check if the user is not logged in (not set in the session)
if (!isset($_SESSION["user_email"])) {
    // Redirect the user to the login page
    header("Location: /M-1/M-1_P-2.php");
    exit(); // Make sure to exit after a header redirection
}
?>