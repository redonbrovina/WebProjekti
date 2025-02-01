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
document.addEventListener("DOMContentLoaded", function() {
    const menuLogo = document.getElementById('menu-logo');
    const mobileNav = document.getElementById('mobile-nav');
    
    if (menuLogo) {
        menuLogo.addEventListener('click', function() {
            if (mobileNav.style.display === "block") {
                mobileNav.style.display = "none";
            } else {
                mobileNav.style.display = "block";
            }
        });
    }
});

    const mobileNav = document.getElementById("mobile-nav");
    const signOut = document.getElementById("signOutBtn");
    let index = 0;

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

    