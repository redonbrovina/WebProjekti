<?php 

include_once "../Repositories/ServiceRepository.php";

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/services</title>
    <link rel="stylesheet" href="./services.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a id="host-link" href="./host.php">Dashboard</a>
                <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
            <?php elseif (isset($_SESSION['username'])): ?>
                <a id="host-link" href="./userDashboard.php">Dashboard</a>
                <a href="./logout.php"><button class="btn-base" id="signOutBtn">Sign Out</button></a>
            <?php else: ?>
                <a id="form-redirect" href="form.php">Sign in</a>
                <a href="./register-form.php"><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
    </nav>
    <main>
        <div class="opening">
            <div id="opening-title">
                <h1>Explore the Heart of Kosovo</h1>
            </div>

            <div id="opening-intro">
                <p>Welcome to our Services page, where we bring together a passion for adventure and an appreciation for heritage to create unforgettable experiences. 
                    Whether you're an avid explorer or someone seeking a tranquil escape, our range of services is designed to cater to every outdoor enthusiast. 
                    From expertly guided hikes through Kosovo's breathtaking landscapes to curated tours that unveil the rich cultural heritage of the region, 
                    we’re here to help you connect deeply with nature and history.</p>
                <p>
                    Here you can find some of our offers on guides of the mentioned areas.
                </p>
            </div>
        </div>

        <?php 
        
        $serviceRep = new ServiceRepository();
        $services = $serviceRep->getAllServices();

        foreach($services as $service){
            if(isset($_SESSION['role'])){
                echo "
                <div class='services-container'>
                    <div class='service-box' id='{$service['name']}'>
                        <h1>{$service['name']}</h1>
                        <div class='service-content'>
                            <img class='service-box-img' src={$service['img']} alt='{$service['name']}'>
                            <div class='service-box-description'>
                                <p>{$service['description']}</p>
                                <div>
                                    <button class='btn-book' onclick='booked({$service['id']})'>Book Now</button>
                                    <p class='price'>$ {$service['price']}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }else{
                echo "
                <div class='services-container'>
                    <div class='service-box' id='{$service['name']}'>
                        <h1>{$service['name']}</h1>
                        <div class='service-content'>
                            <img class='service-box-img' src={$service['img']} alt='{$service['name']}'>
                            <div class='service-box-description'>
                                <p>{$service['description']}</p>
                                <div>
                                    <a href='form.php'><button class='btn-book'>Book Now</button></a> 
                                    <p class='price'>$ {$service['price']}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        }
        
        ?>
    </main>

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

        document.getElementById("menu-logo").addEventListener("click", () => {
            if(mobileNav.style.display == "flex"){
                mobileNav.style.display = "none";
            }else{
                mobileNav.style.display = "flex";
            }
        })

        function booked(serviceId) {
            Swal.fire({
                title: "Service has been booked",
                text: "Go to dashboard to view orders or proceed to checkout.",
                icon: "success",
                willClose: ()=> {
                    window.location.href = 'addOrder.php?serviceid='+serviceId;
                }
            });

        }
        
        
    </script>
</body>
</html>