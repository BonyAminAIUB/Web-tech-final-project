<?php $error = $_SESSION['error'] ?? '';
unset($_SESSION['error']); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Request Blood</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="app">
        <header>
            <div class="brand">🩸 BloodConnectBD</div>
            <nav><a href="?page=user-dashboard">Dashboard</a><a href="?page=my-requests">My Requests</a><a href="?page=find-donor">Find Donor</a><a href="?page=profile">Profile</a><a href="?page=logout">Logout</a></nav>
        </header>
        <main>
            <div class="page-title">
                <h1>Request Blood</h1>
                <p>Submit a blood request for a patient.</p>
            </div><?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?><form class="panel" method="POST">
                <div class="form-grid">
                    <div><label>Patient Name *</label><input name="patient_name" required></div>
                    <div><label>Blood Group *</label><select name="blood_group" required>
                            <option value="">Select</option><?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $b): ?><option><?= $b ?></option><?php endforeach; ?>
                        </select></div>
                    <div><label>Location *</label><input name="location" required></div>
                    <div><label>Contact Phone *</label><input name="contact_phone" required></div>
                    <div><label>Required Date *</label><input type="date" name="required_date" required></div>
                    <div><label>Hospital Name</label><input name="hospital_name"></div>
                    <div><label>Urgency</label><select name="urgency">
                            <option>Normal</option>
                            <option>Emergency</option>
                        </select></div>
                    <div class="full"><label>Description</label><textarea name="description" rows="4"></textarea></div>
                </div><button class="btn-primary">Submit Blood Request</button>
            </form>
        </main>
    </div>
</body>

</html>