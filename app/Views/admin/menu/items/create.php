<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Menu</span>
            <h1>Add Menu Item</h1>
        </div>

        <a href="<?= base_url('admin/menu/items') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/menu/items/store') ?>" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>">
                                <?= esc($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Description</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <div class="form-group full-width">
                    <label>Item Image</label>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Item</button>
            </div>
        </form>
    </div>
</main>