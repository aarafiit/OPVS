<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/M-2/HomeCSS.css">
</head>
<body>

<div class="content">

<div class="header">
    <h1>Online Police Verification System</h1>
    <button class="logout-button" style="position: absolute; left : 90%;top:2%;" onclick="window.location.href = 'logOut.php';">Logout</button>
</div>
      <div class="card-row">
        <div class="card">
          <div class="card-content">
            <div class="card-icon">
              <img src="" >
            </div>
            <h2><button style="background: none;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    text-decoration: underline;
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = 'M_4_NewRequest.php'; ">New Cases</button></h2>
            
            
            
            
            
            <h3><?php 
            session_start();
            
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


           
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "SELECT COUNT(*) AS count
            FROM form_info
            INNER JOIN police ON form_info.police_id = police.police_id
            WHERE form_info.status = 'officer' and police.official_mail = '$email'";
          
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo $row["count"] ;
            } else {
                echo "No rows found.";
            }?></h3>

          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-icon">
              <img src="" >
            </div>




            <h2><button style="background: none;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    text-decoration: underline;
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-4/M_4_completedFiles.php'; ">Completed Files</button></h2>
            <h3><?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count
            FROM form_info
            INNER JOIN police ON form_info.police_id = police.police_id
            WHERE (form_info.status != 'institute' or form_info.status != 'police' or form_info.status != 'officer' or form_info.status != 'rejected by institute' or form_info.status != 'rejected by SB')  and police.official_mail = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo $row["count"] ;
            } else {
                echo "No rows found.";
            }?>



            


</body>
</html>
<?php
// session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "opvs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    
$conn->close();
?>