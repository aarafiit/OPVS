<?php
require_once ('vendor/autoload.php'); // Include the Google API client library
session_start();

$client = new Google_Client();
$client->setClientId('347765503531-fb31hkg7qeqqucomttp56mtb9jdhikqb.apps.googleusercontent.com'); // Replace with your client ID
$client->setClientSecret('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'); // Replace with your client secret
$client->setRedirectUri('http://localhost/OPVS/index.php'); // Replace with your redirect URI
$client->addScope('email');




if (isset($_GET['code'])) 
{
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
        header('Location: M_2_Home.php'); // Redirect to your dashboard page
        exit;
    } 
    
    else {
        // User has an email from a non-allowed domain, reject the login.
        header('Location: index.php');
        echo 'Give your Edu mail';
    }
} 

else {
    $authUrl = $client->createAuthUrl();
    header("Location: $authUrl");
}







