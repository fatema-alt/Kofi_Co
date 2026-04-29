<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Menu</span>
            <h1>Edit Menu Item</h1>
        </div>

        <a href="<?= base_url('admin/menu/items') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/menu/items/update/' . $item['id']) ?>" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="name" value="<?= esc($item['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= $item['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                <?= esc($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01" value="<?= esc($item['price']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="1" <?= $item['status'] ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= !$item['status'] ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Description</label>
                    <textarea name="description" rows="4"><?= esc($item['description']) ?></textarea>
                </div>

                <div class="form-group full-width">
                    <label>Current Image</label>

                    <?php if (!empty($item['image'])): ?>
                        <div>
                            <img src="<?= base_url('uploads/menu/' . $item['image']) ?>" class="preview-img" alt="Item Image">
                        </div>
                    <?php else: ?>
                        <p>No image uploaded.</p>
                    <?php endif; ?>
                </div>

                <div class="form-group full-width">
                    <label>Change Image</label>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Update Item</button>
            </div>
        </form>
    </div>
    <div class="recipe-card">
    <div class="recipe-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h3>Recipe Mapping</h3>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error profile-alert">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('admin/menu/items/recipe/store') ?>" class="recipe-form">
        <input type="hidden" name="menu_item_id" value="<?= $item['id'] ?>">

        <div class="form-group">
            <label>Ingredient</label>
            <select name="ingredient_id" required>
                <option value="">Select Ingredient</option>

                <?php foreach ($ingredients as $ingredient): ?>
                    <option value="<?= $ingredient['id'] ?>">
                        <?= esc($ingredient['name']) ?> (<?= esc($ingredient['unit_name']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Quantity Used</label>
            <input type="number" step="0.01" name="quantity" required>
        </div>

        <div class="form-group recipe-btn-wrap">
            <label>&nbsp;</label>
            <button type="submit" class="btn-save">Add Ingredient</button>
        </div>
    </form>

    <div class="recipe-list">
        <?php if (!empty($recipeItems)): ?>
            <?php foreach ($recipeItems as $recipe): ?>
                <div class="recipe-row">
                    <div>
                        <strong><?= esc($recipe['ingredient_name']) ?></strong>
                        <span><?= esc($recipe['quantity']) ?> <?= esc($recipe['unit_name']) ?></span>
                    </div>

                    <a href="<?= base_url('admin/menu/items/recipe/delete/' . $recipe['id'] . '/' . $item['id']) ?>"
                       onclick="return confirm('Remove this ingredient from recipe?')"
                       class="btn-delete">
                        Remove
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty-text">No recipe ingredients added yet.</p>
        <?php endif; ?>
    </div>
</div>
</main>