<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
        }

        form {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 2px;
            padding: 40px;
            width: 400px;
            margin: 0 auto; /* Center the form horizontally */
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] {
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #357ae8;
        }

        img {
            vertical-align: middle; /* Center the Google icon vertically */
            height: 5px;
            width: 200px;
        }
    </style>
</head>
<body>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="347765503531-fb31hkg7qeqqucomttp56mtb9jdhikqb.apps.googleusercontent.com">
    <h1>Online Police Verification System</h1>
    <form action="p.php" method="post">
        <label for="email">Enter your email:</label>
        <input type="text" id="email" name="email" required> <br>
        <button type="submit" name="login_with_google">
            <img src="google.png" alt="Google Icon">
        </button>
    </form>
</body>
</html>

















