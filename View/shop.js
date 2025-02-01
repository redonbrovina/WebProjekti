let cart = [];

function addToCart(productName, productPrice) {
    const product = {
        name: productName,
        price: parseFloat(productPrice),
    };

    cart.push(product);
    alert(`${productName} has been added to your cart!`);
    updateCartCount();
}

function updateCartCount() {
    const cartCountEl = document.getElementById("cart-count");
    if (cartCountEl) {
        cartCountEl.innerText = cart.length;
    }
}

document.querySelectorAll(".shop-item-button").forEach((button, index) => {
    button.addEventListener("click", () => {
        const item = button.closest(".shop-item");
        const productName = item.querySelector(".shop-item-title").innerText;
        const productPrice = item.querySelector(".shop-item-price").innerText.replace('$', '');

        addToCart(productName, productPrice);
    });
});

function viewCart() {
    const cartContainer = document.getElementById("cart-container");
    
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

    cartContainer.style.display = "block";
}

