<?php $error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
$role = $_SESSION['user_role'];
$back = $role === 'admin' ? 'admin-dashboard' : ($role === 'donor' ? 'donor-dashboard' : 'user-dashboard'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=<?= $back ?>">Dashboard</a><a href="?page=edit-profile">Edit Profile</a><a href="?page=change-password">Password</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="page-title">
                <h1>My Profile</h1>
                <p>Your account information</p>
            </div><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><div class="profile-card">
                <div class="avatar">👤</div>
                <div>
                    <h2><?= htmlspecialchars($user['name']) ?></h2>
                    <p><?= htmlspecialchars($user['email']) ?></p><span class="pill"><?= strtoupper(htmlspecialchars($user['role'])) ?></span>
                </div><a class="btn-secondary" href="?page=edit-profile">Edit Profile</a>
            </div>
            <div class="info-grid">
                <div><b>Phone</b><span><?= htmlspecialchars($user['phone']) ?></span></div>
                <div><b>Blood Group</b><span><?= htmlspecialchars($user['blood_group'] ?? 'Not provided') ?></span></div>
                <div><b>Location</b><span><?= htmlspecialchars($user['location'] ?? 'Not provided') ?></span></div>
                <div><b>Account Status</b><span><?= htmlspecialchars($user['status']) ?></span></div>
            </div><?php if ($role === 'donor'): ?><div class="profile-card">
                    <div>
                        <h3>Donor Availability</h3>
                        <p>Control whether you appear in donor search.</p>
                    </div>
                    <form method="POST" action="?page=update-availability"><select name="availability">
                            <option <?= $user['availability'] === 'Available' ? 'selected' : '' ?>>Available</option>
                            <option <?= $user['availability'] === 'Not Available' ? 'selected' : '' ?>>Not Available</option>
                        </select><button class="btn-primary">Save Availability</button></form>
                </div><?php endif; ?>
        </main>
    </div>
</body>

</html>