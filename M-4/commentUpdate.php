<?php
session_start();
if (!isset(($_SESSION['userEmail']))) {
    // Redirect the user to the login page
    header("Location: /M-4/M-4_P-2.php");
    exit(); // Make sure to exit after a header redirection
}
if (isset($_POST['submit'])) {
    // Assuming you have already established a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "opvs";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $status = $_POST['example'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming you have a form field with the name 'status' containing the new status value
    $newStatus = $_POST['example'];

    // Assuming you have a variable with the ID of the record you want to update
    $recordId = $_SESSION['formformUpdate']; // Replace with the actual record ID

    // Update the status in the database
    $sql = "UPDATE form_info SET status = '$status' WHERE form_id = $recordId";

    if ($conn->query($sql) === TRUE) {
        header("Location: M_4_Home.php");
exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
}
?>

<form action="" method="post">
    <!-- Add your input fields here -->
    <input type="text" name="status" placeholder="New Status">
    <input type="submit" name="submit" value="Update Status">
</form>
