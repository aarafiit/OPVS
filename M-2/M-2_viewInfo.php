<?php
// Include the authentication check
include('check_auth.php');

// Check if the institute email is set in the session
if (!isset($_SESSION['inst_email'])) {
    // Redirect to the login page if not logged in
    header("Location: /M-2/M-2_logIn.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "opvs";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$instEmail = $_SESSION['inst_email'];

// Query to retrieve institute details
$sql = "SELECT * FROM institute WHERE inst_email = '$instEmail'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row["inst_email"] == "rafi2515@student.nstu.edu.bd"){
        $instName = "Education Ministry";
        $instPhone = "01873228639";
        $instAddress = "Dhaka, Bangladesh";
        $instEmail = "rafi2515@student.nstu.edu.bd";
    }
    

    // $instAddress = $row["address"];
    // $instPhone = $row["phone"];
    // Add more fields as needed
} else {
    echo "Institute details not found.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institute Information</title>
    <link rel="stylesheet" type="text/css" href="HomeCSS.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ITC+Benguiat&display=swap">
</head>
<body>
    <div class="content">
        <div class="header">
            <h1>Online Police Verification System</h1>
            <button class="logout-button" style="position: absolute; left: 90%; top: 90%;" onclick="window.location.href = '/M-2/M-2_logOut.php';">Logout</button>
        </div>

        <div class="institute-info">
            <h2>Institute Information</h2>
            <p><strong>Name:</strong> <?php echo $instName; ?></p>
            <p><strong>Address:</strong> <?php echo $instAddress; ?></p>
            <p><strong>Phone:</strong> <?php echo $instPhone; ?></p>
            <p><strong>Email:</strong> <?php echo $instEmail; ?></p>
            <!-- Add more fields here as needed -->
        </div>
    </div>
</body>
</html>
