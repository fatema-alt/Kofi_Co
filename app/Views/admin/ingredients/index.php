<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h1>Ingredients</h1>
        </div>

        <a href="<?= base_url('admin/ingredients/create') ?>" class="btn-add">+ Add</a>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Unit</th>
                    <th>Low Alert</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($ingredients as $item): ?>
                    <tr class="<?= $item['current_stock'] <= $item['low_stock_alert'] ? 'low-stock' : '' ?>">
                        <td><?= esc($item['name']) ?></td>
                        <td><?= esc($item['current_stock']) ?></td>
                        <td><?= esc($item['unit_name']) ?></td>
                        <td><?= esc($item['low_stock_alert']) ?></td>
                        <td>
                            <span class="status-badge <?= $item['status'] ? 'active' : 'inactive' ?>">
                                <?= $item['status'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/ingredients/edit/'.$item['id']) ?>" class="btn-edit">Edit</a>
                            <a href="<?= base_url('admin/ingredients/delete/'.$item['id']) ?>" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>