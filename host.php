<?php
include_once 'Database/UserRepository.php';
include_once 'Database/ServiceRepository.php';

session_start();

if($_SESSION['role'] !== 'admin'){
    header("Location: userDashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/host</title>
    <link rel="stylesheet" href="./host.css">
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
        <div id="host-menu">
            <button class="menu-btn" id="productsBtn">Products</button>
            <button class="menu-btn" id="servicesBtn">Services</button>
            <button class="menu-btn" id="usersBtn">Users</button>
        </div>
        <div id="content">
            <div class="content-container" id="welcome-div">
                <h1 style="text-align:center; padding-top: 2rem;">Welcome to the Dashboard, <?php echo $_SESSION['username']?></h1>
                <h4 style="text-align:center; color: gray;">Choose what you want to view in the menu above</h4>
            </div>
            <div class="content-container" id="products">
                <h3>Products: </h3>
                <div class="content-commands">
                    <button class="command-btn">Add new product</button>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th style="text-decoration: underline;">Edit Data</th>
                        <th style="text-decoration: underline;">Delete User</th>
                    </tr>

                </table>
            </div>

            <div class="content-container" id="services">
                <h3>Services: </h3>
                <div class="content-commands">
                    <a href="./registerService.php"><button class="command-btn">Add new service</button></a>
                </div>

                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th style="text-decoration: underline;">Edit Data</th>
                        <th style="text-decoration: underline;">Delete Service</th>
                    </tr>

                    <?php
                    
                    $serviceRep = new ServiceRepository();
                    $services = $serviceRep->getAllServices();

                    foreach($services as $service){
                        echo "
                            <tr>
                                <td>{$service['id']}</td>
                                <td>{$service['name']}</td>
                                <td>{$service['price']} $</td>
                                <td><a href='editService.php?id={$service['id']}'><img style='width=10%;' class='icons' src='images/iconsedit.png'></a></td>
                                <td><a href='javascript:void(0)' onclick='confirmDeleteService({$service['id']})'><img style='width:10%;' class='icons' src='images/icon-trash.png'></a></td>
                            </tr>
                        ";
                    }
                    ?>
                </table>
            </div>
            <div class="content-container" id="users">
                <h3>Users: </h3>
                <div class="content-commands">
                    <a href="./register-form.php" target="_blank"><button class="command-btn">Add new user</button></a>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th style="text-decoration: underline;">Edit Data</th>
                        <th style="text-decoration: underline;">Delete User</th>
                    </tr>
                    <?php
                    $userRep = new UserRepository();
                    $users = $userRep->getAllUsers();

                    $phone = $users['phone'] ?? "N/A";

                    foreach($users as $user){
                        echo "
                            <tr>
                                <td>{$user['id']}</td>
                                <td>{$user['username']}</td>
                                <td>{$user['email']}</td>
                                <td>{$user['gender']}</td>
                                <td>{$phone}</td>
                                <td>{$user['role']}</td>
                                <td><a href='edit.php?id={$user['id']}'><img class='icons' src='images/iconsedit.png'></a></td>
                                <td><a href='javascript:void(0);' onclick='confirmDelete({$user['id']})'><img class='icons' src='images/icon-trash.png'></a></td>
                            </tr>
                        ";
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

    <script>
        const mobileNav = document.getElementById("mobile-nav");
        const productsDiv = document.getElementById("products");
        const servicesDiv = document.getElementById("services");
        const usersDiv = document.getElementById("users");
        const welcomeDiv = document.getElementById("welcome-div");

        const productsBtn = document.getElementById("productsBtn");
        const servicesBtn = document.getElementById("servicesBtn");
        const usersBtn = document.getElementById("usersBtn");

        document.getElementById("menu-logo").addEventListener("click", () => {
            if(mobileNav.style.display == "flex"){
                mobileNav.style.display = "none";
            }else{
                mobileNav.style.display = "flex";
            }
        })

        productsBtn.addEventListener("click", ()=> {
            productsDiv.style.display = "flex";
            servicesDiv.style.display = "none";
            usersDiv.style.display = "none";
            welcomeDiv.style.display = "none";
        })

        servicesBtn.addEventListener("click", ()=> {
            servicesDiv.style.display = "block";
            productsDiv.style.display = "none";
            usersDiv.style.display = "none";
            welcomeDiv.style.display = "none";
        })

        usersBtn.addEventListener("click", ()=> {
            usersDiv.style.display = "flex";                
            productsDiv.style.display = "none";                
            servicesDiv.style.display = "none";  
            welcomeDiv.style.display = "none";              
        })

        function alertDelete() {
            alert("Are you sure you want to delete this item?");
        }

        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = 'delete.php?id=' + userId;
            }
        }

        function confirmDeleteService(serviceId){
            if(confirm("Are you sure you want to delete this service")){
                window.location.href='deleteService.php?id=' + serviceId;
            }
        }

    </script>
</body>
</html>