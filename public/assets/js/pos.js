let cart = [];

document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.cat-btn');
    const items = document.querySelectorAll('.pos-item');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const discountInput = document.getElementById('discountInput');

    categoryButtons.forEach(button => {
        button.addEventListener('click', function () {
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;

            items.forEach(item => {
                item.style.display = category === 'all' || item.dataset.category === category
                    ? 'block'
                    : 'none';
            });
        });
    });

    items.forEach(item => {
        item.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);

            const existing = cart.find(i => i.id === id);

            if (existing) {
                existing.qty++;
            } else {
                cart.push({ id, name, price, qty: 1 });
            }

            renderCart();
        });
    });

    if (discountInput) {
        discountInput.addEventListener('input', renderCart);
    }

    checkoutBtn.addEventListener('click', checkout);

    renderCart();
});

function calculateTotals() {
    let subtotal = 0;

    cart.forEach(item => {
        subtotal += item.price * item.qty;
    });

    const discountPercent = parseFloat(document.getElementById('discountInput').value) || 0;
    const discount = (subtotal * discountPercent) / 100;
    const tax = (subtotal * taxPercent) / 100;
    const service = (subtotal * servicePercent) / 100;
    const total = subtotal - discount + tax + service;

    return { subtotal, discountPercent, discount, tax, service, total };
}

function renderCart() {
    const cartItems = document.getElementById('cartItems');
    const totals = calculateTotals();

    cartItems.innerHTML = '';

    if (cart.length === 0) {
        cartItems.innerHTML = '<p class="empty-cart">No items added</p>';
    } else {
        cart.forEach((item, index) => {
            const itemTotal = item.price * item.qty;

            cartItems.innerHTML += `
                <div class="cart-row">
                    <div>
                        <span>${item.name}</span>
                        <small>${item.qty} x ${item.price.toFixed(2)}</small>
                    </div>

                    <div class="cart-actions">
                        <strong>${itemTotal.toFixed(2)}</strong>
                        <button type="button" onclick="decreaseQty(${index})">-</button>
                        <button type="button" onclick="increaseQty(${index})">+</button>
                        <button type="button" onclick="removeItem(${index})">×</button>
                    </div>
                </div>
            `;
        });
    }

    document.getElementById('cartSubtotal').innerText = totals.subtotal.toFixed(2);
    document.getElementById('cartDiscount').innerText = totals.discount.toFixed(2);
    document.getElementById('cartTax').innerText = totals.tax.toFixed(2);
    document.getElementById('cartService').innerText = totals.service.toFixed(2);
    document.getElementById('cartTotal').innerText = totals.total.toFixed(2);
}

function increaseQty(index) {
    cart[index].qty++;
    renderCart();
}

function decreaseQty(index) {
    cart[index].qty--;

    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
    }

    renderCart();
}

function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}

function checkout() {
    const paymentMethod = document.getElementById('paymentMethod').value;
    const totals = calculateTotals();

    if (cart.length === 0) {
        alert('Cart is empty');
        return;
    }

    if (!paymentMethod) {
        alert('Please select payment method');
        return;
    }

    const formData = new FormData();
    formData.append('cart', JSON.stringify(cart));
    formData.append('payment_method_id', paymentMethod);
    formData.append('discount_percent', totals.discountPercent);

    fetch(checkoutUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.open(baseUrl + 'admin/orders/receipt/' + data.order_id, '_blank');

            cart = [];
            document.getElementById('paymentMethod').value = '';
            document.getElementById('discountInput').value = 0;

            renderCart();
        } else {
            alert(data.message);
        }
    })
    .catch(() => {
        alert('Something went wrong');
    });
}