<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h1>Stock Movements</h1>
        </div>

        <a href="<?= base_url('admin/stock-movements/create') ?>" class="btn-add">+ Add Stock Movement</a>
    </div>

    <div id="toast" class="toast">
        <span></span>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error profile-alert">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Type</th>
                    <th>Direction</th>
                    <th>Quantity</th>
                    <th>Note</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($movements)): ?>
                    <?php foreach ($movements as $move): ?>
                        <tr>
                            <td><?= esc($move['ingredient_name']) ?></td>
                            <td><?= esc($move['type']) ?></td>
                            <td>
                                <span class="stock-badge <?= $move['direction'] ?>">
                                    <?= strtoupper($move['direction']) ?>
                                </span>
                            </td>
                            <td>
                                <?= esc($move['quantity']) ?> <?= esc($move['unit_name']) ?>
                            </td>
                            <td><?= esc($move['note'] ?? '-') ?></td>
                            <td><?= date('d M Y, h:i A', strtotime($move['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No stock movements found.</td>
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