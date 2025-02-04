<?php
include_once '../Repositories/UserRepository.php';
include_once '../Repositories/ServiceRepository.php';
include_once '../Repositories/OrderRepository.php';

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
        <a href="index.php"><img id="nav-logo" src="../images/ACTN.png" alt="site-logo"></a>
        
        <div id="nav-submenu">
            <a href="shop.php" target="_blank">Shop</a>
            <a href="about.php" target="_blank">About Us</a>
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
            <a href="shop.php" target="_blank">Shop</a>
            <a href="about.php" target="_blank">About Us</a>
            <a href="services.php" target="_blank">Services</a>
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
            <button class="menu-btn" id="servicesBtn">Services</button>
            <button class="menu-btn" id="usersBtn">Users</button>
            <button class="menu-btn" id="ordersBtn">Orders</button>
        </div>
        <div id="content">
            <div class="content-container" id="welcome-div">
                <h1 style="text-align:center; padding-top: 2rem;">Welcome to the Dashboard, <?php echo $_SESSION['username']?></h1>
                <h4 style="text-align:center; color: gray;">Choose what you want to view in the menu above</h4>
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
                                <td><a href='editService.php?id={$service['id']}'><img class='icons' src='../images/iconsedit.png'></a></td>
                                <td><a href='javascript:void(0)' onclick='confirmDeleteService({$service['id']})'><img class='icons' src='../images/icon-cancel.png'></a></td>
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
                                <td><a href='edit.php?id={$user['id']}'><img class='icons' src='../images/iconsedit.png'></a></td>
                                <td><a href='javascript:void(0);' onclick='confirmDelete({$user['id']})'><img class='icons' src='../images/icon-cancel.png'></a></td>
                            </tr>
                        ";
                    }
                    ?>
                </table>
            </div>

            <div class="content-container" id="orders">
                    <h3>Orders: </h3>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Order Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th style="text-decoration: underline;">Cancel Order</th>
                        </tr>

                        <?php 
                        $OrderRep = new OrderRepository();
                        $ServiceRep = new ServiceRepository();
                        $UserRep = new UserRepository();

                        $orders = $OrderRep->getAllOrders();
                        
                        foreach($orders as $order){
                            $name = $ServiceRep->getServiceNameById($order['service_id']);
                            $price = $ServiceRep->getServicePriceById($order['service_id']);
                            $user = $UserRep->getUserById($order['user_id']);
                            $truePrice = $price['price'] * $order['quantity'];
                            echo "
                                <tr>
                                    <td>{$order['id']}</td>    
                                    <td>{$user['username']}</td>
                                    <td>{$name['name']}</td>    
                                    <td>{$order['quantity']}</td>    
                                    <td>{$truePrice} $</td>    
                                    <td>{$order['order_date']}</td>    
                                    <<td><a href='javascript:void(0);' onclick='confirmDeleteOrder({$order['id']})'><img style='width:20%' src='../images/icon-cancel.png'></a></td>    
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
        const servicesDiv = document.getElementById("services");
        const usersDiv = document.getElementById("users");
        const welcomeDiv = document.getElementById("welcome-div");
        const ordersDiv = document.getElementById("orders");

        const servicesBtn = document.getElementById("servicesBtn");
        const usersBtn = document.getElementById("usersBtn");
        const ordersBtn = document.getElementById("ordersBtn");

        document.getElementById("menu-logo").addEventListener("click", () => {
            if(mobileNav.style.display == "flex"){
                mobileNav.style.display = "none";
            }else{
                mobileNav.style.display = "flex";
            }
        })

        servicesBtn.addEventListener("click", ()=> {
            servicesDiv.style.display = "block";
            usersDiv.style.display = "none";
            welcomeDiv.style.display = "none";
            ordersDiv.style.display = "none"; 
        })

        usersBtn.addEventListener("click", ()=> {
            usersDiv.style.display = "flex";                               
            servicesDiv.style.display = "none";  
            welcomeDiv.style.display = "none";
            ordersDiv.style.display = "none";               
        })

        ordersBtn.addEventListener("click", ()=> {
            usersDiv.style.display = "none";                          
            servicesDiv.style.display = "none";  
            welcomeDiv.style.display = "none";
            ordersDiv.style.display = "block";              
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
            if(confirm("Are you sure you want to delete this service?")){
                window.location.href='deleteService.php?id=' + serviceId;
            }
        }

        function confirmDeleteOrder(orderId){
            if(confirm("Are you sure you want to delete this order?")){
                window.location.href='deleteOrder.php?id=' + orderId;
            }
        }

    </script>
</body>
</html>