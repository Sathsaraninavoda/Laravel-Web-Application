// Cart data structure
let cart = {
    1: { name: "Premium Ceylon Black Tea", price: 600, quantity: 2, image: "tea.jpg" },
    2: { name: "Ceylon Cinnamon Sticks", price: 800, quantity: 1, image: "cinnamon.jpg" },
    3: { name: "Traditional Wooden Mask", price: 2500, quantity: 1, image: "mask.jpg" }
};

// Update quantity function
function updateQuantity(productId, change, newValue = null) {
    if (newValue !== null) {
        cart[productId].quantity = parseInt(newValue);
    } else {
        cart[productId].quantity += change;
    }

    if (cart[productId].quantity < 1) {
        cart[productId].quantity = 1;
    }

    // Update the input field
    const input = document.querySelector(`[data-product-id="${productId}"] .quantity-input`);
    input.value = cart[productId].quantity;

    // Update price display
    updateItemPrice(productId);
    updateCartSummary();
}

// Update individual item price
function updateItemPrice(productId) {
    const item = cart[productId];
    const total = item.price * item.quantity;
    const priceElement = document.querySelector(`[data-product-id="${productId}"] .fw-bold`);
    priceElement.textContent = `LKR ${total.toLocaleString()}`;
}

// Remove item from cart
function removeItem(productId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        delete cart[productId];
        document.querySelector(`[data-product-id="${productId}"]`).remove();
        updateCartSummary();
        updateCartCount();

        // Show empty cart if no items
        if (Object.keys(cart).length === 0) {
            document.getElementById('cart-items').classList.add('d-none');
            document.getElementById('empty-cart').classList.remove('d-none');
        }
    }
}

// Clear entire cart
function clearCart() {
    if (confirm('Are you sure you want to clear your entire cart?')) {
        cart = {};
        document.getElementById('cart-items').innerHTML = '';
        document.getElementById('cart-items').classList.add('d-none');
        document.getElementById('empty-cart').classList.remove('d-none');
        updateCartSummary();
        updateCartCount();
    }
}

// Update cart count in navigation
function updateCartCount() {
    const count = Object.keys(cart).length;
    document.getElementById('cart-count').textContent = count;
}

// Update cart summary
function updateCartSummary() {
    let subtotal = 0;

    Object.values(cart).forEach(item => {
        subtotal += item.price * item.quantity;
    });

    const shipping = subtotal > 0 ? 300 : 0;
    const tax = Math.round(subtotal * 0.1);
    const total = subtotal + shipping + tax;

    document.getElementById('subtotal').textContent = `LKR ${subtotal.toLocaleString()}`;
    document.getElementById('shipping').textContent = `LKR ${shipping.toLocaleString()}`;
    document.getElementById('tax').textContent = `LKR ${tax.toLocaleString()}`;
    document.getElementById('total').textContent = `LKR ${total.toLocaleString()}`;
}

// Apply discount code
function applyDiscount() {
    const code = document.getElementById('discount-code').value.toUpperCase();
    const validCodes = {
        'HERITAGE10': 0.1,
        'SRILANKA20': 0.2,
        'FIRST15': 0.15
    };

    if (validCodes[code]) {
        alert(`Discount code applied! You saved ${validCodes[code] * 100}%`);
        // Implement discount logic here
    } else {
        alert('Invalid discount code. Please try again.');
    }
}

// Proceed to checkout
function proceedToCheckout() {
    if (Object.keys(cart).length === 0) {
        alert('Your cart is empty! Please add some items before checkout.');
        return;
    }

    // Simulate checkout process
    alert('Redirecting to secure checkout...');
    // In real implementation, redirect to checkout.php
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartSummary();
    updateCartCount();
});