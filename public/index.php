<?php
session_start();
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/models/BloodRequest.php';
require_once BASE_PATH . '/app/models/Donation.php';
require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/DonorController.php';
require_once BASE_PATH . '/app/controllers/AdminController.php';
$auth = new AuthController();
$donor = new DonorController();
$admin = new AdminController();
$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        $auth->login();
        break;
    case 'login-user':
        $auth->login('user');
        break;
    case 'login-donor':
        $auth->login('donor');
        break;
    case 'login-admin':
        $auth->login('admin');
        break;
    case 'login-user-submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $auth->loginUser('user');
        else header('Location:?page=login-user');
        break;
    case 'login-donor-submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $auth->loginUser('donor');
        else header('Location:?page=login-donor');
        break;
    case 'login-admin-submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $auth->loginUser('admin');
        else header('Location:?page=login-admin');
        break;
    case 'register':
        $auth->register('user');
        break;
    case 'register-user':
        $auth->register('user');
        break;
    case 'register-donor':
        $auth->register('donor');
        break;
    case 'register-admin':
        $auth->register('admin');
        break;
    case 'register-user-submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $auth->registerUser('user');
        else header('Location:?page=register-user');
        break;
    case 'register-donor-submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $auth->registerUser('donor');
        else header('Location:?page=register-donor');
        break;
    case 'register-admin-submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $auth->registerUser('admin');
        else header('Location:?page=register-admin');
        break;
    case 'reset-password-user':
        $auth->resetPassword('user');
        break;
    case 'reset-password-donor':
        $auth->resetPassword('donor');
        break;
    case 'reset-password-admin':
        $auth->resetPassword('admin');
        break;
    case 'change-password':
        $auth->changePassword();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'dashboard':
        if (($_SESSION['user_role'] ?? '') === 'admin') header('Location:?page=admin-dashboard');
        elseif (($_SESSION['user_role'] ?? '') === 'donor') header('Location:?page=donor-dashboard');
        else header('Location:?page=user-dashboard');
        exit;
    case 'user-dashboard':
        $donor->userDashboard();
        break;
    case 'donor-dashboard':
        $donor->donorDashboard();
        break;
    case 'profile':
        $donor->profile();
        break;
    case 'edit-profile':
        $donor->editProfile();
        break;
    case 'update-availability':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $donor->updateAvailability();
        else header('Location:?page=profile');
        break;
    case 'find-donor':
        $donor->findDonor();
        break;
    case 'create-request':
        $donor->createRequest();
        break;
    case 'my-requests':
        $donor->myRequests();
        break;
    case 'delete-request':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $donor->deleteRequest();
        else header('Location:?page=my-requests');
        break;
    case 'donation-history':
        $donor->donationHistory();
        break;
    case 'admin-dashboard':
        $admin->dashboard();
        break;
    case 'admin-users':
        $admin->users();
        break;
    case 'admin-donors':
        $admin->donors();
        break;
    case 'admin-requests':
        $admin->requests();
        break;
    case 'admin-donations':
        $admin->donations();
        break;
    case 'update-request-status':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $admin->updateRequestStatus();
        else header('Location:?page=admin-requests');
        break;
    case 'update-user-status':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $admin->updateUserStatus();
        else header('Location:?page=admin-users');
        break;
    case 'update-donor-status':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $admin->updateDonorStatus();
        else header('Location:?page=admin-donors');
        break;
    case 'delete-user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $admin->deleteUser();
        else header('Location:?page=admin-users');
        break;
    case 'delete-donor':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $admin->deleteDonor();
        else header('Location:?page=admin-donors');
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
