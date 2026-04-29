<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Menu</span>
            <h1>Add Category</h1>
        </div>

        <a href="<?= base_url('admin/menu/categories') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/menu/categories/store') ?>" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Category Image</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="form-actions">
                <button class="btn-save" type="submit">Save Category</button>
            </div>
        </form>
    </div>
</main>