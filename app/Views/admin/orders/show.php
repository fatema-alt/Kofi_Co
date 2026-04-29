<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
    <div>
        <span class="eyebrow">Order Details</span>
        <h1><?= esc($order['order_no']) ?></h1>
    </div>

    <div class="page-actions">
        <a href="<?= base_url('admin/orders/receipt/' . $order['id']) ?>" 
           class="btn-add" 
           target="_blank">
            🖨 Print
        </a>

        <a href="<?= base_url('admin/orders') ?>" class="btn-light">
            ← Back
        </a>
    </div>
</div>

    <div class="order-details-grid">
        <div class="order-info-card">
            <h3>Order Info</h3>

            <div class="info-row">
                <span>Customer</span>
                <strong><?= esc($order['customer_name'] ?? 'Walk-in Customer') ?></strong>
            </div>

            <div class="info-row">
                <span>Order Type</span>
                <strong><?= esc($order['order_type'] ?? 'takeaway') ?></strong>
            </div>

            <div class="info-row">
                <span>Status</span>
                <strong><?= esc($order['status']) ?></strong>
            </div>

            <div class="info-row">
                <span>Cashier</span>
                <strong><?= esc($order['cashier_name'] ?? 'N/A') ?></strong>
            </div>

            <div class="info-row">
                <span>Date</span>
                <strong><?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></strong>
            </div>
        </div>

        <div class="order-info-card">
            <h3>Payment Info</h3>

            <div class="info-row">
                <span>Payment Status</span>
                <strong><?= esc($order['payment_status']) ?></strong>
            </div>

            <div class="info-row">
                <span>Method</span>
                <strong><?= esc($payment['payment_method'] ?? 'N/A') ?></strong>
            </div>

            <div class="info-row">
                <span>Paid Amount</span>
                <strong><?= number_format($payment['amount'] ?? 0, 2) ?></strong>
            </div>
        </div>
    </div>

    <div class="table-card order-items-card">
        <h3>Ordered Items</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= esc($item['item_name']) ?></td>
                        <td><?= esc($item['quantity']) ?></td>
                        <td><?= number_format($item['price'], 2) ?></td>
                        <td><?= number_format($item['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="order-summary">
    <div>
        <span>Subtotal</span>
        <strong><?= esc($appSettings['currency'] ?? '৳') ?> <?= number_format($order['subtotal'] ?? 0, 2) ?></strong>
    </div>

    <div>
        <span>Discount</span>
        <strong><?= esc($appSettings['currency'] ?? '৳') ?> <?= number_format($order['discount'] ?? 0, 2) ?></strong>
    </div>

    <div>
        <span>Tax</span>
        <strong><?= esc($appSettings['currency'] ?? '৳') ?> <?= number_format($order['tax'] ?? 0, 2) ?></strong>
    </div>

    <div>
        <span>Service Charge</span>
        <strong><?= esc($appSettings['currency'] ?? '৳') ?> <?= number_format($order['service_charge'] ?? 0, 2) ?></strong>
    </div>

    <div class="grand-total">
        <span>Grand Total</span>
        <strong><?= esc($appSettings['currency'] ?? '৳') ?> <?= number_format($order['grand_total'] ?? 0, 2) ?></strong>
    </div>
</div>
    </div>
</main>