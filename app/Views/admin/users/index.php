<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Management</span>
            <h1>Users & Roles</h1>
        </div>

        <a href="<?= base_url('admin/users/create') ?>" class="btn-add">+ Add User</a>
    </div>

    <div id="toast" class="toast">
        <span>User created successfully 🎉</span>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
    <td><?= esc($user['name']) ?></td>
    <td><?= esc($user['email']) ?></td>
    <td><?= esc($user['phone']) ?></td>
    <td><?= esc($user['role_name'] ?? 'No Role') ?></td>
    <td>
        <span class="status-badge <?= esc($user['status']) ?>">
            <?= esc($user['status']) ?>
        </span>
    </td>

    <!-- NEW ACTION COLUMN -->
    <td>
        <div class="action-buttons">
            <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" class="btn-edit">
                ✏️ Edit
            </a>

            <a href="<?= base_url('admin/users/delete/' . $user['id']) ?>" 
               class="btn-delete"
               onclick="return confirm('Delete this user?')">
                🗑 Delete
            </a>
        </div>
    </td>
</tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="<?= base_url('assets/js/toast.js') ?>"></script>
<script src="<?= base_url('assets/js/delete-confirm.js') ?>"></script>

<?php if (session()->getFlashdata('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        showToast("<?= esc(session()->getFlashdata('success')) ?>");
    });
</script>
<?php endif; ?>