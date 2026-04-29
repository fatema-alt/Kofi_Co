<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>Add Vendor</h1>
        </div>

        <a href="<?= base_url('admin/vendors') ?>" class="btn-light">
            ← Back
        </a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/vendors/store') ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address"></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button class="btn-save">Save Vendor</button>
        </form>
    </div>
</main>