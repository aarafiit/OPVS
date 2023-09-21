<?php
session_start(); // Start the session (if not already started)

if (!isset($_SESSION["sb_email"])) {
    // Redirect the user to the login page
    header("Location: /M-3/M_3-login.php");
    exit(); // Make sure to exit after a header redirection
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "opvs";




// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedPoliceId'])) {
    // $selectedPoliceId = $_POST['selectedPoliceId'];
    // $selectedPoliceId = $_SESSION['police_id'];
    // if(isset($_GET['param'])){
    //     $selectedPoliceId = $_GET['param'];
    //     // Now, $parameter contains the value passed from the previous page
    //     // You can use it as needed
    // }


    // header("Location: M_3-Home.php");
    // exit;
    // if(isset($_GET['param'])){
        $selectedPoliceId = $_GET['param1'];
    // }


    $formNo = $_SESSION['formId'];


    
    // $formId = $_GET['param2'];
        // echo "$selectedPoliceId";
    // $formId = $_SESSION['form_id_sb'];

    // Update the 'police_id' in the 'form_info' table
    // Replace 'form_info' with your actual table name
    $sql = "UPDATE form_info SET police_id = $selectedPoliceId , status = 'officer' WHERE form_id = $formNo ";

    if ($conn->query($sql) === TRUE) {
        header("Location: M_3-Home.php");
    exit;
    } else {
        echo "Error updating Police ID: " . $conn->error;
    }
// }

// Close the database connection
$conn->close();
?>
