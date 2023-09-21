
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
    <button class="active" onclick="window.location.href='M_4_Home.php';">Home</button>
    <button onclick="window.location.href='/M-4/M_4_NewRequest.php';">New Request</button>
    <button onclick="window.location.href='/M-4/M_4_completedFiles.php';">Completed File</button>
    <button  onclick="window.location.href='/M-4/logOut.php';" >Log Out</button>
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
            if (!isset(($_SESSION['userEmail']))) {
                // Redirect the user to the login page
                header("Location: /M-4/M-4_P-2.php");
                exit(); // Make sure to exit after a header redirection
            }
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";


            $email = $_SESSION['userEmail'];



            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //href="m4viewform.php?form_id=<?php echo $formId; 
            // SQL query to select names where status is 'institute'
            $sql = "SELECT *
            FROM form_info
            INNER JOIN police ON form_info.police_id = police.police_id
            WHERE form_info.status = 'officer' and police.official_mail = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                
                ////onclick = "redirectToAnotherPage()"
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['form_id'] = $row['form_id'];
                    $_SESSION['ins_email'] = $row['institute_email'];
                  

                    $name = $row['full_name'];

                    $formId = $row['form_id'];

                    echo "<tr>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo '<td>
                            
                            <button class="decline-button" style="background-color: black; color : white;" onclick = "redirectToAnotherPage('.$formId.')" ">View</button>                 
              
                           
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
        
        var newPageUrl = 'm4viewform.php?param=' + encodeURIComponent(parameter);
        window.location.href = newPageUrl;
} 




    </script>
    </div>
</body>
</html>













