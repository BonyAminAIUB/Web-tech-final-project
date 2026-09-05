<?php
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
$role = $role ?? '';
$labels = ['user' => 'User / Blood Seeker', 'donor' => 'Blood Donor', 'admin' => 'Administrator'];
$action = $role ? '?page=login-' . $role . '-submit' : '?page=login';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= htmlspecialchars($role ? $labels[$role] : 'Login') ?> - BloodConnectBD</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="brand">🩸 <span>BloodConnectBD</span></div>
            <p class="muted">Blood Donor Management System</p>
            <h1><?= htmlspecialchars($role ? $labels[$role] : 'Login') ?></h1>
            <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if (!$role): ?><div class="role-grid"><a class="role-card" href="?page=login-user"><b>👤 User</b><span>Request blood & find donors</span></a><a class="role-card" href="?page=login-donor"><b>🩸 Donor</b><span>Manage availability & donations</span></a><a class="role-card" href="?page=login-admin"><b>🛡️ Admin</b><span>Manage the whole system</span></a></div>
            <?php else: ?><form method="POST" action="<?= $action ?>"><label>Email Address</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button class="btn-primary" type="submit">Login as <?= htmlspecialchars(ucfirst($role)) ?></button></form>
                <div class="auth-links"><a href="?page=reset-password-<?= $role ?>">Forgot / Reset Password?</a></div><?php endif; ?>
            <div class="auth-links">
                <p>Need an account?</p><a href="?page=register-user">User Registration</a> · <a href="?page=register-donor">Donor Registration</a> · <a href="?page=register-admin">Admin Registration</a><?php if ($role): ?><p><a href="?page=login">← Choose another account type</a></p><?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>