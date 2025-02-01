<?php
include_once '../Controller/LoginController.php';
include_once '../Repositories/UserRepository.php';

session_start();

if(isset($_SESSION['username'])){
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/form</title>
    <link rel="stylesheet" href="./form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background-image"></div>
    <main>
        <div class="main-content">
            <div class="content">
                <form action="../Controller/LoginController.php" method="POST">
                    <a id="back-home" href="./index.php"><img id="back-icon" src="../images/back-icon.png" alt="Back Icon">Back to Homepage</a>
                    <img id="form-logo" src="../images/ACTN.png" alt="">
                    <input id="user" type="text" name="username" placeholder="Username...">
                    <input id="pass" type="password" name="password" placeholder="Password...">
                    <p id="error-txt"></p>
                    <button name="loginBtn" type="submit" class="btn-base">Sign In</button>
                    <p id="bottom-txt">Don't have an account? <a href="register-form.php" >Create one!</a></p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>