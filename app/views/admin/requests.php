<?php $success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Manage Requests</title>
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
                <div>
                    <h1>Blood Requests</h1>
                    <p>Admin approval and request management.</p>
                </div>
            </div><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><div class="table-wrap">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Requester</th>
                        <th>Blood</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Urgency</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr><?php foreach ($requests as $r): ?><tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= htmlspecialchars($r['patient_name']) ?></td>
                            <td><?= htmlspecialchars($r['requester_name']) ?></td>
                            <td><b><?= htmlspecialchars($r['blood_group']) ?></b></td>
                            <td><?= htmlspecialchars($r['location']) ?></td>
                            <td><?= htmlspecialchars($r['required_date']) ?></td>
                            <td><?= htmlspecialchars($r['urgency']) ?></td>
                            <td><span class="status-badge"><?= htmlspecialchars($r['request_status']) ?></span></td>
                            <td>
                                <form method="POST" action="?page=update-request-status"><input type="hidden" name="request_id" value="<?= $r['id'] ?>"><select name="status" onchange="this.form.submit()"><?php foreach (['Pending', 'Approved', 'Rejected', 'Completed'] as $s): ?><option <?= $r['request_status'] === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach; ?></select></form>
                            </td>
                        </tr><?php endforeach; ?>
                </table>
            </div>
        </main>
    </div>
</body>

</html>