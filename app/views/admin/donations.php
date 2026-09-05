<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Donation Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🛡️ BloodConnectBD</div>
            <nav><a href="?page=admin-dashboard">Dashboard</a><a href="?page=admin-users">Users</a><a href="?page=admin-donors">Donors</a><a href="?page=admin-requests">Requests</a><a href="?page=admin-donations">Donations</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="page-title">
                <h1>Donation Records</h1>
                <p>All recorded donations.</p>
            </div><?php if ($donations): ?><div class="table-wrap">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Donor</th>
                            <th>Email</th>
                            <th>Patient</th>
                            <th>Blood</th>
                            <th>Hospital</th>
                            <th>Notes</th>
                        </tr><?php foreach ($donations as $d): ?><tr>
                                <td><?= htmlspecialchars($d['donation_date']) ?></td>
                                <td><?= htmlspecialchars($d['donor_name']) ?></td>
                                <td><?= htmlspecialchars($d['donor_email']) ?></td>
                                <td><?= htmlspecialchars($d['patient_name'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($d['blood_group'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($d['hospital_name'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($d['notes'] ?? '') ?></td>
                            </tr><?php endforeach; ?>
                    </table>
                </div><?php else: ?><div class="empty">No donation records.</div><?php endif; ?>
        </main>
    </div>
</body>

</html>