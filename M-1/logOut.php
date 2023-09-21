<?php
// Start or resume the session
session_start();

// Destroy the session data
session_destroy();

// Redirect to the login page or any other page as needed
header("Location: M-1_P-1.php"); // Replace with the appropriate URL
exit();
?>