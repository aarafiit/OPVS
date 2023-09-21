<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" type="text/css" href="homeStyle.css"> -->
    <link rel="stylesheet" type="text/css" href="HomeCSS.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ITC+Benguiat&display=swap">
</head>
<body>

<div class="content">

<div class="header">
    <h1>Online Police Verification System</h1>
    <button class="logout-button" style="position: absolute; left : 90%;top:90%;" onclick="window.location.href = '/M-2/M-2_logOut.php';">Logout</button>
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
    /* text-decoration: underline; */
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-2/M_2_NewRequest.php'; ">New Request</button></h2>
            <h3><?php 
            // include('/M-2/check_auth.php');
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";


            $instEmail = $_SESSION['user_email'];
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count FROM form_info WHERE status = 'institute' and institute_email = '$instEmail'";
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
    /* text-decoration: underline; */
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-2/M_2_completedFiles.php'; ">Completed Files</button></h2>
            <h3><?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            $instEmail = $_SESSION['user_email'];
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count FROM form_info WHERE status = 'requestor' and institute_email = '$instEmail'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo $row["count"] ;
            } else {
                echo "No rows found.";
            }?></h3>

          </div>
        </div>
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
    /* text-decoration: underline; */
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-2/M_2_pendingFiles.php'; ">Pending Files</button></h2>


            <h3><?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";
            $instEmail = $_SESSION['user_email'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count FROM form_info WHERE (status = 'police' or status = 'SB' or status = 'officer') and institute_email = '$instEmail' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo $row["count"] ;
            } else {
                echo "No rows found.";
            }?></h3>

          </div>
        </div>

          <div class="card" >
              <div class="card-content">
                <div class="card-icon">
                  <img src="" >
                </div>
                <h2><button style="background: none;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        /* text-decoration: underline; */
        color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-2/M-2_viewInfo.php'; ">Institute Info</button></h2>
        </div>


        
      </div>

     
        


</body>
</html>





