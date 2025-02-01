<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/About</title>
    <link rel="stylesheet" href="./about.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <a href="index.php"><img id="nav-logo" src="../images/ACTN.png" alt="site-logo"></a>
        
        <div id="nav-submenu">
            <a href="shop.php">Shop</a>
            <a href="about.php">About Us</a>
            <a href="services.php">Services</a>
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
                <a id="form-redirect" href="form.php">Sign in</a>
                <a href="./register-form.php"><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
        <img id="menu-logo" src="../images/menu-logo.png" alt="menu-logo">
        <div id="mobile-nav">
            <a href="shop.php">Shop</a>
            <a href="about.php">About Us</a>
            <a href="services.php">Services</a>
            <?php if(isset($_SESSION['role'])): ?>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a id="host-link" href="./host.php">Dashboard</a>
                    <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
                <?php else: ?>
                    <a id="host-link" href="./userDashboard.php">Dashboard</a>
                    <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
                <?php endif; ?>
            <?php else: ?>
                <a id="form-redirect" href="form.php" >Sign in</a>
                <a href="./register-form.php" ><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
    </nav>

    <header>
    <h1>About Us</h1>
    </header>
    <main>
        <section id="about">
            <h2>Welcome to Autochthonous</h2>
            <p>Your trusted partner for unforgettable hiking adventures and premium hiking gear.</p>
            <h3>Why Choose Us?</h3>
            <ul>
                <li><strong>Expert Services:</strong> We offer guided hiking experiences tailored to all skill levels, ensuring a safe and exciting adventure.</li>
                <li><strong>Quality Gear</strong> Our selection of hiking accessories combines durability, functionality, and comfort, so you're always ready to conquer the trails.</li>
                <li><strong>Passion for Nature</strong> As outdoor enthusiasts ourselves, we prioritize eco-friendly practices and aim to foster a love for nature in every client.</li>
            </ul>
            <p>Thank you for choosing Autochthonous as your adventure partner!</p>
        </section>
    </main>
    <section id="team">
        <h3>Meet our Founders</h3>
        <div class="ceo-container">
            <div class="ceo">
                <img src="../images/Rroni1.jpeg" alt="Rroni">
                <p class="email"><strong>Rron Morina</strong></p>
                <p class="email">rronmorina65@gmail.com</p>
            </div>
            <div class="ceo">
                <img src="../images/Redoni.jpeg" alt="Redoni">
                <p class="email"><Strong>Redon Brovina</Strong></p>
                <p class="email">redonbrovina@gmail.com</p>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer">
            <div id="footer-left">
                <img class="footer-img" src="../images/ACTN-footer.png" alt="site-logo">
                <p>Experience the soul of the land.</p>
            </div>

            <div id="footer-right">
                <div>
                    <b style="font-size: large;">Location</b>
                    <p>123 Street</p>
                    <p>Prishtine, Kosovë</p>
                    <p>PO: 00000</p>
                </div>
                <div>
                    <b style="font-size: large;">Contact</b>
                    <p>autochthonous@gmail.com</p>
                    <p>(+383) 44-123-456</p>
                </div>
            </div>
        </div>
        <label>&copy; 2025 Autochthonous. All rights reserved</label>
    </footer>
    <script>
        const mobileNav = document.getElementById("mobile-nav");
        const signOut = document.getElementById("signOutBtn");

        document.getElementById("menu-logo").addEventListener("click", () => {
            if(mobileNav.style.display == "flex"){
                mobileNav.style.display = "none";
            }else{
                mobileNav.style.display = "flex";
            }
        })

        signOut.addEventListener("click", () => {
            Swal.fire({
                title: "You are now logged out",
                icon: "info",
                timer: 1500
          });
        })
    </script>
</body>
</html>