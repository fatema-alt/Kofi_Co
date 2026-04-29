<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Account</span>
            <h1>My Profile</h1>
        </div>
    </div>

    <div id="toast" class="toast">
        <span></span>
    </div>

    <div class="profile-grid">
        <div class="profile-card">
            <div class="profile-avatar">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Profile">
            </div>

            <h2><?= esc($user['name']) ?></h2>
            <p><?= esc($user['email']) ?></p>

            <span class="status-badge <?= esc($user['status']) ?>">
                <?= esc($user['status']) ?>
            </span>
        </div>

        <div class="profile-form-card">
            <h3>Profile Information</h3>

            <form method="post" action="<?= base_url('admin/profile/update') ?>">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?= esc($user['name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?= esc($user['phone']) ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="<?= esc($user['email']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" value="<?= esc($user['role_name'] ?? 'No Role') ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" value="<?= esc($user['status']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Member Since</label>
                        <input type="text" value="<?= date('d M, Y', strtotime($user['created_at'])) ?>" readonly>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Update Profile</button>
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