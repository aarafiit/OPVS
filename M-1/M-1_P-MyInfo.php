<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Police Verification System</title>
    <link rel="stylesheet" href="M-1_P-MyInfo.css">
    <!-- Add this inside your <head> tag -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.0/html2pdf.bundle.min.js"></script>

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
        <button id="current_page" onclick="window.location.href ='M-1_P-MyInfo.php'; ">My Info</button>
        <button onclick="window.location.href ='M-1_P-Help.php';">Help</button>
        <button onclick="window.location.href ='M-1_P-Status.php';">Status</button>
        <button onclick="window.location.href='M-1_P-1.php';">Log Out</button>
      </div>

    <!-- Main Content -->
    <main class="content">

    <div class="container">
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
                // Query to retrieve user's information
                // $selectUserInfoQuery = "SELECT * FROM form_info WHERE email = :userEmail and form_id = :lastupdated ";
                $selectUserInfoQuery="SELECT * FROM form_info WHERE email = :userEmail AND form_id = (SELECT MAX(form_id) FROM form_info WHERE email = :userEmail)";
                $stmt = $pdo->prepare($selectUserInfoQuery);
                //$stmt->bindParam(':userEmail', $userEmail,':lastupdated',$userId, PDO::PARAM_STR);
                $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
                // $stmt->bindParam(':lastupdated', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($userInfo) {
                    echo "<h2>My Information</h2>";
                    echo "<p><strong>Full Name:</strong> " . $userInfo['full_name'] . "</p>";
                    echo "<p><strong>Father's Name:</strong> " . $userInfo['father_name'] . "</p>";
                    echo "<p><strong>Nationality:</strong> " . $userInfo['nationality'] . "</p>";
                    echo "<p><strong>Present Address:</strong> " . $userInfo['present_address'] . "</p>";
                    echo "<p><strong>Permanent Address:</strong> " . $userInfo['parmanent_address'] . "</p>";
                    echo "<p><strong>Date of Birth:</strong> " . $userInfo['date_of_birth'] . "</p>";
                    echo "<p><strong>Birth Place:</strong> " . $userInfo['birth_place'] . "</p>";
                    echo "<p><strong>Child of Freedom Fighter:</strong> " . $userInfo['ffq'] . "</p>";
                    echo "<p><strong>Disability:</strong> " . $userInfo['disability'] . "</p>";
                    echo "<p><strong>Marital Status:</strong> " . $userInfo['marital_status'] . "</p>";
                   
                    $selectEducationalQualificationsQuery = "SELECT * FROM educational_qualification WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectEducationalQualificationsQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
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
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
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
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    echo "<h3>Work history :</h3>";
                    echo "<table>";
                    echo "<thead><tr><th>Institute/ Business Name</th><th>From</th><th>To</th><th>Reason Of leaving</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($works as $work) {
                        echo "<tr>";
                        echo "<td>" . $work['workplace_name'] . "</td>";  //adress, stayed_from, stayed_to
                        echo "<td>" . $work['worked_from'] . "</td>";
                        echo "<td>" . $work['worked_to'] . "</td>";
                        echo "<td>" . $work['reason_of_leaving'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";


                    $selectplacesQuery = "SELECT * FROM relatives WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
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
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
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


                    


                } else {
                    echo "User information not found.";
                }
            } else {
                echo "Email is missing from the session.";
            }
            ?>

            <form action="generatePDF.php">
            <input type="submit" value="Generate PDF">
            </form>
            

        </div>


        <!-- <script>
    document.getElementById("downloadPdf").addEventListener("click", function () {
        // Create a new jsPDF instance
        var doc = new jsPDF();

        // Define the element you want to capture (your .container div)
        var element = document.querySelector(".container");

        // Use html2pdf.js to capture the element as an image and add it to the PDF
        html2pdf().from(element).outputPdf().then(function (pdf) {
            // Save the PDF with a specific name
            pdf.save("my_info.pdf");
        });
    });
</script> -->

        
    </main>
</body>
</html>
