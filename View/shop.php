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
    new Product(1, "Hiking Bag Size S", "A durable, ergonomic backpack for outdoor essentials.", 19.99, "/images/bag2.webp"),
    new Product(2, "Hiking Bag Size M", "A bigger, durable, ergonomic backpack for outdoor essentials.", 29.99, "/images/bag2.webp"),
    new Product(3, "Hiking Boots", "Sturdy, supportive footwear for outdoor adventures.", 99.99, "/images/product3.jpg"),
    new Product(4, "Hiking Jacket", "Protective, insulated outerwear for all-weather comfort.", 69.99, "/images/jacket.jpg")
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
        nav {
            background-color: #FFFFFF;
            color: #0d47a1;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            padding: 0.625rem 3.125rem;
            align-items: center;
        }
        #nav-logo {
            width: 7.8125em;
            height: auto;
        }
        #nav-submenu {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 3.125rem;
        }
        #nav-submenu > a {
            color: gray;
            text-decoration: none;
        }
        #nav-submenu > a:hover {
            color: black;
            text-decoration: underline;
            transition: 0.3s;
        }
        #nav-right {
            display: flex;
            flex-wrap: wrap;
            gap: 3.125rem;
            align-items: center;
        }
        #form-redirect {
            text-decoration: none;
            color: gray;
        }

        #form-redirect:hover {
            color: black;
            text-decoration: underline;
            transition: 0.3s;
        }

        #menu-logo {
            display: none;
        }

        #mobile-nav {
            display: none;
        }

        @media screen and (max-width: 767px) {
            #menu-logo {
                display: block;
            }

            #mobile-nav {
                display: block;
                background-color: #fff;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                z-index: 9999;
                text-align: center;
                padding: 1rem;
                display: none;
            }

            #mobile-nav {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: center;
                gap: 13px;
                padding: 0;
                padding-top: 4px;
            }

            #mobile-nav a:hover {
                color: #0056b3;
                text-decoration: underline;
            }
            #mobile-nav > a {
                color: #4A4A4A;
                text-decoration: none;
            }

            #mobile-nav > a > button {
                font-size: smaller;
                padding: 0.6rem;
                height: auto;
            }

            #menu-logo {
                display: flex;
                width: 1.3rem;
                height: auto;
                cursor: pointer;
            }
        }

        .shop-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
    </style>
</head>
<body>

<nav>
    <a href="index.html"><img id="nav-logo" src="/images/ACTN.png" alt="site-logo"></a>
    <div id="nav-submenu">
        <a href="shop.php">Shop</a>
        <a href="about.html">About Us</a>
        <a href="services.html">Services</a>
    </div>
    <div id="nav-right">
        <a href="form.html">Sign in</a>
        <button class="btn-base" onclick="location.href='shop.php'">Sign up for Free</button>
    </div>
    <img id="menu-logo" src="/images/menu-logo.png" alt="menu-logo">
    <div id="mobile-nav">
        <a href="shop.php" target="_blank">Shop</a>
        <a href="about.html" target="_blank">About Us</a>
        <a href="services.php" target="_blank">Services</a>
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
            <img class="footer-img" src="/images/ACTN-footer.png" alt="site-logo">
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

<script src="./shop.js"></script>

</body>
</html>

