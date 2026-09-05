<?php $success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Manage Users</title>
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
                    <h1>Manage Users</h1>
                    <p>Blood seekers / normal users.</p>
                </div>
            </div><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><div class="table-wrap">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr><?php foreach ($users as $u): ?><tr>
                            <td><?= $u['id'] ?></td>
                            <td><?= htmlspecialchars($u['name']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['phone']) ?></td>
                            <td><?= htmlspecialchars($u['status']) ?></td>
                            <td><?= htmlspecialchars($u['created_at']) ?></td>
                            <td>
                                <form class="inline" method="POST" action="?page=update-user-status"><input type="hidden" name="user_id" value="<?= $u['id'] ?>"><select name="status">
                                        <option value="active" <?= $u['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= $u['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select><button class="btn-secondary">Save</button></form>
                                <form class="inline" method="POST" action="?page=delete-user" onsubmit="return confirm('Delete this user?')"><input type="hidden" name="user_id" value="<?= $u['id'] ?>"><button class="btn-danger">Delete</button></form>
                            </td>
                        </tr><?php endforeach; ?>
                </table>
            </div>
        </main>
    </div>
</body>

</html>