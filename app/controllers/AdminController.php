<?php

class AdminController
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
    public function dashboard()
    {
        $this->requireAdmin();
        $totalUsers = $this->userModel->countByRole('user');
        $totalDonors = $this->userModel->countByRole('donor');
        $totalRequests = $this->bloodRequestModel->countRequests();
        $pendingRequests = $this->bloodRequestModel->countByStatus('Pending');
        require BASE_PATH . '/app/views/admin/dashboard.php';
    }
    public function users()
    {
        $this->requireAdmin();
        $users = $this->userModel->getAllByRole('user');
        require BASE_PATH . '/app/views/admin/users.php';
    }
    public function donors()
    {
        $this->requireAdmin();
        $donors = $this->userModel->getAllByRole('donor');
        require BASE_PATH . '/app/views/admin/donors.php';
    }
    public function requests()
    {
        $this->requireAdmin();
        $requests = $this->bloodRequestModel->getAll();
        require BASE_PATH . '/app/views/admin/requests.php';
    }
    public function donations()
    {
        $this->requireAdmin();
        $donations = $this->donationModel->getAll();
        require BASE_PATH . '/app/views/admin/donations.php';
    }
    public function updateRequestStatus()
    {
        $this->requireAdmin();
        $id = (int)($_POST['request_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        $allowed = ['Pending', 'Approved', 'Rejected', 'Completed'];
        if ($id <= 0 || !in_array($status, $allowed, true)) {
            $_SESSION['error'] = 'Invalid request or status.';
        } else {
            $this->bloodRequestModel->updateStatus($id, $status);
            $_SESSION['success'] = 'Request status updated successfully.';
        }
        header('Location:?page=admin-requests');
        exit;
    }
    public function updateUserStatus()
    {
        $this->requireAdmin();
        $id = (int)($_POST['user_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if (!in_array($status, ['active', 'inactive'], true) || $id <= 0) {
            $_SESSION['error'] = 'Invalid user or status.';
        } else {
            $this->userModel->updateStatus($id, $status);
            $_SESSION['success'] = 'Account status updated.';
        }
        header('Location:?page=admin-users');
        exit;
    }
    public function updateDonorStatus()
    {
        $this->requireAdmin();
        $id = (int)($_POST['user_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if (!in_array($status, ['active', 'inactive'], true) || $id <= 0) {
            $_SESSION['error'] = 'Invalid donor or status.';
        } else {
            $this->userModel->updateStatus($id, $status);
            $_SESSION['success'] = 'Donor account status updated.';
        }
        header('Location:?page=admin-donors');
        exit;
    }
    public function deleteUser()
    {
        $this->requireAdmin();
        $id = (int)($_POST['user_id'] ?? 0);
        $this->userModel->delete($id);
        $_SESSION['success'] = 'Account deleted successfully.';
        header('Location:?page=admin-users');
        exit;
    }
    public function deleteDonor()
    {
        $this->requireAdmin();
        $id = (int)($_POST['user_id'] ?? 0);
        $this->userModel->delete($id);
        $_SESSION['success'] = 'Donor account deleted successfully.';
        header('Location:?page=admin-donors');
        exit;
    }
    private function requireAdmin()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login first.';
            header('Location:?page=login-admin');
            exit;
        }
        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            $_SESSION['error'] = 'Admin access required.';
            $target = ($_SESSION['user_role'] === 'donor' ? 'donor-dashboard' : 'user-dashboard');
            header('Location:?page=' . $target);
            exit;
        }
    }
}
