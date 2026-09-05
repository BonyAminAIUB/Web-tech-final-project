<?php $success = $_SESSION['success'] ?? '';
unset($_SESSION['success']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=user-dashboard">Dashboard</a><a href="?page=create-request">Request Blood</a><a href="?page=my-requests">My Requests</a><a href="?page=find-donor">Find Donor</a><a href="?page=profile">My Profile</a><a href="?page=change-password">Password</a><a class="danger-link" href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="hero">
                <div><span class="pill">USER / BLOOD SEEKER</span>
                    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?> 👋</h1>
                    <p>Create blood requests and find available donors.</p>
                </div><a class="btn-primary" href="?page=create-request">+ Request Blood</a>
            </div><?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?><div class="stats">
                <div><span>My Requests</span><b><?= count($requests) ?></b></div>
                <div><span>Pending Requests</span><b><?= $pending ?></b></div>
                <div><span>Account</span><b>Active</b></div>
            </div>
            <section class="cards"><a href="?page=create-request" class="feature">
                    <h3>🩸 Request Blood</h3>
                    <p>Create a new blood request for a patient.</p>
                </a><a href="?page=find-donor" class="feature">
                    <h3>🔎 Find Donor</h3>
                    <p>Search available donors by blood group and location.</p>
                </a><a href="?page=my-requests" class="feature">
                    <h3>📋 My Requests</h3>
                    <p>Track your submitted blood requests.</p>
                </a><a href="?page=profile" class="feature">
                    <h3>👤 My Profile</h3>
                    <p>View and update your account information.</p>
                </a></section>
        </main>
    </div>
</body>

</html>