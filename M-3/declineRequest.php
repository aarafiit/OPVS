
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
            // Database connection parameters
            if (!isset($_SESSION["sb_email"])) {
                // Redirect the user to the login page
                header("Location: /M-3/M_3-login.php");
                exit(); // Make sure to exit after a header redirection
            }
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";

            

            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            // $insMail = $_SESSION['inst_email'];
            $formId = $_SESSION['form_id_sb'];


            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //email = '$insMail' AND

            if(isset($_GET['param'])){
                $formId = $_GET['param'];
                // Now, $parameter contains the value passed from the previous page
                // You can use it as needed
            }
            $sql1 = "UPDATE form_info SET status = 'Rejected by SB' WHERE  form_id = $formId;";
            $result2 = $conn->query($sql1);

            if ($result2 === false) {
                echo "Error: " . mysqli_error($conn);
            }
            

            // SQL query to select names where status is 'institute'
            $sql = "SELECT * FROM form_info WHERE status = 'police'";
            $result = $conn->query($sql);



            if ($result->num_rows >= 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['form_id'] = $row['form_id'];
                    $formId = $row['form_id'];
                    // $formId = $row['form_id'];
                    echo "<tr>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo '<td>
                    <button class="accept-button" style="background-color: green; color: antiquewhite;" onclick = "redirectToAnotherPage1('.$formId.')">Accept and send to SB</button>
                    <button class="decline-button" style="background-color: red; onclick = "redirectToAnotherPage2('.$formId.')" ">Decline</button>
                    <button class="decline-button" style="background-color: black; color : white;" onclick = "redirectToAnotherPage('.$formId.')">View</button>                 
      
                           
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
        function redirectToAnotherPage() {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-2/viewform.php';
        var newPageUrl = '/M-2/afteracceptingform.php?param=' + encodeURIComponent(parameter);
    // Use window.location to change the page location
        window.location.href = newPageUrl;
}      function redirectToAnotherPage2() {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-3/declineRequest.php';
        var newPageUrl = '/M-3/declineRequest.php?param=' + encodeURIComponent(parameter);
    // Use window.location to change the page location
        window.location.href = newPageUrl;
}
function redirectToAnotherPage1() {
    // Specify the URL of the page you want to navigate to and include the form ID as a parameter
        // var newPageUrl = '/M-3/declineRequest.php';
        var newPageUrl = '/M-3/M3viewfRequestedorm.php?param=' + encodeURIComponent(parameter);
    // Use window.location to change the page location
        window.location.href = newPageUrl;
}

    </script>
    </div>
</body>
</html>






















