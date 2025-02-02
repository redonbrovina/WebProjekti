<?php
session_start(); // Start the session at the top

class Product {
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;

    public function __construct($id, $name, $description, $price, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }
}

class Cart {
    public static function addToCart($productId) {
        // Ensure the cart is initialized
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Add or update the product in the cart
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }
    }

    public static function getCart() {
        return $_SESSION['cart'] ?? [];
    }
}

// Define some products
$products = [
    new Product(1, "Hiking Bag Size S", "A durable, ergonomic backpack for outdoor essentials.", 19.99, "../images/bag2.webp"),
    new Product(2, "Hiking Bag Size M", "A bigger, durable, ergonomic backpack for outdoor essentials.", 29.99, "../images/bag2.webp"),
    new Product(3, "Hiking Boots", "Sturdy, supportive footwear for outdoor adventures.", 99.99, "../images/product3.jpg"),
    new Product(4, "Hiking Jacket", "Protective, insulated outerwear for all-weather comfort.", 69.99, "../images/jacket.jpg")
];

// Handle POST request to add item to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    Cart::addToCart($_POST['product_id']);
    // Redirect to shop page to see the update
    header("Location: shop.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous - Shop</title>
    <link rel="stylesheet" href="./shop.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900&family=Marcellus&family=Merriweather:wght@300;400;700&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Marcellus, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .shop-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }
        .shop-item {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .shop-item:hover {
            transform: translateY(-10px);
        }
        .shop-item img {
            width: 100%;
            height: auto;
        }
        .shop-item-content {
            padding: 20px;
            text-align: center;
        }
        .shop-item-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .shop-item-description {
            font-size: 14px;
            color: #777;
            margin: 10px 0;
        }
        .shop-item-price {
            font-size: 20px;
            color: #333;
            margin: 10px 0;
        }
        .shop-item-button {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .shop-item-button:hover {
            background-color: #0056b3;
        }
        .motto {
            text-align: center;
            font-size: 25px;
            color: #007bff;
            margin-top: 10px;
            padding: 20px;
        }

        @media(max-width:480px){
            .shop-container {
                max-width: 480px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <a href="index.php"><img id="nav-logo" src="../images/ACTN.png" alt="site-logo"></a>
        
        <div id="nav-submenu">
            <a href="shop.php">Shop</a>
            <a href="about.php">About Us</a>
            <a href="services.php" >Services</a>
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
            <a href="shop.php" >Shop</a>
            <a href="about.php" >About Us</a>
            <a href="services.php" >Services</a>
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

<h1 style="text-align: center; padding: 20px;">Shop</h1>

<div class="shop-container">
    <?php foreach ($products as $product) : ?>
        <div class="shop-item">
            <img src="<?= $product->image ?>" alt="Product Image">
            <div class="shop-item-content">
                <div class="shop-item-title"><?= $product->name ?></div>
                <div class="shop-item-description"><?= $product->description ?></div>
                <div class="shop-item-price">$<?= number_format($product->price, 2) ?></div>
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                    <button type="submit" class="shop-item-button">Add to Cart</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="cart-button-container" style="text-align: center; margin: 20px;">
    <a href="cart.php" class="btn-base">View Cart</a>
</div>

<p class="motto">Embrace Your Roots...</p>

<footer>
    <div class="footer">
        <div id="footer-left">
            <img class="footer-img" src="../images/ACTN-footer.png" alt="site-logo">
            <p>Experience the soul of the land.</p>
        </div>
        <div id="footer-right">
            <div>
                <b style="font-size: large;">Location</b>
                <p>123 Street, Prishtine, Kosovë</p>
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

<script src="./shop.js">
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

