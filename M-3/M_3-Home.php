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
    <button class="logout-button" style="position: absolute;
    top: 90%;
    left: 90%;" onclick="window.location.href = '/M-3/M_3_logOut.php';">Logout</button>
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
    
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-3/M_3-NewRequest.php'; ">New Request</button></h2>
            <h3><?php 
            session_start();
            // Check if the user is not logged in (not set in the session)
            if (!isset($_SESSION["sb_email"])) {
                // Redirect the user to the login page
                header("Location: /M-3/M_3-login.php");
                exit(); // Make sure to exit after a header redirection
            }
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";


            // $sbmail = $_SESSION["sb_email"];

            // echo "<script>alert('$sbmail')</script>";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count FROM form_info WHERE status = 'police'";
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
            <h2 style="background: none;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
   
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-3/M_3-Completed.php'; ">Completed files</h2>
            <h3><?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count FROM form_info WHERE (form_info.status != 'institute' or form_info.status != 'police' or form_info.status != 'officer' or form_info.status != 'rejected by institute' or form_info.status != 'rejected by SB' or form_info.status != 'rejected by institute' or form_info.status != 'requestor')";
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
            <h2 style="background: none;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    
    color: inherit;font-size : 25px" id="new-request-button" onclick="window.location.href = '/M-3/M_3-Pending.php';">Pending Files</h2>
            <h3><?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "opvs";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT COUNT(*) AS count FROM form_info WHERE status = 'officer'";
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
    </div>


</body>
</html>





<?php
session_start();
// if (!isset($_SESSION["admin_id"])) {
//   header("Location: http://localhost:3000/signin.php"); // Redirect to the login page if not logged in
//   exit();
// }

// Retrieve admin details from your database based on the admin_id stored in the session
// $admin_id = $_SESSION["admin_id"];

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "opvs";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

    // $sql = "SELECT COUNT(*) FROM form_info WHERE status = 'institute';";
    



// $sql_students = "SELECT COUNT(*) as student_count FROM students";
// $sql_departments = "SELECT COUNT(*) as department_count FROM department";
// $sql_courses = "SELECT COUNT(*) as course_count FROM courses";
// $sql_faculties = "SELECT COUNT(*) as faculty_count FROM faculties";

// Execute the queries
// $result_students = $conn->query($sql_students);
// $result_departments = $conn->query($sql_departments);
// $result_courses = $conn->query($sql_courses);
// $result_faculties = $conn->query($sql_faculties);

// Fetch the counts from the query results
// $row_students = $result_students->fetch_assoc();
// $row_departments = $result_departments->fetch_assoc();
// $row_courses = $result_courses->fetch_assoc();
// $row_faculties = $result_faculties->fetch_assoc();

// Close the database connection
$conn->close();
?>