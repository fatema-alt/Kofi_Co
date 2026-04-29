<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Management</span>
            <h1>Edit User</h1>
        </div>

        <a href="<?= base_url('admin/users') ?>" class="btn-light">Back</a>
    </div>

    <div class="form-card">
        <form method="post" action="<?= base_url('admin/users/update/' . $user['id']) ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?= esc($user['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= esc($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?= esc($user['phone']) ?>">
                </div>

                <div class="form-group">
                    <label>Password <small>(leave blank to keep old)</small></label>
                    <input type="password" name="password">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role_id" required>
                        <option value="">Select Role</option>

                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role['id'] ?>"
                                <?= isset($userRole['role_id']) && $userRole['role_id'] == $role['id'] ? 'selected' : '' ?>>
                                <?= esc($role['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Update User</button>
            </div>
        </form>
    </div>
</main>