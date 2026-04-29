<?= view('layouts/header') ?>

<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="dashboard-header">
        <div>
            <span class="eyebrow">Kofi Co.</span>
            <h1>Dashboard Overview</h1>
        </div>
        
        <div class="date-pill"><?= date('d M, Y') ?></div>
    </div>

    <div class="dashboard-cards">
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div>
                <p>Today Sales</p>
                <h2><?= number_format($todaySales, 2) ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🧾</div>
            <div>
                <p>Today Orders</p>
                <h2><?= $todayOrders ?></h2>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <section class="dashboard-section large">
            <div class="section-title">
                <h3>Recent Orders</h3>
                <span>Latest 5</span>
            </div>

            <?php if (!empty($recentOrders)): ?>
                <?php foreach ($recentOrders as $order): ?>
                    <div class="list-item">
                        <div>
                            <span><?= esc($order['order_no']) ?></span>
                            <small><?= esc($order['order_type']) ?></small>
                        </div>
                        <strong><?= number_format($order['grand_total'], 2) ?></strong>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </section>

        <section class="dashboard-section">
            <div class="section-title">
                <h3>Top Selling Items</h3>
                <span>Popular</span>
            </div>

            <?php if (!empty($topItems)): ?>
                <?php foreach ($topItems as $item): ?>
                    <div class="list-item">
                        <span><?= esc($item['name']) ?></span>
                        <strong><?= $item['total_sold'] ?> sold</strong>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No sales data found.</p>
            <?php endif; ?>
        </section>

        <section class="dashboard-section">
            <div class="section-title">
                <h3>Low Stock Items</h3>
                <span>Alert</span>
            </div>

            <?php if (!empty($lowStockItems)): ?>
                <?php foreach ($lowStockItems as $stock): ?>
                    <div class="list-item danger">
                        <span><?= esc($stock['name']) ?></span>
                        <strong><?= $stock['current_stock'] ?></strong>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No low stock items.</p>
            <?php endif; ?>
        </section>

        <section class="dashboard-section payment-card">
            <div class="section-title">
                <h3>Payment Summary</h3>
                <span>Today</span>
            </div>

            <?php if (!empty($paymentSummary)): ?>
                <?php foreach ($paymentSummary as $payment): ?>
                    <div class="payment-row">
                        <span><?= esc($payment['name']) ?></span>
                        <div class="payment-bar">
                            <div style="width: <?= min(100, ($payment['total'] / max($todaySales, 1)) * 100) ?>%"></div>
                        </div>
                        <strong><?= number_format($payment['total'], 2) ?></strong>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No payments today.</p>
            <?php endif; ?>
        </section>
    </div>
</main>
<script>
document.querySelectorAll('.counter').forEach(counter => {
    const target = parseFloat(counter.dataset.target);
    let value = 0;
    const step = target / 50;

    function animate() {
        value += step;

        if (value < target) {
            counter.textContent = target > 20
                ? Math.floor(value).toLocaleString()
                : Math.floor(value);
            requestAnimationFrame(animate);
        } else {
            counter.textContent = target.toLocaleString(undefined, {
                minimumFractionDigits: target % 1 === 0 ? 0 : 2,
                maximumFractionDigits: 2
            });
        }
    }

    animate();
});
</script>