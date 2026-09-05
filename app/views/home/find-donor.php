<?php $error = $_SESSION['error'] ?? '';
unset($_SESSION['error']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Find Donor</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=dashboard">Dashboard</a><a href="?page=find-donor">Find Donor</a><a href="?page=profile">Profile</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="page-title">
                <h1>Find Available Donors</h1>
                <p>Only active donors who are currently available appear here.</p>
            </div><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><form class="panel search-form" method="POST"><select name="blood_group" required>
                    <option value="">Blood Group</option><?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $b): ?><option><?= $b ?></option><?php endforeach; ?>
                </select><input name="location" placeholder="Location (optional)"><button class="btn-primary">Search</button></form><?php if (isset($donors)): ?><h2>Results</h2><?php if ($donors): ?><div class="cards"><?php foreach ($donors as $d): ?><div class="feature">
                                <h3><?= htmlspecialchars($d['name']) ?></h3>
                                <p><b><?= htmlspecialchars($d['blood_group']) ?></b> · <?= htmlspecialchars($d['location'] ?? 'Location not provided') ?></p>
                                <p>📞 <?= htmlspecialchars($d['phone']) ?></p>
                                <p>✉ <?= htmlspecialchars($d['email']) ?></p><span class="status-badge">Available</span>
                            </div><?php endforeach; ?></div><?php else: ?><div class="empty">No matching available donors found.</div><?php endif; ?><?php endif; ?>
        </main>
    </div>
</body>

</html>