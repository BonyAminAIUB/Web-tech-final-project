<?php $success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Requests</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=user-dashboard">Dashboard</a><a href="?page=create-request">Request Blood</a><a href="?page=find-donor">Find Donor</a><a href="?page=profile">Profile</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="page-title">
                <h1>My Blood Requests</h1><a class="btn-primary" href="?page=create-request">+ New Request</a>
            </div><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><?php if ($requests): ?><div class="table-wrap">
                    <table>
                        <tr>
                            <th>Patient</th>
                            <th>Blood</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr><?php foreach ($requests as $r): ?><tr>
                                <td><?= htmlspecialchars($r['patient_name']) ?></td>
                                <td><b><?= htmlspecialchars($r['blood_group']) ?></b></td>
                                <td><?= htmlspecialchars($r['location']) ?></td>
                                <td><?= htmlspecialchars($r['required_date']) ?></td>
                                <td><?= htmlspecialchars($r['urgency']) ?></td>
                                <td><span class="status-badge"><?= htmlspecialchars($r['request_status']) ?></span></td>
                                <td>
                                    <form method="POST" action="?page=delete-request" onsubmit="return confirm('Delete this request?')"><input type="hidden" name="request_id" value="<?= $r['id'] ?>"><button class="btn-danger">Delete</button></form>
                                </td>
                            </tr><?php endforeach; ?>
                    </table>
                </div><?php else: ?><div class="empty">You have not created any blood requests yet.</div><?php endif; ?>
        </main>
    </div>
</body>

</html>