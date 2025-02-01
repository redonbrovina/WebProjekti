<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav>
        <a href="index.php"><img id="nav-logo" src="../images/ACTN.png" alt="site-logo"></a>
        
        <div id="nav-submenu">
            <a href="shop.html" target="_blank">Shop</a>
            <a href="about.html" target="_blank">About Us</a>
            <a href="services.php" target="_blank">Services</a>
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
        <img id="menu-logo" src="../images/menu-logo.png" alt="menu-logo">
        <div id="mobile-nav">
            <a href="shop.html" target="_blank">Shop</a>
            <a href="about.html" target="_blank">About Us</a>
            <a href="services.php" target="_blank">Services</a>
            <?php if(isset($_SESSION['role'])): ?>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a id="host-link" href="./host.php">Dashboard</a>
                    <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
                <?php else: ?>
                    <a id="host-link" href="./userDashboard.php">Dashboard</a>
                    <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
                <?php endif; ?>
            <?php else: ?>
                <a id="form-redirect" href="form.php" target="_blank">Sign in</a>
                <a href="./register-form.php" target="_blank"><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="main">
        <div id="main-txt">
            <h1>Where Nature and Heritage Meet.</h1>
            <button id="scroll-btn" onClick="document.getElementById('services').scrollIntoView();">Explore</button>
        </div>
    </div>

    <div id="services">
        <h1>Our Services</h1>
        <p>Autochthonous offers guided mountain tours across Kosovo, taking you through stunning peaks, hidden trails, and rich cultural landscapes. 
            Whether you seek adventure or tranquility, our tailored experiences ensure an unforgettable journey into nature.</p>
        <div class="section-content">

            <div class="services-box" id="brezovica">
                <h2>Brezovica Tour</h2>
                <img class='services-img' src="../images/brezovica.jpg" alt="brezovica">
            </div>

            <div class="services-box" id="sharr">
                <h2>Sharr National Park Tour</h2>
                <img class='services-img' src="../images/Sharr.jpg" alt="Sharr National Mountain">
            </div>

            <div class="services-box" id="rugova">
                <h2>Rugova Canyon Tour</h2>
                <img class='services-img' src="../images/Rugova_Canyon.jpg" alt="Rugova">
            </div>

            <div class="controls">
                <button onclick={goPrevious()}><</button>
                <button onclick={goForward()}>></button>
            </div>

            <a href="services.php" target="_blank"><button class="btn-base">Explore our services</button></a>
        </div>
    </div>

    <div class="products">
        <h1>Our Bestsellers</h1>
        <p>Equip yourself for every journey with our handpicked hiking gear, built for adventure and exploration.</p>
        <div class="products-content">
            <div class="products-box">
                <img class="products-img" src="../images/jacket.jpg" alt="placeholder">
                <label for="img" class="price"></label>
            </div>

            <div class="products-box">
                <img class="products-img" src="../images/product3.jpg" alt="placeholder">
                <label for="img" class="price"></label>
            </div>

            <div class="products-box">
                <img class="products-img" src="../images/bag2.webp" alt="placeholder">
                <label for="img" class="price"></label>
            </div>
        </div>

        <a href="./shop.html" target="_blank"><button class="btn-base">See All</button></a>
    </div>

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
        const brezovica = document.getElementById("brezovica");
        const sharr = document.getElementById("sharr");
        const rugova = document.getElementById("rugova");
                
        let index = 0;

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

        function goPrevious() {
            if(index == 0){
                brezovica.style.display = "none";
                sharr.style.display = "none";
                rugova.style.display = "flex";
                index = 2;
            }else if(index == 1){
                brezovica.style.display = "flex";
                sharr.style.display = "none";
                rugova.style.display = "none";
                index = index - 1;
            }else{
                brezovica.style.display = "none";
                sharr.style.display = "flex";
                rugova.style.display = "none";
                index = index-1;
            }
        }

        function goForward() {
            if(index == 0){
                brezovica.style.display = "none";
                sharr.style.display = "flex";
                rugova.style.display = "none";
                index = index + 1;
            }else if(index == 1){
                brezovica.style.display = "none";
                sharr.style.display = "none";
                rugova.style.display = "flex";
                index = index + 1;
            }else{
                brezovica.style.display = "flex";
                sharr.style.display = "none";
                rugova.style.display = "none";
                index = 0;
            }
        }





    </script>
</body>
</html>