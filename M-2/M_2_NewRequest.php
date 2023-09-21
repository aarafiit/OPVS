
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="m4styles.css">
  
</head>
<body>
  <div class="header">
        <img src="/images/sb-logo.jpeg" alt="" width="50" height="50"><h3>Online police verification System</h3>
  </div>
  <div class="sidebar">
    <button class="active" onclick="window.location.href='/M-2/M_2_Home.php';">Home</button>
    <button onclick="window.location.href='/M-2/M_2_NewRequest.php';">New Verification Request</button>
    <button onclick="window.location.href='/M-2/M_2_completedFiles.php';">Completed File</button>
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
            // include('/M-2/check_auth.php');
            if (!isset($_SESSION["inst_email"])) {
                // Redirect the user to the login page
                header("Location: /M-2/M-2_login.php");
                exit(); // Make sure to exit after a header redirection
            }
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";
            $instEmail = $_SESSION['inst_email'];

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM form_info WHERE status = 'institute' and institute_email = '$instEmail'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['form_id'] = $row['form_id'];
                    $_SESSION['inst_email'] = $row['institute_email'];
                  

                    $name = $row['full_name'];
                    $formIdforNewM2 = $row['form_id'];


                    echo "<tr>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo '<td>
                            <button class="accept-button" style="background-color: green; color: antiquewhite;" onclick = "redirectToAnotherPage1('.$formIdforNewM2.')">Accept and send to SB</button>
                            <button class="decline-button" style="background-color: red;" onclick = "redirectToAnotherPage2('.$formIdforNewM2.')">Decline</button>
                            <button class="decline-button" style="background-color: black; color : white;" onclick = "redirectToAnotherPage('.$formIdforNewM2.')">View</button>                 
              
                           
                          </td>';
                    echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='3'>No records found.</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <script>

        function redirectToAnotherPage(parameter) {
            var newPageUrl = '/M-2/viewform.php?param=' + encodeURIComponent(parameter);
            window.location.href = newPageUrl;
        } 

        function redirectToAnotherPage1(parameter) {
                var newPageUrl = '/M-2/afteracceptingform.php?param=' + encodeURIComponent(parameter);
                window.location.href = newPageUrl;
        }  

        function redirectToAnotherPage2(parameter) {
                var newPageUrl = '/M-2/declineRequest.php?param=' + encodeURIComponent(parameter);
                window.location.href = newPageUrl;
        } 


    </script>
    </div>
</body>
</html>













