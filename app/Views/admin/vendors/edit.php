<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <h1>Edit Vendor</h1>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/vendors/update/'.$vendor['id']) ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= esc($vendor['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" value="<?= esc($vendor['contact_person']) ?>">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= esc($vendor['phone']) ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= esc($vendor['email']) ?>">
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address"><?= esc($vendor['address']) ?></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="1" <?= $vendor['status'] ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= !$vendor['status'] ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <button class="btn-save">Update Vendor</button>
        </form>
    </div>
</main>