
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/M-2/m4styles.css">
  
</head>
<body>
  <div class="header">
        <img src="/images/sb-logo.jpeg" alt="" width="50" height="50"><h3>Online police verification System</h3>
        <!-- <button id="logoutbutton">Log Out</button> -->
  </div>
  <div class="sidebar">
    <button class="active" onclick="window.location.href='/M-3/M_3-Home.php';">Home</button>
    <button onclick="window.location.href='/M-3/M_3-NewRequest.php';">New Verification Request</button>
    <button onclick="window.location.href='/M-3/M_3-Completed.php';">Completed File</button>
    <button onclick="window.location.href='/M-3/M_3-Pending.php';">Pending File</button>
    <button  onclick="window.location.href='/M-3/M_3_logOut.php';" >Log Out</button>
  </div>
  
    <div class="content">
        <table>
            <tr>
                <th>File</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php

            session_start();
            // Check if the user is not logged in (not set in the session)
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

            // SQL query to select names where status is 'institute'
            $sql = "SELECT * FROM form_info WHERE status = 'police'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // $_SESSION['form_id_sb'] = $row['form_id'];
                    // $_SESSION['ins_email'] = $row['institute_email'];

                    $formIdforview = $row['form_id'];
                  

                    $name = $row['full_name'];



                    echo "<tr>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo '<td>
                            <button class="accept-button" style="background-color: green; color: antiquewhite;" onclick = "redirectToAnotherPage1('.$formIdforview.')">Assign Officer</button>
                            <button class="decline-button" style="background-color: red;" onclick = "redirectToAnotherPage2('.$formIdforview.')">Decline</button>
                            <button class="decline-button" style="background-color: black; color : white;" onclick = "redirectToAnotherPage3('.$formIdforview.')">View</button>                 
              
                           
                          </td>';
                    echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='3'>No records found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>

        <script>
        function redirectToAnotherPage1(parameter) {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-3/assignOfficer.php';
        var newPageUrl = '/M-3/assignOfficer.php?param=' + encodeURIComponent(parameter);

    // Use window.location to change the page location
        window.location.href = newPageUrl;
} 

function redirectToAnotherPage2(parameter) {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-3/declineRequest.php';
        var newPageUrl = '/M-3/declineRequest.php?param=' + encodeURIComponent(parameter);
    // Use window.location to change the page location
        window.location.href = newPageUrl;
}  


function redirectToAnotherPage3(parameter) {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-3/M3viewfRequestedorm.php';
        var newPageUrl = '/M-3/M3viewfRequestedorm.php?param=' + encodeURIComponent(parameter);
    // Use window.location to change the page location
        window.location.href = newPageUrl;
} 









    </script>
    </div>
</body>
</html>













