<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Homepage</title>
</head>
<body>
    <div class="container">
        
        <img style="height: 25%; width:100%; border-radius: 20px;" src="homepage.png">
        <div class="button-group">
            <button class="button verification-button" id="request-button" onclick="window.location.href='newrequest.html';" style="background-color: blue;">
                <i class="fas fa-file-alt"></i> Verification Request
            </button>
            <button class="button new-button" onclick="window.location.href='M-1_P-New.html';" style="background-color: rgb(82, 9, 78);">
                <i class="fa-solid fa-plus"></i> New Page
            </button>
            <button class="button cases-button" onclick="window.location.href='complete.html';" style="background-color: rgb(9, 51, 78);">
                <i class="fa-solid fa-clipboard-list"></i> Complete File
            </button>
            <button class="button profile-button" onclick="window.location.href='pending.html';"
            style="background-color: rgb(56, 75, 13);">
                <i class="fa-solid fa-file"></i> Pending File
            </button>

            <button class="button profile-button" onclick="window.location.href='M-1_P-1.html';"style="background-color:  rgb(71, 6, 6);;">
                <i class="fa-solid fa-right-from-bracket"></i> Log Out
            </button>
           
        </div>
    </div>
    <!-- Add this script to your HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Assuming you have the notificationCount from PHP
        var notificationCount = <?php echo $notificationCount; ?>;
        
        if (notificationCount > 0) {
            // Display the notification count on the button
            $('#request-button').html('<i class="fas fa-file-alt"></i> Verification Request (' + notificationCount + ')');
        }
    });
</script>

</body>
</html>



<?php
// Your database connection code here

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

// Assuming you have the user's ID in $userId
$sql = "SELECT COUNT(*) AS notificationCount FROM notification WHERE user_id = :userId AND is_read = 0";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$notificationCount = $stmt->fetchColumn();
?>

