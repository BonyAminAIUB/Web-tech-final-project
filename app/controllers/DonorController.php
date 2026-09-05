<?php

class DonorController
{
    private User $userModel;
    private BloodRequest $bloodRequestModel;
    private Donation $donationModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->bloodRequestModel = new BloodRequest();
        $this->donationModel = new Donation();
    }

    public function userDashboard()
    {
        $this->requireRole('user');
        $requests = $this->bloodRequestModel->getByUserId($_SESSION['user_id']);
        $pending = $this->bloodRequestModel->countByStatus('Pending');
        require BASE_PATH . '/app/views/user/dashboard.php';
    }
    public function donorDashboard()
    {
        $this->requireRole('donor');
        $donations = $this->donationModel->getByUserId($_SESSION['user_id']);
        $pendingRequests = $this->bloodRequestModel->getPending();
        require BASE_PATH . '/app/views/donor/dashboard.php';
    }

    public function profile()
    {
        $this->requireLogin();
        $user = $this->userModel->findById($_SESSION['user_id']);
        require BASE_PATH . '/app/views/home/profile.php';
    }
    public function editProfile()
    {
        $this->requireLogin();
        $user = $this->userModel->findById($_SESSION['user_id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $blood = trim($_POST['blood_group'] ?? '');
            $loc = trim($_POST['location'] ?? '');
            if ($name === '' || $phone === '') {
                $_SESSION['error'] = 'Name and phone are required.';
                header('Location:?page=edit-profile');
                exit;
            }
            $this->userModel->updateProfile($_SESSION['user_id'], ['name' => $name, 'phone' => $phone, 'blood_group' => $blood, 'location' => $loc]);
            $_SESSION['user_name'] = $name;
            $_SESSION['success'] = 'Profile updated successfully.';
            header('Location:?page=profile');
            exit;
        }
        require BASE_PATH . '/app/views/home/edit-profile.php';
    }
    public function updateAvailability()
    {
        $this->requireRole('donor');
        $availability = $_POST['availability'] ?? '';
        if (!in_array($availability, ['Available', 'Not Available'], true)) {
            $_SESSION['error'] = 'Invalid availability.';
        } else {
            $this->userModel->updateAvailability($_SESSION['user_id'], $availability);
            $_SESSION['success'] = 'Availability updated.';
        }
        header('Location:?page=profile');
        exit;
    }

    public function findDonor()
    {
        $this->requireLogin();
        $donors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blood = trim($_POST['blood_group'] ?? '');
            $loc = trim($_POST['location'] ?? '');
            if ($blood === '') {
                $_SESSION['error'] = 'Please select a blood group.';
                header('Location:?page=find-donor');
                exit;
            }
            $donors = $this->userModel->searchDonors($blood, $loc);
        }
        require BASE_PATH . '/app/views/home/find-donor.php';
    }

    public function createRequest()
    {
        $this->requireRole('user');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['user_id' => $_SESSION['user_id'], 'patient_name' => trim($_POST['patient_name'] ?? ''), 'blood_group' => trim($_POST['blood_group'] ?? ''), 'location' => trim($_POST['location'] ?? ''), 'contact_phone' => trim($_POST['contact_phone'] ?? ''), 'required_date' => $_POST['required_date'] ?? '', 'hospital_name' => trim($_POST['hospital_name'] ?? ''), 'urgency' => $_POST['urgency'] ?? 'Normal', 'description' => trim($_POST['description'] ?? '')];
            if ($data['patient_name'] === '' || $data['blood_group'] === '' || $data['location'] === '' || $data['contact_phone'] === '' || $data['required_date'] === '') {
                $_SESSION['error'] = 'Please fill in all required fields.';
                header('Location:?page=create-request');
                exit;
            }
            if (!in_array($data['urgency'], ['Normal', 'Emergency'], true)) $data['urgency'] = 'Normal';
            $this->bloodRequestModel->create($data);
            $_SESSION['success'] = 'Blood request created successfully.';
            header('Location:?page=my-requests');
            exit;
        }
        require BASE_PATH . '/app/views/home/create-request.php';
    }
    public function myRequests()
    {
        $this->requireRole('user');
        $requests = $this->bloodRequestModel->getByUserId($_SESSION['user_id']);
        require BASE_PATH . '/app/views/home/my-requests.php';
    }
    public function deleteRequest()
    {
        $this->requireRole('user');
        $id = (int)($_POST['request_id'] ?? 0);
        if ($id > 0 && $this->bloodRequestModel->delete($id, $_SESSION['user_id'])) $_SESSION['success'] = 'Blood request deleted successfully.';
        else $_SESSION['error'] = 'Unable to delete request.';
        header('Location:?page=my-requests');
        exit;
    }
    public function donationHistory()
    {
        $this->requireRole('donor');
        $donations = $this->donationModel->getByUserId($_SESSION['user_id']);
        require BASE_PATH . '/app/views/home/donation-history.php';
    }

    private function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login first.';
            header('Location:?page=login');
            exit;
        }
    }
    private function requireRole($role)
    {
        $this->requireLogin();
        if (($_SESSION['user_role'] ?? '') !== $role) {
            $_SESSION['error'] = 'Access denied for this account type.';
            $target = ($_SESSION['user_role'] === 'admin' ? 'admin-dashboard' : ($_SESSION['user_role'] === 'donor' ? 'donor-dashboard' : 'user-dashboard'));
            header('Location:?page=' . $target);
            exit;
        }
    }
}
