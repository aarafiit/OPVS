<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];
    $confirmedPassword = $_POST['confirmPassword'];

    $tempPass = $_SESSION['temporaryPassword'];

    $tempPass2 = $_POST['temporary_password'];

    // Check if the new password and confirmed password match
    if ($newPassword === $confirmedPassword) {
        $userEmail = $_SESSION['userEmail'];

        include "connection.php";

        // Hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $updatePasswordSql = "UPDATE sb SET password = '$newPassword' WHERE email = '$userEmail'";
        // $updatePasswordSql = "UPDATE individual_user SET joining_id = '100' WHERE email = '$userEmail'";
        echo 'success';
        if ($conn->query($updatePasswordSql)) {
            echo "<script>window.location.href = 'M_3-login.php';</script>";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "New password and confirmed password do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="/M-1/changePassword.css">
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <p>Enter your new password below.</p>
        <form action="" method="post">
        <label for="temporary_password">Temporary Password:</label>
            <input type="text" id="temporary_password" name="temporary_password" required>
            <label for="new_password">New Password:</label>

            <input type="password" id="new_password" name="newPassword" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirmPassword" required>

            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
