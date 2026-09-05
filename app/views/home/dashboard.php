<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$success = $_SESSION["success"] ?? "";
$error = $_SESSION["error"] ?? "";

unset($_SESSION["success"]);
unset($_SESSION["error"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Dashboard - BloodConnectBD</title>

    <link rel="stylesheet"
        href="/Web_Tech_Practice/BloodConnectBD/public/css/style.css">

</head>

<body>

    <nav class="navbar">

        <div class="nav-container">

            <a class="brand"
                href="?page=dashboard">
                🩸 BloodConnectBD
            </a>

            <div class="nav-links">

                <a href="?page=dashboard">Dashboard</a>

                <a href="?page=profile">My Profile</a>

                <a href="?page=find-donor">Find Donor</a>

                <a href="?page=create-request">Blood Request</a>

                <a href="?page=change-password">
                    Change Password
                </a>

                <a href="?page=logout"
                    class="logout-link">
                    Logout
                </a>

            </div>

        </div>

    </nav>


    <main class="dashboard-container">

        <?php if ($success): ?>

            <div class="alert success">
                <?php echo htmlspecialchars($success); ?>
            </div>

        <?php endif; ?>


        <?php if ($error): ?>

            <div class="alert error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>


        <div class="welcome-section">

            <h1>
                Welcome,
                <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!
            </h1>

            <p>
                Welcome to your BloodConnectBD dashboard.
            </p>

        </div>


        <div class="dashboard-grid">

            <div class="dashboard-card">

                <div class="card-icon">
                    🔎
                </div>

                <h3>Find Blood Donor</h3>

                <p>
                    Search for available donors by blood group.
                </p>

                <a href="?page=find-donor"
                    class="btn-primary">
                    Find Donor
                </a>

            </div>


            <div class="dashboard-card">

                <div class="card-icon">
                    🩸
                </div>

                <h3>Request Blood</h3>

                <p>
                    Create a blood request when you need blood.
                </p>

                <a href="?page=create-request"
                    class="btn-primary">
                    Request Blood
                </a>

            </div>


            <div class="dashboard-card">

                <div class="card-icon">
                    👤
                </div>

                <h3>My Profile</h3>

                <p>
                    View and update your donor information.
                </p>

                <a href="?page=profile"
                    class="btn-primary">
                    View Profile
                </a>

            </div>


            <div class="dashboard-card">

                <div class="card-icon">
                    📋
                </div>

                <h3>My Requests</h3>

                <p>
                    View your previous blood requests.
                </p>

                <a href="?page=my-requests"
                    class="btn-primary">
                    View Requests
                </a>

            </div>


            <div class="dashboard-card">

                <div class="card-icon">
                    ❤️
                </div>

                <h3>Donation History</h3>

                <p>
                    View your blood donation history.
                </p>

                <a href="?page=donation-history"
                    class="btn-primary">
                    View History
                </a>

            </div>

        </div>

    </main>

</body>

</html>