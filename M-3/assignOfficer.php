
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/M-2/m4styles.css">

  <style>
    table {
    width: 50%;
    border-collapse: collapse;
    margin-top: 20px;
    position: absolute;
    top: 45%;
    left: 18%;
}

/* Style the table headers */
th {
    background-color: #bd5b53; /* Blue background color for header cells */
    color: white;
    padding: 10px;
    text-align: left;
    border: 1px solid black;
}

/* Style the table rows */
td {
    border: 1px  #ddd;
    padding: 10px;
}

/* Add alternating row background colors for better readability */
/* tr:nth-child(even) {
    background-color: #f2f2f2;
} */

    .centered-row {
        text-align: center;
    }

    .accept-button {
        background-color: green;
        color: antiquewhite;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
    }

    .accept-button:hover {
        background-color: darkgreen;
    }
    select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 25%;
    margin-top: 10px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #007bff; /* Blue color for the button */
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

/* Style the submit button on hover */
input[type="submit"]:hover {
    background-color: #0056b3; /* Darker blue color on hover */
}
/* Style the label */
label {
    font-size: 25px; /* Adjust the font size as needed */
    font-family: 'ITC Benguiat';
    src: url('path/to/itc-benguiat.woff2') format('woff2'),
       url('path/to/itc-benguiat.woff') format('woff');
    font-weight: bold; /* Make the label bold if desired */
    margin-bottom: 10px; /* Add space below the label */
    display: block; /* Make the label a block element to control its placement */
}

</style>


  
</head>
<body>
  <div class="header">
        <img src="/images/sb-logo.jpeg" alt="" width="50" height="50"><h3>Online police verification System</h3>
        <!-- <button id="logoutbutton">Log Out</button> -->
  </div>
  <div class="sidebar">
    <button class="active" onclick="window.location.href='/M-3/M_3-Home.php';">Home</button>
    <button onclick="window.location.href='/M-3/M_3-NewRequest.php';">New Verification Request</button>
    <button onclick="window.location.href='';">Completed File</button>
    <button onclick="window.location.href='/M-3/M_3-Pending.php';">Pending File</button>
    <button  onclick="window.location.href='/M-3/M_3_logOut.php';" >Log Out</button>
  </div>


  <div class="content" style = "margin-left: 10%;padding: 100px;margin-top: -20px;">
    <form action="" method="post"> <!-- Change 'process.php' to the actual processing script -->
        <label for="division">Select District:</label>
        <select id="division" name="division">
        <option value="Dhaka">Dhaka</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Mymensingh">Mymensingh</option>
            <!-- Add more division options as needed -->
        </select>
        <input type="submit" value="Submit">
    </form>
</div>



  
   
    </div>

    


</body>
</html>




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

// Retrieve the selected division from the form submission
if (isset($_POST['division'])) {
    $selectedDivision = $_POST['division'];



    if(isset($_GET['param'])){
        $formId = $_GET['param'];
        // Now, $parameter contains the value passed from the previous page
        // You can use it as needed
    }

    $_SESSION['formId'] = $formId;

    // Use the selected division to fetch the list of police officers from the database
    $sql = "SELECT * FROM police WHERE district_name = '$selectedDivision'";
    $result = $conn->query($sql);


    

    if ($result->num_rows > 0) {
        // Output the list of police officers
        // $row = $result->fetch_assoc();
        // $policeId = $row['police_id'];
        // $sql2 = "SELECT COUNT(*) AS count FROM police WHERE police_id = $policeId";
        // $result2 = $conn->query($sql2);

        echo "<table>";
                    echo "<thead><tr><th>Police ID</th><th>Name</th><th>Designation</th><th>Number of cases assigned</th></tr></thead>";
                    echo "<tbody>";
        while($row = $result->fetch_assoc()){
        $policeId = $row['police_id'];
        $sql2 = "SELECT COUNT(*) AS count FROM police WHERE police_id = $policeId";
        $result2 = $conn->query($sql2);
        $_SESSION['police_id'] = $row['police_id'];
        $row2 = $result2->fetch_assoc();
        $count = $row2['count'];
        echo "<tr class = 'centered-row'>";
                    echo "<td>" . $row["police_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["designation"] . "</td>";
                    echo "<td>" . $count . "</td>";  //.$row['count'].
                    echo '<td>

                   
                            
                            <button class="accept-button" style="background-color: green; color: antiquewhite; margin : -8px -13px -7px -15p;" onclick = "redirectToAnotherPage(' . $policeId . ')">Assign</button>
                           
                          </td>';
       
                    
    } echo "</tbody>";
    echo "</table>";
}
    else {
        echo "No police officers found for the selected division.";
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<script>

function redirectToAnotherPage(parameter1) {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-3/updatePolice.php';
        // var newPageUrl = '/M-3/updatePolice.php?param=' + encodeURIComponent(parameter1,parameter2);
        var newPageUrl = '/M-3/updatePolice.php?param1=' + encodeURIComponent(parameter1);
        //window.location.href = '/M-3/updatePolice.php?param=' + encodeURIComponent(parameter1,parameter2);
    // Use window.location to change the page location
        window.location.href = newPageUrl;

        // alert('kajef');
} 
    </script>

    
    
</body>
</html>












