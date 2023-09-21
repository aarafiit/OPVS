<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Police Verification System</title>
    <link rel="stylesheet" href="M-1_P-Status.css">
</head>
<body>
    <!-- Header with Logo -->
    <header class="header">
        <div class="logo">
            <img src="/images/sb-logo.jpeg" alt="Online Police Verification System Logo">
            <h1>Online Police Verification System</h1>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
        <button onclick="window.location.href ='M-1_P-Home.php'; " >Home</button>
        <button onclick="window.location.href ='M-1_P-MyInfo.php'; ">My Info</button>
        <button onclick="window.location.href ='M-1_P-Help.php';">Help</button>
        <button id="current_page" onclick="window.location.href ='M-1_P-Status.php';">Status</button>
        <button onclick="window.location.href='/M-1/logOut.php';">Log Out</button>
      </div>

    <!-- Main Content -->
    <main class="content">
    <?php
            // Retrieve data from the database based on the user's email
            session_start();
            if (!isset($_SESSION["user_email"])) {
                // Redirect the user to the login page
                header("Location: /M-1/M-1_P-2.php");
                exit(); // Make sure to exit after a header redirection
            }
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

            if (isset($_SESSION['user_email'])) {
                $userEmail = $_SESSION['user_email'];
                $userId = $pdo->lastInsertId();
                $selectUserInfoQuery="SELECT * FROM form_info WHERE email = :userEmail AND form_id = (SELECT MAX(form_id) FROM form_info WHERE email = :userEmail)";
                $stmt = $pdo->prepare($selectUserInfoQuery);
                $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
                $stmt->execute();
                $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($userInfo) {
                    echo "<h2>Verification Tracking</h2>";
                    if($userInfo['status'] === 'requestor'){
                        echo "<p><strong>Status of varification : Acctepted and Completed</strong> ";
                    }
                    else if($userInfo['status'] == 'rejected by SB' || $userInfo['status'] == 'rejected by institute'){
                        echo "<p><strong>Status of varification : Rejected!! Fill the form again.</strong> ";
                    }
                    else if($userInfo['status'] == 'police'){
                        echo "<p><strong>Status of varification : Pending</strong> ";
                        echo "<br><br>";
                        echo " Location : ". 'In SB office' . "</p>";
                    }
                    else if($userInfo['status'] == 'institute'){
                        echo "<p><strong>Status of varification : Pending</strong> ";
                        echo "<br>";
                        echo " Location : ". 'In the Institute.' . "</p>";
                        echo "<br>";
                        echo " For Contacts : ". $userInfo['institute_email'] . "</p>";
                    }
                    else if($userInfo['status'] == 'officer'){
                        $policeId = $userInfo['police_id'];
                        $selectUserInfoQuery="SELECT * FROM police WHERE police_id = :policeID";
                        $stmt = $pdo->prepare($selectUserInfoQuery);
                        $stmt->bindParam(':policeID', $policeId, PDO::PARAM_STR);
                        $stmt->execute();
                        $policeInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                        echo "<p><strong>Status of varification : Pending</strong> ";
                        echo "<br>";
                        echo " Location : ". 'To a DSB officer' . "</p>";
                        echo "<br>";
                        echo " For Contacts : <br> Email : ". $policeInfo['official_mail'] . "</p>";
                        echo " Name : ". $policeInfo['name'] . "</p>";
                        echo " Designation : ". $policeInfo['designation'] . "</p>";
                        echo " Phone Number : ". $policeInfo['phone_number'] . "</p>";
                    }  
                    else{
                        echo "<p><strong>Status of varification : Complete</strong> ";
                        echo "<br>";
                        echo " Feedback : ". $userInfo['status'] . "</p>";
                    }
                    
                }
            }
?>
    </main>
</body>
</html>




