
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register-form.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="background-image"></div>
    <main>
        <div class="main-content">
            <div class="content">
                <a id="back-home" href="./index.php"><img id="back-icon" src="../images/back-icon.png" alt="Back Icon">Back to Homepage</a>
                <img id="form-logo" src="../images/ACTN.png" alt="site-logo">
                
                <form action="../Controller/RegisterController.php" method="post">
                    <div class="input-box">
                        <p>Username</p>
                        <input name="username" id="username" type="text" maxlength="30">
                    <div class="input-box">
                        <p>Password</p>
                        <input name="password" id="password" type="password" minlength="8" maxlength="30">
                    </div>
                    <div class="input-box">
                        <p>Gender</p>
                        <div id="gender-box">
                            <p>Male<input id="male" name="gender" type="radio" value="Male"></p>
                            <p>Female<input id="female" name="gender" type="radio" value="Female"></p>
                        </div>
                    </div>
                    <div class="input-box">
                        <p>Email</p>
                        <input name="email" id="email" type="email" maxlength="60">
                    </div>
                    <div class="input-box">
                        <p>Phone Number (Optional)</p>
                        <input name="phone" id="phone" type="text" maxlength="9">
                    </div>
                    <div id="submit-box">
                        <p id="error-txt"></p>
                        <button name="registerBtn" type="submit" class="btn-base" onclick="enterData()">Sign Up</button>
                    </div>
                    <p id="bottom-txt">Already have an account? <a href="form.php">Sign in!</a></p>
                </form>    
            </div>
        </div>
    </main>
    <script src="register-form.js"></script>
</body>
</html>

<?php
include_once '../Controller/RegisterController.php';
?>