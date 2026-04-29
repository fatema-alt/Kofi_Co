<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kofi Co. Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="login-body">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-brand">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Kofi Co.">
                <h1>Kofi Co.</h1>
                <p>Restaurant POS Admin</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert-error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('login') ?>">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="admin@kofico.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            
        </div>
    </div>
</body>
</html>