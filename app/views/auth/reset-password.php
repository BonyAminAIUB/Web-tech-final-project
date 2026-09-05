<?php $error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
$role = $role ?? 'user';
$labels = ['user' => 'User', 'donor' => 'Donor', 'admin' => 'Admin']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Reset <?= $labels[$role] ?> Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="brand">🩸 <span>BloodConnectBD</span></div>
            <h1>Reset <?= $labels[$role] ?> Password</h1>
            <p class="muted">Verify your email and phone number, then choose a new password.</p><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><form method="POST"><label>Email</label><input type="email" name="email" required><label>Phone</label><input name="phone" required><label>New Password</label><input type="password" name="new_password" minlength="6" required><label>Confirm New Password</label><input type="password" name="confirm_password" minlength="6" required><button class="btn-primary">Reset Password</button></form>
            <div class="auth-links"><a href="?page=login-<?= $role ?>">← Back to <?= $labels[$role] ?> Login</a></div>
        </div>
    </div>
</body>

</html>