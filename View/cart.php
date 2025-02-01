<?php
session_start();
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


function getProductById($id) {
    $products = [
        1 => new Product(1, "Hiking Bag Size S", "A durable, ergonomic backpack for outdoor essentials.", 19.99, "./images/bag2.webp"),
        2 => new Product(2, "Hiking Bag Size M", "A bigger, durable, ergonomic backpack for outdoor essentials.", 29.99, "./images/bag2.webp"),
        3 => new Product(3, "Hiking Boots", "Sturdy, supportive footwear for outdoor adventures.", 99.99, "./images/product3.jpg"),
        4 => new Product(4, "Hiking Jacket", "Protective, insulated outerwear for all-weather comfort.", 69.99, "./images/jacket.jpg")
    ];

    return $products[$id] ?? null;
}

function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['product_id'])) {
    removeFromCart($_GET['product_id']);
    header("Location: cart.php"); // Redirect after removing an item
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="./shop.css">
    <style></style>
</head>
<body>
    <h1>Your Shopping Cart</h1>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPrice = 0;
                foreach ($_SESSION['cart'] as $productId => $quantity):
                    $product = getProductById($productId);
                    if ($product):
                        $total = $product->price * $quantity;
                        $totalPrice += $total;
                ?>
                    <tr>
                        <td><?= $product->name ?></td>
                        <td><?= $quantity ?></td>
                        <td>$<?= number_format($product->price, 2) ?></td>
                        <td>$<?= number_format($total, 2) ?></td>
                        <td><a href="cart.php?action=remove&product_id=<?= $productId ?>">Remove</a></td>
                    </tr>
                <?php endif; endforeach; ?>
            </tbody>
        </table>

        <h3>Total Price: $<?= number_format($totalPrice, 2) ?></h3>

        <div style="text-align: center;">
            <a href="shop.php" class="btn-base">Continue Shopping</a>
            <a href="checkout.php" class="btn-base">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
        <div style="text-align: center;">
            <a href="shop.php" class="btn-base">Go to Shop</a>
        </div>
    <?php endif; ?>

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
</body>
</html>