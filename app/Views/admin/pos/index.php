<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content pos-page">
    <div class="pos-container">

        <div class="pos-menu">
            <div class="pos-categories">
                <button class="cat-btn active" data-category="all">All</button>

                <?php foreach ($categories as $cat): ?>
                    <button class="cat-btn" data-category="<?= $cat['id'] ?>">
                        <?= esc($cat['name']) ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="pos-items" id="posItems">
                <?php foreach ($items as $item): ?>
                    <div class="pos-item"
                         data-category="<?= $item['category_id'] ?>"
                         data-id="<?= $item['id'] ?>"
                         data-name="<?= esc($item['name']) ?>"
                         data-price="<?= $item['price'] ?>">

                        <div class="pos-item-img">
                            <?php if (!empty($item['image'])): ?>
                                <img src="<?= base_url('uploads/menu/'.$item['image']) ?>" alt="<?= esc($item['name']) ?>">
                            <?php else: ?>
                                <span>🍽️</span>
                            <?php endif; ?>
                        </div>

                        <h4><?= esc($item['name']) ?></h4>
                        <p><?= number_format($item['price'], 2) ?></p>

                        <button class="add-btn" type="button">
                            <span>+</span> Add
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="pos-cart">
            <h3>Order Details</h3>

            <div id="cartItems">
                <p class="empty-cart">No items added</p>
            </div>

            <div class="payment-box">
                <label>Payment Method</label>
                <select id="paymentMethod">
                    <option value="">Select Payment</option>
                    <?php foreach ($paymentMethods as $method): ?>
                        <option value="<?= $method['id'] ?>">
                            <?= esc($method['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="discount-box">
    <label>Discount</label>
    <input type="number" id="discountInput" value="0" min="0" step="0.01">
</div>

<div class="cart-breakdown">
    <div>
        <span>Subtotal</span>
        <strong id="cartSubtotal">0.00</strong>
    </div>

    <div>
        <span>Discount</span>
        <strong id="cartDiscount">0.00</strong>
    </div>

    <div>
        <span>Tax</span>
        <strong id="cartTax">0.00</strong>
    </div>

    <div>
        <span>Service Charge</span>
        <strong id="cartService">0.00</strong>
    </div>
</div>

            <div class="cart-total">
                <span>Total</span>
                <strong id="cartTotal">0.00</strong>
            </div>

            <button class="btn-checkout" id="checkoutBtn" type="button">
                Checkout
            </button>
        </div>

    </div>
</main>

<script>
    const taxPercent = <?= $appSettings['tax_percent'] ?? 0 ?>;
    const servicePercent = <?= $appSettings['service_charge'] ?? 0 ?>;
    const checkoutUrl = "<?= base_url('admin/pos/checkout') ?>";
    const baseUrl = "<?= base_url() ?>";
</script>

<script src="<?= base_url('assets/js/pos.js') ?>"></script>