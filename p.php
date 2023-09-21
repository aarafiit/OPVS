<?php
require_once ('vendor/autoload.php'); // Include the Google API client library
session_start();

if (isset($_POST['login_with_google'])) {
    $enteredEmail = $_POST['email'];



    $databaseHost = 'localhost';
    $databaseUser = 'root';
    $databasePassword = '';
    $databaseName = 'opvs';

    $connection = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM institute WHERE inst_email = '$enteredEmail'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $client = new Google_Client();
$client->setClientId('347765503531-fb31hkg7qeqqucomttp56mtb9jdhikqb.apps.googleusercontent.com'); // Replace with your client ID
$client->setClientSecret('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'); // Replace with your client secret
$client->setRedirectUri('http://localhost/OPVS/index.php'); // Replace with your redirect URI
$client->addScope('email');

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);
        
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
        
            // Check if the user's email domain is allowed (e.g., edu domain)
            $allowedDomain = 'student.nstu.edu.bd';
            $userEmail = $userInfo->getEmail();
        
            if (strpos($userEmail, "@{$allowedDomain}") !== false) {
                // User has an allowed domain, log them in.
                $_SESSION['user_email'] = $userEmail;
                header('Location: /M-2/M_2_Home.php'); // Redirect to your dashboard page
                exit; // Add an exit statement here to prevent further execution
            } else {
                // User has an email from a non-allowed domain, reject the login.
                echo 'Invalid domain'; // Debugging statement
                header('Location: index.php');
                exit; // Add an exit statement here
            }
        } else {
            $authUrl = $client->createAuthUrl();
            header("Location: $authUrl");
            exit; // Add an exit statement here
        }
    } else {
        // User email not found in the database
        echo 'Email not found in the database'; // Debugging statement
        header('Location: index1.php');
        exit; // Add an exit statement here
    }
}
?>
