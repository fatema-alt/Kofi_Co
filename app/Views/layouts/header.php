<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="icon" type="image/png" sizes="40x40" href="<?= base_url('assets/images/logo.png') ?>">
    <title><?= esc($appSettings['restaurant_name'] ?? 'Kofi Co.') ?></title>
</head>
<body>
    <header class="header">
    <div class="header-left">
        <img src="<?= base_url('assets/images/logo.png') ?>" class="logo-icon">
        <span class="logo-text">Kofi Co.</span>
    </div>

    <div class="header-right">
    <div class="user-menu">
        <button class="user-btn" id="userBtn">
            <span class="avatar">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="User">
            </span>

            <span class="user-name"><?= esc(session()->get('user_name') ?? 'User') ?></span>
            <span class="arrow">▼</span>
        </button>

        <div class="dropdown" id="dropdownMenu">
    <a href="<?= base_url('admin/profile') ?>">Profile</a>
    <a href="<?= base_url('logout') ?>">Logout</a>
</div>
    </div>
</div>
</header>

<script src="<?= base_url('assets/js/button.js') ?>"></script>
</body>
</html>




