<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Business</span>
            <h1>Reports</h1>
        </div>
    </div>

    <form method="get" action="<?= base_url('admin/reports') ?>" class="report-filter">
        <div class="form-group">
            <label>From</label>
            <input type="date" name="from" value="<?= esc($from) ?>">
        </div>

        <div class="form-group">
            <label>To</label>
            <input type="date" name="to" value="<?= esc($to) ?>">
        </div>

        <button type="submit" class="btn-save">Filter</button>
    </form>

    <div class="dashboard-cards">
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div>
                <p>Total Sales</p>
                <h2><?= number_format($sales['total_sales'] ?? 0, 2) ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🧾</div>
            <div>
                <p>Total Orders</p>
                <h2><?= $sales['total_orders'] ?? 0 ?></h2>
            </div>
        </div>
    </div>

   <div class="reports-grid">
    <div class="report-card">
        <div class="section-title">
    <h3>☕ Daily Sales</h3>
    <span>Performance Trend</span>
</div>

        <canvas id="dailySalesChart"></canvas>
    </div>

    <div class="report-card">
        <div class="section-title">
    <h3>🍩 Category Sales</h3>
    <span>Distribution</span>
</div>

        <canvas id="categorySalesChart"></canvas>
    </div>
</div>
                  


    <div class="reports-grid">
        <div class="report-card">
            <div class="section-title">
                <h3>Top Selling Items</h3>
                <span>Top 10</span>
            </div>

            <?php if (!empty($topItems)): ?>
                <?php foreach ($topItems as $item): ?>
                    <div class="report-row">
                        <div>
                            <strong><?= esc($item['name']) ?></strong>
                            <small><?= esc($item['total_qty']) ?> sold</small>
                        </div>
                        <span><?= number_format($item['total_amount'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No sales data found.</p>
            <?php endif; ?>
        </div>

        <div class="report-card">
            <div class="section-title">
                <h3>Payment Methods</h3>
                <span>Summary</span>
            </div>

            <?php if (!empty($paymentSummary)): ?>
                <?php foreach ($paymentSummary as $payment): ?>
                    <div class="report-row">
                        <strong><?= esc($payment['name']) ?></strong>
                        <span><?= number_format($payment['total'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No payment data found.</p>
            <?php endif; ?>
        </div>

        <div class="report-card full">
            <div class="section-title">
                <h3>Low Stock Alert</h3>
                <span>Inventory</span>
            </div>

            <?php if (!empty($lowStock)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Current Stock</th>
                            <th>Low Alert</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lowStock as $stock): ?>
                            <tr>
                                <td><?= esc($stock['name']) ?></td>
                                <td><?= esc($stock['current_stock']) ?> <?= esc($stock['unit_name']) ?></td>
                                <td><?= esc($stock['low_stock_alert']) ?> <?= esc($stock['unit_name']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No low stock items.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<script>
    const dailyLabels = <?= json_encode(array_map(function($day) {
        return date('d M', strtotime($day['sale_date']));
    }, $dailySales)) ?>;

    const dailyValues = <?= json_encode(array_map('floatval', array_column($dailySales, 'total_sales'))) ?>;

    const categoryLabels = <?= json_encode(array_map(function($cat) {
        return $cat['category_name'] ?? 'Uncategorized';
    }, $categorySales)) ?>;

    const categoryValues = <?= json_encode(array_map('floatval', array_column($categorySales, 'total_amount'))) ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
<script src="<?= base_url('assets/js/chart.js') ?>"></script>