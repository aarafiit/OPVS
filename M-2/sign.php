<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/M-1/M-1_P-2.css">
</head>
<body>
    <div id="left">


        <div id="name">
           <strong>Online Police Verification System</strong> 
        </div>

        <div id="signin">
            <strong>Sign In</strong>
        </div>

        <input type="text" placeholder="Institute ID" id="joiningId" required>
        <br>
        <br>
        <input type="text" placeholder="Code" id="code" required>

        <br>
        <br>
        <button id="login" onclick="window.location.href = '/M-2/HomeF.php'; ">Log In</button>

        <div id="register">
            <p>Forgot your password? <a href="M-1_P-resetPass.html" id="forgotPasswordLink">Reset it</a></p>
            <p>Don't have an account? <a href="signup.html" id="registerLink">Register now</a></p>
        </div>

        

       

    </div>

    <div id="right">

    </div>

   
</body>
</html>