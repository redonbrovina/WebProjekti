let cart = [];

// Function to handle adding items to the cart
function addToCart(productName, productPrice) {
    const product = {
        name: productName,
        price: parseFloat(productPrice),
    };

    cart.push(product);
    alert(`${productName} has been added to your cart!`);
    updateCartCount();
}

// Function to update cart item count on the page (optional)
function updateCartCount() {
    const cartCountEl = document.getElementById("cart-count");
    if (cartCountEl) {
        cartCountEl.innerText = cart.length;
    }
}

// Add event listeners to "Add to Cart" buttons
document.querySelectorAll(".shop-item-button").forEach((button, index) => {
    button.addEventListener("click", () => {
        const item = button.closest(".shop-item");
        const productName = item.querySelector(".shop-item-title").innerText;
        const productPrice = item.querySelector(".shop-item-price").innerText.replace('$', '');

        addToCart(productName, productPrice);
    });
});

// For demonstration: Function to display cart contents in the console
function viewCart() {
    const cartContainer = document.getElementById("cart-container");
    
    // If cart is empty, display that
    if (cart.length === 0) {
        cartContainer.innerHTML = "<h2>Your Cart is Empty</h2>";
    } else {
        let cartContent = "<h2>Your Cart:</h2><ul>";
        cart.forEach(item => {
            cartContent += `<li>${item.name} - $${item.price.toFixed(2)}</li>`;
        });
        cartContent += "</ul>";
        cartContainer.innerHTML = cartContent;
    }

    // Show the cart container
    cartContainer.style.display = "block";
}

// Example: Add a button somewhere in your HTML to view cart details
// <button onclick="viewCart()">View Cart</button>