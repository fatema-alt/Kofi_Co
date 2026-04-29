<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h1>Add Stock Movement</h1>
        </div>

        <a href="<?= base_url('admin/stock-movements') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/stock-movements/store') ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Ingredient</label>
                    <select name="ingredient_id" required>
                        <option value="">Select Ingredient</option>
                        <?php foreach ($ingredients as $ingredient): ?>
                            <option value="<?= $ingredient['id'] ?>">
                                <?= esc($ingredient['name']) ?> 
                                (Current: <?= esc($ingredient['current_stock']) ?> <?= esc($ingredient['unit_name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Movement Type</label>
                    <select name="type" required>
                        <option value="">Select Type</option>
                        <option value="purchase">Purchase / Stock In</option>
                        <option value="waste">Waste / Spoilage</option>
                        <option value="adjustment_in">Adjustment In</option>
                        <option value="adjustment_out">Adjustment Out</option>
                        <option value="return">Return</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" step="0.01" name="quantity" required>
                </div>

                <div class="form-group full-width">
                    <label>Note</label>
                    <textarea name="note" rows="4" placeholder="Example: Bought from local vendor / spoiled item"></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Stock Movement</button>
            </div>
        </form>
    </div>
</main>