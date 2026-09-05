<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Donation History</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=donor-dashboard">Dashboard</a><a href="?page=profile">Profile</a><a href="?page=change-password">Password</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="page-title">
                <h1>Donation History</h1>
                <p>Your recorded blood donations.</p>
            </div><?php if ($donations): ?><div class="table-wrap">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Blood Group</th>
                            <th>Hospital</th>
                            <th>Notes</th>
                        </tr><?php foreach ($donations as $d): ?><tr>
                                <td><?= htmlspecialchars($d['donation_date']) ?></td>
                                <td><?= htmlspecialchars($d['patient_name'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($d['blood_group'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($d['hospital_name'] ?? $d['request_hospital'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($d['notes'] ?? '') ?></td>
                            </tr><?php endforeach; ?>
                    </table>
                </div><?php else: ?><div class="empty">No donation records yet.</div><?php endif; ?>
        </main>
    </div>
</body>

</html>