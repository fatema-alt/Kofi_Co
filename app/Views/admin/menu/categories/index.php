<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Menu</span>
            <h1>Categories</h1>
        </div>

        <a href="<?= base_url('admin/menu/categories/create') ?>" class="btn-add">+ Add Category</a>
    </div>

    <div class="category-grid">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>

                <div class="category-card">

                    <!-- IMAGE -->
                    <div class="category-img">
                        <?php if (!empty($cat['image'])): ?>
                            <img src="<?= base_url('uploads/categories/'.$cat['image']) ?>">
                        <?php else: ?>
                            <div class="no-img">📂</div>
                        <?php endif; ?>
                    </div>

                    <!-- CONTENT -->
                    <div class="category-body">
                        <h3><?= esc($cat['name']) ?></h3>

                        <p><?= esc($cat['description']) ?></p>

                        <div class="category-meta">
                            <span class="item-count">
                                <?= $cat['total_items'] ?? 0 ?> items
                            </span>

                            <span class="status-badge <?= $cat['status'] ? 'active' : 'inactive' ?>">
                                <?= $cat['status'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="category-actions">
                        <a href="<?= base_url('admin/menu/items?category='.$cat['id']) ?>" class="btn-view">
                            View Items
                        </a>

                        <a href="<?= base_url('admin/menu/categories/edit/'.$cat['id']) ?>" class="btn-edit">
                            Edit
                        </a>

                        <a href="<?= base_url('admin/menu/categories/delete/'.$cat['id']) ?>"
                           onclick="return confirm('Delete this category?')"
                           class="btn-delete">
                            Delete
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>No categories found</p>
        <?php endif; ?>
    </div>
</main>