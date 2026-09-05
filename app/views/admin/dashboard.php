<?php
$totalUsers = $totalUsers ?? 0;
$totalDonors = $totalDonors ?? 0;
$totalRequests = $totalRequests ?? 0;
$pendingRequests = $pendingRequests ?? 0;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header class="admin-header">
            <div class="brand">🛡️ BloodConnectBD <small>ADMIN</small></div>
            <nav><a href="?page=admin-dashboard">Dashboard</a><a href="?page=admin-users">Users</a><a href="?page=admin-donors">Donors</a><a href="?page=admin-requests">Requests</a><a href="?page=admin-donations">Donations</a><a href="?page=profile">Profile</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="hero">
                <div><span class="pill admin">ADMINISTRATOR</span>
                    <h1>System Control Center</h1>
                    <p>Manage users, donors, requests and donation records.</p>
                </div>
            </div>
            <div class="stats">
                <div><span>Total Users</span><b><?= $totalUsers ?></b></div>
                <div><span>Total Donors</span><b><?= $totalDonors ?></b></div>
                <div><span>Total Requests</span><b><?= $totalRequests ?></b></div>
                <div><span>Pending Requests</span><b><?= $pendingRequests ?></b></div>
            </div>
            <section class="cards"><a class="feature" href="?page=admin-users">
                    <h3>👥 Manage Users</h3>
                    <p>View, activate, deactivate and remove user accounts.</p>
                </a><a class="feature" href="?page=admin-donors">
                    <h3>🩸 Manage Donors</h3>
                    <p>Manage donor accounts and availability.</p>
                </a><a class="feature" href="?page=admin-requests">
                    <h3>📋 Blood Requests</h3>
                    <p>Approve, reject and complete blood requests.</p>
                </a><a class="feature" href="?page=admin-donations">
                    <h3>❤️ Donations</h3>
                    <p>Review donation history recorded in the system.</p>
                </a></section>
        </main>
    </div>
</body>

</html>