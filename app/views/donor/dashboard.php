<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=donor-dashboard">Dashboard</a><a href="?page=find-donor">Find Donor</a><a href="?page=donation-history">Donation History</a><a href="?page=profile">My Profile</a><a href="?page=change-password">Password</a><a class="danger-link" href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="hero">
                <div><span class="pill donor">DONOR</span>
                    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?> 🩸</h1>
                    <p>Your availability can help someone in need.</p>
                </div><a class="btn-primary" href="?page=profile">Manage Availability</a>
            </div>
            <div class="stats">
                <div><span>Donation Records</span><b><?= count($donations) ?></b></div>
                <div><span>Pending Blood Requests</span><b><?= count($pendingRequests) ?></b></div>
                <div><span>Role</span><b>Donor</b></div>
            </div>
            <section class="cards"><a href="?page=profile" class="feature">
                    <h3>🟢 Availability</h3>
                    <p>Set yourself Available or Not Available.</p>
                </a><a href="?page=donation-history" class="feature">
                    <h3>❤️ Donation History</h3>
                    <p>See your previous donations.</p>
                </a><a href="?page=find-donor" class="feature">
                    <h3>🔎 Donor Directory</h3>
                    <p>Search donor information when needed.</p>
                </a><a href="?page=profile" class="feature">
                    <h3>👤 My Profile</h3>
                    <p>Keep your contact and blood group information updated.</p>
                </a></section>
            <section>
                <h2>Current Blood Requests</h2><?php if ($pendingRequests): ?><div class="table-wrap">
                        <table>
                            <tr>
                                <th>Patient</th>
                                <th>Blood</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Urgency</th>
                            </tr><?php foreach ($pendingRequests as $r): ?><tr>
                                    <td><?= htmlspecialchars($r['patient_name']) ?></td>
                                    <td><b><?= htmlspecialchars($r['blood_group']) ?></b></td>
                                    <td><?= htmlspecialchars($r['location']) ?></td>
                                    <td><?= htmlspecialchars($r['required_date']) ?></td>
                                    <td><?= htmlspecialchars($r['urgency']) ?></td>
                                </tr><?php endforeach; ?>
                        </table>
                    </div><?php else: ?><div class="empty">No pending blood requests.</div><?php endif; ?>
            </section>
        </main>
    </div>
</body>

</html>