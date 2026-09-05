<?php
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
$role = $role ?? 'user';
$labels = ['user' => 'User / Blood Seeker', 'donor' => 'Blood Donor', 'admin' => 'Administrator'];
$action = '?page=register-' . $role . '-submit';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= htmlspecialchars($labels[$role]) ?> Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="auth-shell">
        <div class="auth-card wide">
            <div class="brand">🩸 <span>BloodConnectBD</span></div>
            <p class="muted">Create a <?= htmlspecialchars(strtolower($labels[$role])) ?> account</p>
            <h1>Registration</h1>
            <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="POST" action="<?= $action ?>">
                <div class="form-grid">
                    <div><label>Full Name</label><input name="name" required></div>
                    <div><label>Email</label><input type="email" name="email" required></div>
                    <div><label>Phone</label><input name="phone" required placeholder="01XXXXXXXXX"></div>
                    <div><label>Blood Group <?= ($role === 'donor' ? '' : '(optional)') ?></label><select name="blood_group">
                            <option value="">Select</option><?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $b): ?><option><?= $b ?></option><?php endforeach; ?>
                        </select></div>
                    <div><label>Location</label><input name="location" placeholder="e.g. Dhaka"></div><div><label>Password</label><input type="password" name="password" minlength="6" required></div>
                    <div><label>Confirm Password</label><input type="password" name="confirm_password" minlength="6" required></div>
                </div><button class="btn-primary" type="submit">Create <?= htmlspecialchars(ucfirst($role)) ?> Account</button>
            </form>
            <div class="auth-links">Already registered? <a href="?page=login-<?= $role ?>">Login as <?= htmlspecialchars(ucfirst($role)) ?></a></div>
        </div>
    </div>
</body>

</html>