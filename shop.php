<?php
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Product{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;

    public function __construct($id,$name,$description,$price,$image)
    {
    $this->id= $id;
    $this->name= $name;
    $this->description= $description;
    $this->price= $price;
    $this->image= $image;    
    }
}
class Cart{
    public static function addToCart($productId){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart']=[];
        }
        if(isset($_SESSION['cart'][$productId])){
            $_SESSION['cart'][$productId]++;
        }else{
            $_SESSION['cart'][$productId]=1;
        }
    }
    public static function getCart() {
        return $_SESSION['cart'] ?? [];
    }
}
$products= [
    new Product(1,"Hiking Bag Size S","A durable, ergonomic backpack for outdoor essentials.",19.99,"./images/bag2.webp"),
    new Product(2,"Hiking Bag Size M","A bigger, durable, ergonomic backpack for outdoor essentials.",29.99,"./images/bag2.webp"),
    new Product(3,"Hiking Boots","Sturdy, supportive footwear for outdoor adventures.",99.99,"./images/product3.jpg"),
    new Product(4,"Hiking Jacket","Protective, insulated outerwear for all-weather comfort.",69.99,"./images/jacket.jpg")
];
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])){
    Cart::addToCart($_POST['product_id']);
    header("Location: shop.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/shop</title>
    <link rel="stylesheet" href="./shop.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Marcellus, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
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

        .shop-item img{
            width: 100%;
            height: auto;
        }

        .shop-item-content {
            padding: 20px;
            text-align: center;
        }

        .shop-item-title{
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

        .shop-item-button:hover{
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
        <a href="index.html"><img id="nav-logo" src="./images/ACTN.png" alt="site-logo"></a>
        <div id="nav-submenu">
            <a href="shop.html" target="_blank">Shop</a>
            <a href="about.html" target="_blank">About Us</a>
            <a href="services.html" target="_blank">Services</a>
        </div>
        <div id="nav-right">
            <a href="form.html" target="_blank">Sign in</a>
            <button class="btn-base" onclick="location.href(shop.html)">Sign up for Free</button>
        </div>
    </nav>
    <h1 style="text-align: center; padding: 20px;">Shop</h1>

    <div class="shop-container">
        <?php foreach($products as $product) : ?>
        <!-- Produkti 1 -->
        <div class="shop-item">
            <img src="<?= $product->image ?>" alt="Product Image">
            <div class="shop-item-content">
                <div class="shop-item-title"><?=  $product->name ?></div>
                <div class="shop-item-description"><?= $product->description?></div>
                <div class="shop-item-price">$<?=number_format($product->price, 2)?></div>
                <form method="POST">
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <button type="submit" class="shop-item-button"> Add To Cart </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>    
    
     
<div class="cart-button-container" style="text-align:center ;margin: 20px;">
<a href="cart.php" class="btn-base">View Cart</a>
</div>
<div id="cart-container" style="display: none; margin-top: 20px;"></div>
<p class="motto">Embrace Your Roots...</p>

<footer>
    <div class="footer">
        <div id="footer-left">
            <img class="footer-img" src="./images/ACTN-footer.png" alt="site-logo">
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
<script src="./shop.js"></script>
</body>
</html>
