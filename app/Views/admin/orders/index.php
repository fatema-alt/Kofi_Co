<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Sales</span>
            <h1>Orders</h1>
        </div>
    </div>

    <div id="toast" class="toast">
        <span></span>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Cashier</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= esc($order['order_no']) ?></td>
                            <td><?= esc($order['customer_name'] ?? 'Walk-in Customer') ?></td>
                            <td><?= esc($order['order_type'] ?? 'takeaway') ?></td>
                            <td><?= number_format($order['grand_total'], 2) ?></td>
                            <td>
                                <span class="status-badge <?= esc($order['payment_status']) ?>">
                                    <?= esc($order['payment_status']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge <?= esc($order['status']) ?>">
                                    <?= esc($order['status']) ?>
                                </span>
                            </td>
                            <td><?= esc($order['cashier_name'] ?? 'N/A') ?></td>
                            <td><?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('admin/orders/show/' . $order['id']) ?>" class="btn-view">View</a>

                                    <a href="<?= base_url('admin/orders/delete/' . $order['id']) ?>"
                                       onclick="return confirm('Delete this order?')"
                                       class="btn-delete">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="<?= base_url('assets/js/toast.js') ?>"></script>

<?php if (session()->getFlashdata('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        showToast("<?= esc(session()->getFlashdata('success')) ?>");
    });
</script>
<?php endif; ?>