<?php $error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="brand">🩸 <span>BloodConnectBD</span></div>
            <h1>Change Password</h1><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><form method="POST"><label>Current Password</label><input type="password" name="current_password" required><label>New Password</label><input type="password" name="new_password" minlength="6" required><label>Confirm New Password</label><input type="password" name="confirm_password" minlength="6" required><button class="btn-primary">Change Password</button></form>
            <div class="auth-links"><a href="?page=dashboard">← Dashboard</a></div>
        </div>
    </div>
</body>

</html>