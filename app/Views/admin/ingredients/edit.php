<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h1>Edit Ingredient</h1>
        </div>

        <a href="<?= base_url('admin/ingredients') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/ingredients/update/' . $ingredient['id']) ?>">
            <div class="form-grid">

                <div class="form-group">
                    <label>Ingredient Name</label>
                    <input type="text" name="name" value="<?= esc($ingredient['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Unit</label>
                    <select name="unit_id" required>
                        <option value="">Select Unit</option>

                        <?php foreach ($units as $unit): ?>
                            <option value="<?= $unit['id'] ?>" <?= $ingredient['unit_id'] == $unit['id'] ? 'selected' : '' ?>>
                                <?= esc($unit['name']) ?> (<?= esc($unit['short_name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Current Stock</label>
                    <input type="number" step="0.01" name="current_stock" value="<?= esc($ingredient['current_stock']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Low Stock Alert</label>
                    <input type="number" step="0.01" name="low_stock_alert" value="<?= esc($ingredient['low_stock_alert']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Cost Per Unit</label>
                    <input type="number" step="0.01" name="cost_per_unit" value="<?= esc($ingredient['cost_per_unit']) ?>">
                </div>

                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry_date" value="<?= esc($ingredient['expiry_date']) ?>">
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Update Ingredient</button>
            </div>
        </form>
    </div>
</main>