<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Menu</span>

            <?php if (!empty($category)): ?>
                <h1><?= esc($category['name']) ?> Items</h1>
            <?php else: ?>
                <h1>Menu Items</h1>
            <?php endif; ?>
        </div>

        <div class="page-actions">
            <?php if (!empty($category)): ?>
                <a href="<?= base_url('admin/menu/categories') ?>" class="btn-light">Back</a>
            <?php endif; ?>

            <a href="<?= base_url('admin/menu/items/create') ?>" class="btn-add">+ Add Item</a>
        </div>
    </div>

    <?php if (!empty($category)): ?>
        <div class="category-filter-banner">
            <div>
                <strong>Showing:</strong>
                <span><?= esc($category['name']) ?></span>
            </div>

            <a href="<?= base_url('admin/menu/items') ?>">Clear Filter</a>
        </div>
    <?php endif; ?>

    <div class="item-grid">
        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
                <div class="item-card">
                    <div class="item-img">
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?= base_url('uploads/menu/' . $item['image']) ?>" alt="<?= esc($item['name']) ?>">
                        <?php else: ?>
                            <div class="no-img">🍽️</div>
                        <?php endif; ?>
                    </div>

                    <div class="item-body">
                        <div class="item-top">
                            <h3><?= esc($item['name']) ?></h3>

                            <span class="status-badge <?= $item['status'] ? 'active' : 'inactive' ?>">
                                <?= $item['status'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </div>

                        <p><?= esc($item['description']) ?></p>

                        <div class="item-meta">
                            <span><?= esc($item['category_name'] ?? 'No Category') ?></span>
                            <strong><?= number_format($item['price'], 2) ?></strong>
                        </div>
                    </div>

                    <div class="item-actions">
                        <a href="<?= base_url('admin/menu/items/edit/' . $item['id']) ?>" class="btn-edit">Edit</a>

                        <a href="<?= base_url('admin/menu/items/delete/' . $item['id']) ?>"
                           onclick="return confirm('Delete this item?')"
                           class="btn-delete">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <h3>No items found</h3>
                <p>Add menu items to see them here.</p>
            </div>
        <?php endif; ?>
    </div>
</main>