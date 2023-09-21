




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="m4styles.css">
</head>
<body>
    <div class="header" style="position: fixed;width : 100%;">
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


    <div class="content" style="margin-left: 6%;
    padding: 109px;
    margin-top: 0px;">
        <?php

        session_start();
        // Database connection parameters

        if (!isset($_SESSION["inst_email"])) {
            // Redirect the user to the login page
            header("Location: /M-2/M-2_login.php");
            exit(); // Make sure to exit after a header redirection
        }

        // if (isset($_SESSION['form_id'])) {
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

        // Retrieve the form ID from the URL parameter
        if(isset($_GET['param'])){
            $formId = $_GET['param'];
            // Now, $parameter contains the value passed from the previous page
            // You can use it as needed
            }

        $institute = $_SESSION['inst_email'];

        // SQL query to select data based on the form ID
        $sql = "SELECT * FROM form_info WHERE form_id = $formId and institute_email = '$institute'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output the form information
            while ($row = $result->fetch_assoc()) {
                echo "<h2>Form Information</h2>";
                echo "<p>Full Name: " . $row["full_name"] . "</p>";
                echo "<p>Date of Birth: " . $row["date_of_birth"] . "</p>";
                    echo "<p><strong>Father's Name:</strong> " . $row['father_name'] . "</p>";
                    echo "<p><strong>Nationality:</strong> " . $row['nationality'] . "</p>";
                    echo "<p><strong>Present Address:</strong> " . $row['present_address'] . "</p>";
                    echo "<p><strong>Permanent Address:</strong> " . $row['parmanent_address'] . "</p>";
                    echo "<p><strong>Date of Birth:</strong> " . $row['date_of_birth'] . "</p>";
                    echo "<p><strong>Birth Place:</strong> " . $row['birth_place'] . "</p>";
                    echo "<p><strong>Child of Freedom Fighter:</strong> " . $row['ffq'] . "</p>";
                    echo "<p><strong>Disability:</strong> " . $row['disability'] . "</p>";
                    echo "<p><strong>Marital Status:</strong> " . $row['marital_status'] . "</p>";
                    echo "<h2>Status : </h2>";
                    echo "<p>" . $row['status'] . "</p>";
                   
                    // if($row['status'] == 'requestor'){
                    //     echo "<p>" . 'All information is correct and varified.' . "</p>";
                    // }
                    // else  if($row['status'] != 'officer' || $row['status'] != 'institute' || $row['status'] != 'police'){
                    //     echo "<p>" . $row['status'] . "</p>";
                    // }
                    $formno = $row['form_id'];

                    $dbHost = 'localhost';
                    $dbName = 'opvs';
                    $dbUser = 'root';
                    $dbPassword = '';
                    try {
                        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pdo->exec("SET CHARACTER SET utf8");
                    } catch (PDOException $e) {
                        die("Database connection failed: " . $e->getMessage());
                    }

                    $selectEducationalQualificationsQuery = "SELECT * FROM educational_qualification WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectEducationalQualificationsQuery);
                    $stmt->bindParam(':userId', $row['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $educationalQualifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h3>Educational Qualifications</h3>";
                    echo "<table>";
                    echo "<thead><tr><th>Institution Name</th><th>Registration/Roll No.</th><th>From</th><th>To</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($educationalQualifications as $qualification) {
                        echo "<tr>";
                        echo "<td>" . $qualification['institute'] . "</td>";
                        echo "<td>" . $qualification['roll'] . "</td>";
                        echo "<td>" . $qualification['studied_from'] . "</td>";
                        echo "<td>" . $qualification['studied_to'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";


                    $selectplacesQuery = "SELECT * FROM stayed_places WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $row['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $places = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                    echo "<h3>Places Stayed last 5 years</h3>";
                    echo "<table>";
                    echo "<thead><tr><th>Address</th><th>From</th><th>To</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($places as $place) {
                        
                        echo "<tr>";
                        echo "<td>" . $place['adress'] . "</td>";  //adress, stayed_from, stayed_to
                        echo "<td>" . $place['stayed_from'] . "</td>";
                        echo "<td>" . $place['stayed_to'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";

                    $selectplacesQuery = "SELECT * FROM work_history WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $row['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    echo "<h3>Work history :</h3>";
                    echo "<table>";
                    echo "<thead><tr><th>Institute/ Business Name</th><th>From</th><th>To</th><th>Reason Of leaving</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($works as $work) {
                        echo "<tr>";
                        echo "<td>" . $work['workplace_name'] . "</td>";  
                        echo "<td>" . $work['worked_from'] . "</td>";
                        echo "<td>" . $work['worked_to'] . "</td>";
                        echo "<td>" . $work['reason_of_leaving'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";



                    $selectplacesQuery = "SELECT * FROM relatives WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $row['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    echo "<h3>Relatives in Govt Job : </h3>";
                    echo "<table>";
                    echo "<thead><tr><th>name</th><th>designation</th><th>Institution</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($works as $work) {
                        echo "<tr>";
                        echo "<td>" . $work['name'] . "</td>";  //adress, stayed_from, stayed_to
                        echo "<td>" . $work['designation'] . "</td>";
                        echo "<td>" . $work['institution'] . "</td>";
                       
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";


                    $selectplacesQuery = "SELECT * FROM reference WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $row['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    echo "<h3>Reference : </h3>";
                    echo "<table>";
                    echo "<thead><tr><th>name</th><th>Address</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($works as $work) {
                        echo "<tr>";
                        echo "<td>" . $work['name'] . "</td>";  //adress, stayed_from, stayed_to
                        echo "<td>" . $work['address'] . "</td>";
                        
                       
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";


                    





                // Add more fields as needed
            }
        } else {
            echo "<p>Form ID not found.</p>";
        }
        $conn->close();
        // else {
        //     echo "<p>Form ID not founds.</p>";
        // }
        ?>
    </div>
</body>
</html>

