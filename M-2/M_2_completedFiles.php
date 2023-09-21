
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="m4styles.css">
  
</head>
<body>
  <div class="header">
        <img src="/images/sb-logo.jpeg" alt="" width="50" height="50"><h3>Online police verification System</h3>
        <!-- <button id="logoutbutton">Log Out</button> -->
  </div>
  <div class="sidebar">
    <button class="active" onclick="window.location.href='/M-2/M_2_Home.php';">Home</button>
    <button onclick="window.location.href='/M-2/M_2_NewRequest.php';">New Verification Request</button>
    <button onclick="window.location.href='';">Completed File</button>
    <button onclick="window.location.href='/M-2/M_2_pendingFiles.php';">Pending File</button>
    <button  onclick="window.location.href='/M-2/M-2_logOut.php';" >Log Out</button>
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
            // Database connection parameters
            if (!isset($_SESSION["inst_email"])) {
                // Redirect the user to the login page
                header("Location: /M-2/M-2_login.php");
                exit(); // Make sure to exit after a header redirection
            }
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";

            $institute = $_SESSION['inst_email'];

            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to select names where status is 'institute'
            $sql = "SELECT * FROM form_info WHERE (form_info.status != 'institute' or form_info.status != 'police' or form_info.status != 'officer' or form_info.status != 'rejected by institute' or form_info.status != 'rejected by SB' or form_info.status != 'rejected by institute' or form_info.status != 'requestor') and institute_email = '$institute'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // $_SESSION['form_id'] = $row['form_id'];
                    $_SESSION['inst_email'] = $row['institute_email'];
                    $formIdforcompleteM2 = $row['form_id'];

                    $name = $row['full_name'];



                    echo "<tr>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo '<td>
                            
                            <button class="decline-button" style="background-color: black; color : white;" onclick = "redirectToAnotherPage('.$formIdforcompleteM2.')">View</button>                 
              
                           
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
        function redirectToAnotherPage(parameter) {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-2/M_2_viewCompletedfiles.php';
        var newPageUrl = '/M-2/viewCompletedForm.php?param=' + encodeURIComponent(parameter);

    // Use window.location to change the page location
        window.location.href = newPageUrl;
} 

 












    </script>
    </div>
</body>
</html>













