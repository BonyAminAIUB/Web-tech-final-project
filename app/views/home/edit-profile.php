<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="auth-shell">
        <div class="auth-card wide">
            <div class="brand">🩸 BloodConnectBD</div>
            <h1>Edit Profile</h1>
            <form method="POST">
                <div class="form-grid">
                    <div><label>Full Name</label><input name="name" value="<?= htmlspecialchars($user['name']) ?>" required></div>
                    <div><label>Phone</label><input name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required></div>
                    <div><label>Blood Group</label><select name="blood_group">
                            <option value="">Not provided</option><?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $b): ?><option <?= $user['blood_group'] === $b ? 'selected' : '' ?>><?= $b ?></option><?php endforeach; ?>
                        </select></div>
                    <div><label>Location</label><input name="location" value="<?= htmlspecialchars($user['location'] ?? '') ?>"></div>
                </div><button class="btn-primary">Save Changes</button>
            </form>
            <div class="auth-links"><a href="?page=profile">← Back to Profile</a></div>
        </div>
    </div>
</body>

</html>