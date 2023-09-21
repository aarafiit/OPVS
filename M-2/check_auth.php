<?php
session_start();

// Check if the user is not logged in (not set in the session)
if (!isset($_SESSION["inst_email"])) {
    // Redirect the user to the login page
    header("Location: /M-2/M-2_login.php");
    exit(); // Make sure to exit after a header redirection
}
?>