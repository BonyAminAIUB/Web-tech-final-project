<?php $success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Manage Donors</title>
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
                    <h1>Manage Donors</h1>
                    <p>Manage donor accounts and account status.</p>
                </div>
            </div><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><div class="table-wrap">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Blood</th>
                        <th>Location</th>
                        <th>Availability</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr><?php foreach ($donors as $d): ?><tr>
                            <td><?= $d['id'] ?></td>
                            <td><?= htmlspecialchars($d['name']) ?></td>
                            <td><?= htmlspecialchars($d['email']) ?></td>
                            <td><?= htmlspecialchars($d['phone']) ?></td>
                            <td><b><?= htmlspecialchars($d['blood_group']) ?></b></td>
                            <td><?= htmlspecialchars($d['location'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($d['availability']) ?></td>
                            <td><?= htmlspecialchars($d['status']) ?></td>
                            <td>
                                <form class="inline" method="POST" action="?page=update-donor-status"><input type="hidden" name="user_id" value="<?= $d['id'] ?>"><select name="status">
                                        <option value="active" <?= $d['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= $d['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select><button class="btn-secondary">Save</button></form>
                                <form class="inline" method="POST" action="?page=delete-donor" onsubmit="return confirm('Delete this donor?')"><input type="hidden" name="user_id" value="<?= $d['id'] ?>"><button class="btn-danger">Delete</button></form>
                            </td>
                        </tr><?php endforeach; ?>
                </table>
            </div>
        </main>
    </div>
</body>

</html>