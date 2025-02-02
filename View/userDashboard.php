<?php
session_start();

include_once "../Repositories/OrderRepository.php";
include_once "../Repositories/ServiceRepository.php";

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
                <a id="form-redirect" href="form.php" target="_blank">Sign in</a>
                <a href="./register-form.php"><button class="btn-base">Sign up for Free</button></a>
            <?php endif; ?>
        </div>
        <img id="menu-logo" src="../images/menu-logo.png" alt="menu-logo">
        <div id="mobile-nav">
            <a href="shop.php" >Shop</a>
            <a href="about.php" >About Us</a>
            <a href="services.php" >Services</a>
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
        <h3>Your Cart</h3>

        <?php
                echo "
                    <table>
                        <tr>
                            <th>Order Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th>Cancel Order</th>
                        </tr>
                ";

                $OrderRep = new OrderRepository();
                $ServiceRep = new ServiceRepository();

                $userId = $_SESSION['user_id'];

                $orders = $OrderRep->getOrdersByUserId($userId);

                $totalPrice = 0;

                foreach($orders as $order){
                    $name = $ServiceRep->getServiceNameById($order['service_id']);
                    $price = $ServiceRep->getServicePriceById($order['service_id']);

                    if(is_bool($name)){
                        continue;
                    }
                    echo "
                        <tr>
                            <td>{$name['name']}</td>
                            <td>{$order['quantity']}</td>
                            <td>{$price['price']} $</td>
                            <td>{$order['order_date']}</td>
                            <td><a href='javascript:void(0);' onclick='confirmDelete({$order['id']})'><img style='width:20%' src='../images/icon-cancel.png'></a></td>
                        </tr>
                    ";

                    $totalPrice += $price['price']*$order['quantity'];
                }

                echo "</table>";

                echo "<h2>Total Price: {$totalPrice} $</h2>"
                
                ?>
        <button id="proceed" class="btn-base" onclick="purchaseConfirm()">Proceed to checkout</button>
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

        function confirmDelete(orderId){
            if(confirm("Are you sure you want to delete this order?")){
                window.location.href = 'deleteOrder.php?id=' + orderId;
            }
        }

        function purchaseConfirm() {
            if(confirm("You are about to confirm purchase of your orders. Click OK to proceed to checkout.")){
                Swal.fire({
                    title: "Your purchase was succesful!",
                    text: "Thank you for choosing Autochthonous",
                    icon: "success",
                    willClose: ()=> {
                        window.location.href = 'purchase.php';
                    }
                })
            }
        }
    </script>
</body>
</html>