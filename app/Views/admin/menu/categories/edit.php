<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Menu</span>
            <h1>Edit Category</h1>
        </div>

        <a href="<?= base_url('admin/menu/categories') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/menu/categories/update/'.$category['id']) ?>" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= esc($category['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4"><?= esc($category['description']) ?></textarea>
            </div>

            <div class="form-group">
                <label>Current Image</label>

                <?php if (!empty($category['image'])): ?>
                    <div>
                        <img src="<?= base_url('uploads/categories/'.$category['image']) ?>" class="preview-img" alt="Category Image">
                    </div>
                <?php else: ?>
                    <p>No image uploaded.</p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Change Image</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="1" <?= $category['status'] ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= !$category['status'] ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="form-actions">
                <button class="btn-save" type="submit">Update Category</button>
            </div>
        </form>
    </div>
</main>