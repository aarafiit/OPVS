<?php


    require __DIR__ . "/vendor/autoload.php";







// require '/M-1/vendor/autoload.php'; // Include Composer's autoloader
use Dompdf\Dompdf;
use Dompdf\Options;

// Create an instance of Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// HTML content to capture
$html = '<html>
            <head>
                <title>My Information</title>
            </head>
            <body>
                <div class="container">
                    ' . getContentFromDatabase() . '
                </div>
            </body>
        </html>';

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation (optional)
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Output the PDF to the browser for viewing and prompt download
$dompdf->stream('my_info.pdf', ['Attachment' => 1]);

// Function to get content from the database (replace with your logic)
function getContentFromDatabase() {
    // Replace this with your logic to retrieve and format the content from the database
    // For demonstration purposes, returning a simple message here
    // Initialize the HTML content variable
    $html = "";

    // Add the My Information heading
    $html .= "<h2>My Information</h2>";

    // Retrieve data from the database based on the user's email
    session_start();
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

        // Query to retrieve user's information
        $selectUserInfoQuery = "SELECT * FROM form_info WHERE email = :userEmail AND form_id = (SELECT MAX(form_id) FROM form_info WHERE email = :userEmail)";
        $stmt = $pdo->prepare($selectUserInfoQuery);
        $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userInfo) {
            // Format the user information as HTML
            $html .= "<p><strong>Full Name:</strong> " . $userInfo['full_name'] . "</p>";
            $html .= "<p><strong>Father's Name:</strong> " . $userInfo['father_name'] . "</p>";
            $html .= "<p><strong>Nationality:</strong> " . $userInfo['nationality'] . "</p>";
            $html .= "<p><strong>Present Address:</strong> " . $userInfo['present_address'] . "</p>";
            $html .= "<p><strong>Permanent Address:</strong> " . $userInfo['parmanent_address'] . "</p>";
            $html .= "<p><strong>Date of Birth:</strong> " . $userInfo['date_of_birth'] . "</p>";
            $html .= "<p><strong>Birth Place:</strong> " . $userInfo['birth_place'] . "</p>";
            $html .= "<p><strong>Child of Freedom Fighter:</strong> " . $userInfo['ffq'] . "</p>";
            $html .= "<p><strong>Disability:</strong> " . $userInfo['disability'] . "</p>";
            $html .= "<p><strong>Marital Status:</strong> " . $userInfo['marital_status'] . "</p>";
            
            $selectEducationalQualificationsQuery = "SELECT * FROM educational_qualification WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectEducationalQualificationsQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $educationalQualifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $html .= "<h3>Educational Qualifications</h3>";
                    $html .= "<table>";
                    $html .= "<thead><tr><th>Institution Name</th><th>Registration/Roll No.</th><th>From</th><th>To</th></tr></thead>";
                    $html .= "<tbody>";
                    foreach ($educationalQualifications as $qualification) {
                        $html .= "<tr>";
                        $html .= "<td>" . $qualification['institute'] . "</td>";
                        $html .= "<td>" . $qualification['roll'] . "</td>";
                        $html .= "<td>" . $qualification['studied_from'] . "</td>";
                        $html .= "<td>" . $qualification['studied_to'] . "</td>";
                        $html .= "</tr>";
                    }
                    $html .= "</tbody>";
                    $html .= "</table>";


                    $selectplacesQuery = "SELECT * FROM stayed_places WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $places = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    $html .= "<h3>Places Stayed last 5 years</h3>";
                    $html .= "<table>";
                    $html .= "<thead><tr><th>Address</th><th>From</th><th>To</th></tr></thead>";
                    $html .= "<tbody>";
                    foreach ($places as $place) {
                        $html .= "<tr>";
                        $html .= "<td>" . $place['adress'] . "</td>";  //adress, stayed_from, stayed_to
                        $html .= "<td>" . $place['stayed_from'] . "</td>";
                        $html .= "<td>" . $place['stayed_to'] . "</td>";
                        $html .= "</tr>";
                    }
                    $html .= "</tbody>";
                    $html .= "</table>";



                    $selectplacesQuery = "SELECT * FROM work_history WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    $html .= "<h3>Work history :</h3>";
                    $html .= "<table>";
                    $html .= "<thead><tr><th>Institute/ Business Name</th><th>From</th><th>To</th><th>Reason Of leaving</th></tr></thead>";
                    $html .= "<tbody>";
                    foreach ($works as $work) {
                        $html .= "<tr>";
                        $html .= "<td>" . $work['workplace_name'] . "</td>";  //adress, stayed_from, stayed_to
                        $html .= "<td>" . $work['worked_from'] . "</td>";
                        $html .= "<td>" . $work['worked_to'] . "</td>";
                        $html .= "<td>" . $work['reason_of_leaving'] . "</td>";
                        $html .= "</tr>";
                    }
                    $html .= "</tbody>";
                    $html .= "</table>";


                    $selectplacesQuery = "SELECT * FROM relatives WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    $html .= "<h3>Relatives in Govt Job : </h3>";
                    $html .= "<table>";
                    $html .= "<thead><tr><th>name</th><th>designation</th><th>Institution</th></tr></thead>";
                    $html .= "<tbody>";
                    foreach ($works as $work) {
                        $html .= "<tr>";
                        $html .= "<td>" . $work['name'] . "</td>";  //adress, stayed_from, stayed_to
                        $html .= "<td>" . $work['designation'] . "</td>";
                        $html .= "<td>" . $work['institution'] . "</td>";
                       
                        $html .= "</tr>";
                    }
                    $html .= "</tbody>";
                    $html .= "</table>";


                    $selectplacesQuery = "SELECT * FROM reference WHERE form_id = :userId";
                    $stmt = $pdo->prepare($selectplacesQuery);
                    $stmt->bindParam(':userId', $userInfo['form_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $works = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    $html .= "<h3>Reference : </h3>";
                    $html .= "<table>";
                    $html .= "<thead><tr><th>name</th><th>Address</th></tr></thead>";
                    $html .= "<tbody>";
                    foreach ($works as $work) {
                        $html .= "<tr>";
                        $html .= "<td>" . $work['name'] . "</td>";  //adress, stayed_from, stayed_to
                        $html .= "<td>" . $work['address'] . "</td>";
                        
                       
                        $html .= "</tr>";
                    }
                    $html .= "</tbody>";
                    $html .= "</table>";

            return $html;
        } else {
            return "User information not found.";
        }
    } else {
        return "Email is missing from the session.";
    }
}
?>