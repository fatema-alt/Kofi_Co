<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">System</span>
            <h1>Restaurant Settings</h1>
        </div>
    </div>

    <div id="toast" class="toast">
        <span></span>
    </div>

    <div class="settings-grid">
        <div class="settings-preview">
            <div class="settings-logo">
                <?php if (!empty($settings['logo'])): ?>
                    <img src="<?= base_url('uploads/settings/' . $settings['logo']) ?>" alt="Logo">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
                <?php endif; ?>
            </div>

            <h2><?= esc($settings['restaurant_name'] ?? 'Kofi Co.') ?></h2>
            <p><?= esc($settings['address'] ?? '') ?></p>
            <span><?= esc($settings['phone'] ?? '') ?></span>
        </div>

        <div class="form-card">
            <form method="post" action="<?= base_url('admin/settings/update') ?>" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Restaurant Name</label>
                        <input type="text" name="restaurant_name" value="<?= esc($settings['restaurant_name'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?= esc($settings['phone'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= esc($settings['email'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Currency Symbol</label>
                        <input type="text" name="currency" value="<?= esc($settings['currency'] ?? '৳') ?>">
                    </div>

                    <div class="form-group">
                        <label>Tax Percent (%)</label>
                        <input type="number" step="0.01" name="tax_percent" value="<?= esc($settings['tax_percent'] ?? 0) ?>">
                    </div>

                    <div class="form-group">
                        <label>Service Charge (%)</label>
                        <input type="number" step="0.01" name="service_charge" value="<?= esc($settings['service_charge'] ?? 0) ?>">
                    </div>

                    <div class="form-group full-width">
                        <label>Address</label>
                        <textarea name="address" rows="3"><?= esc($settings['address'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label>Receipt Footer</label>
                        <textarea name="receipt_footer" rows="3"><?= esc($settings['receipt_footer'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label>Logo</label>
                        <input type="file" name="logo" accept="image/*">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="<?= base_url('assets/js/toast.js') ?>"></script>

<?php if (session()->getFlashdata('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        showToast("<?= esc(session()->getFlashdata('success')) ?>");
    });
</script>
<?php endif; ?>