<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h1>Add Ingredient</h1>
        </div>

        <a href="<?= base_url('admin/ingredients') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/ingredients/store') ?>">
            <div class="form-grid">

                <div class="form-group">
                    <label>Ingredient Name</label>
                    <input type="text" name="name" placeholder="Example: Chicken, Milk, Coffee Beans" required>
                </div>

                <div class="form-group">
                    <label>Unit</label>
                    <select name="unit_id" required>
                        <option value="">Select Unit</option>

                        <?php foreach ($units as $unit): ?>
                            <option value="<?= $unit['id'] ?>">
                                <?= esc($unit['name']) ?> (<?= esc($unit['short_name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Current Stock</label>
                    <input type="number" step="0.01" name="current_stock" value="0" required>
                </div>

                <div class="form-group">
                    <label>Low Stock Alert</label>
                    <input type="number" step="0.01" name="low_stock_alert" value="0" required>
                </div>

                <div class="form-group">
                    <label>Cost Per Unit</label>
                    <input type="number" step="0.01" name="cost_per_unit" value="0">
                </div>

                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry_date">
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Ingredient</button>
            </div>
        </form>
    </div>
</main>