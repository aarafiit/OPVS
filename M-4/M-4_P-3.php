
<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $police_id = $_POST['police_id'];
    $password = $_POST['password'];
    $designation = $_POST['designation'];
    $official_mail = $_POST['official_mail'];
    $district_name = $_POST['district_name'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $verification_code=$_POST['$verification_code'];
    $_SESSION['userEmail'] = $official_mail;
    $_SESSION['sendEmailFunction'] = 'sendEmail';
    include 'connection.php';
    include 'emailSender.php';

    $checkEmailQuery = "SELECT official_mail FROM police WHERE official_mail = '$official_mail'";
    $emailResult = $conn->query($checkEmailQuery);

    if ($emailResult->num_rows > 0) {
        // Email is already registered, handle this case
        echo "<script>
                    alert('The email is already registered!'); window.location.href = 'M-4_P-3.php';
                  </script>";
    } 
    else {
    

    $verification_code = rand(100000, 999999);

    // Store the verification code in your database along with the user's email
    $sql = "INSERT INTO police (police_id,designation,official_mail,password,verification_code,district_name)
            VALUES ('$police_id', '$designation', '$official_mail', '$hashedPassword','$verification_code','$district_name')";

    if ($conn->query($sql) === TRUE) {
        
        if (sendEmail($official_mail, $verification_code)) {
            echo "<script> window.location.href = 'M-4_P-OTP.php';</script>";
            exit;
        } else {
            echo "<script>alert('Email could not be sent!!'); window.location.href = 'M-4_P-3.php';</script>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>alert('issue!!'); window.location.href = 'registration.php';</script>";
    }

    // Close the database connection
    $conn->close();
}

}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="boxicons/css/boxicons.css">
    <!--fontawesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>login</title>
</head>

<body>

<form action="" method="post" onsubmit="return validateForm();">
        <!-- <table align="center">
            <tr> -->
                <!-- police_id,designation,official_mail,password,verification_code,district_name -->
                <!-- <td align="center" style="background-color: rgb(185, 182, 179)" width="700" height="700"> -->
                    <div class="box">
                        <div class="container">
                            <div class="top-header">
                                <span style="margin-left: 145px;">Online Police Verification System</span>
                                <br>
                                <header style="color: blue;margin-left: 145px;"><b>Sign In</b></header>
                                <br>
                            </div>
                            <div class="input-field">
                                <input style="background-color: rgb(205, 228, 220); width:250px;height:10%;border-radius: 10px;" type="text" class="input" name="police_id" placeholder="Police Id" required>
                            </div>
                            <br>
                            <div class="input-field">
                                <select style="background-color: rgb(205, 228, 220); width:250px;height:10%;border-radius: 10px;" class="input" name="designation" required>
                                    <option value="1">Designation</option>
                                    <option value="Deputy Inspector General (DIG)">Deputy Inspector General (DIG)</option>
                                    <option value="Addl. Deputy Inspector General">Addl. Deputy Inspector General</option>
                                    <option value="Sr. Assistant Superintendent of Police">Sr. Assistant Superintendent of Police</option>
                                    <option value="Assistant Superintendent of Police">Assistant Superintendent of Police</option>
                                    <option value="Inspector of Police (unarmed)">Inspector of Police (unarmed)</option>
                                </select>
                            </div>
                            <br>
                            <div class="input-field">
                                <input style="background-color: rgb(205, 228, 220); width:250px;height:10%;border-radius: 10px;" type="text" class="input" name="official_mail" placeholder="Offical Email" required>
                                <br><br> 
             <input style="background-color: rgb(205, 228, 220); margin-left : 144px; width:250px;height:35px;border-radius: 5px;"type="password" id="pasword" name="password"  placeholder = "Password" required>    <br><br>    
            <input style="background-color: rgb(205, 228, 220); margin-left : 144px; width:250px;height:35px;border-radius: 5px;"type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                            <br>
                            <div class="input-field1">
                                <select id="divisionSelect" style="background-color: rgb(205, 228, 220); width:250px;height:10%;border-radius: 10px;" class="input" name="district_name">
                                    <option value="default" selected>Select Division</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <!-- Add more divisions here -->
                                </select>
                            </div>

                            <br>
                            <div class="input-field">
                                <input style="width:200px;height:35px;margin-left : 160px;border-radius: 5px; color: aliceblue; background-color: blue;" type="Submit" class="submit" value="Register" required>
                            </div>
                <!-- <td><img src="" ></td> -->
            <!-- </tr>
        </table> -->
    </form>

    <script>
    
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            // var passwordMismatchMessage = document.getElementById("passwordMismatch");

            if (password !== confirmPassword) {
                // passwordMismatchMessage.textContent = "Passwords do not match!";
                alert('Passwords do not match!');
                return false; // Prevent form submission
            } else {
                // passwordMismatchMessage.textContent = "";
                return true; // Allow form submission
            }
        }


    </script>
</body>

</html>
