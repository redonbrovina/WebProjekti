<?php
session_start();

if($_SESSION['role'] !== 'user'){
    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/userDashboard</title>
    <link rel="stylesheet" href="./userDashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <a href="index.html"><img id="nav-logo" src="./images/ACTN.png" alt="site-logo"></a>
        
        <div id="nav-submenu">
            <a href="shop.html" target="_blank">Shop</a>
            <a href="about.html" target="_blank">About Us</a>
            <a href="services.html" target="_blank">Services</a>
        </div>

        <div id="nav-right">
            <?php if(isset($_SESSION['role'])):?> 
                <?php if($_SESSION['role'] == 'admin'):?>
                    <a id="host-link" href="./host.php">Dashboard</a>
                    <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
                <?php else:?>
                    <a id="host-link" href="./userDashboard.php">Dashboard</a>
                    <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
                <?php endif; ?>
            <?php else: ?>
                <a id="form-redirect" href="form.php" target="_blank">Sign in</a>
                <a href="./register-form.php" target="_blank"><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
        <img id="menu-logo" src="./images/menu-logo.png" alt="menu-logo">
        <div id="mobile-nav">
            <a href="shop.html" target="_blank">Shop</a>
            <a href="about.html" target="_blank">About Us</a>
            <a href="services.html" target="_blank">Services</a>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a id="host-link" href="./host.php">Dashboard</a>
                <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
            <?php elseif (isset($_SESSION['username'])): ?>
                <a id="host-link" href="./userDashboard.php">Dashboard</a>
                <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
            <?php else: ?>
                <a id="form-redirect" href="form.php" target="_blank">Sign in</a>
                <a href="./register-form.php" target="_blank"><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <h1>Welcome, <?php echo $_SESSION['username']?></h1>
        <button class="btn-base">Proceed to checkout</button>
        <h3>Your Cart</h3>
    </main>

    <script>
        const mobileNav = document.getElementById("mobile-nav");

        document.getElementById("menu-logo").addEventListener("click", () => {
            if(mobileNav.style.display == "flex"){
                mobileNav.style.display = "none";
            }else{
                mobileNav.style.display = "flex";
            }
        })
    </script>
</body>
</html>