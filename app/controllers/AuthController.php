<?php

class AuthController
{
    private User $userModel;
    private $roles = ['user', 'donor', 'admin'];

    public function __construct()
    {
        $this->userModel = new User();
    }

    private function redirectForRole($role)
    {
        if ($role === 'admin') $page = 'admin-dashboard';
        elseif ($role === 'donor') $page = 'donor-dashboard';
        else $page = 'user-dashboard';
        header('Location: ?page=' . $page);
        exit;
    }

    public function login(string $role = '')
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirectForRole($_SESSION['user_role']);
        }
        require BASE_PATH . '/app/views/auth/login.php';
    }

    public function loginUser(string $expectedRole = '')
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $_SESSION['error'] = 'Email and password are required.';
            header('Location: ?page=' . ($expectedRole ? 'login-' . $expectedRole : 'login'));
            exit;
        }

        $user = $this->userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid email or password.';
            header('Location: ?page=' . ($expectedRole ? 'login-' . $expectedRole : 'login'));
            exit;
        }

        if ($expectedRole !== '' && $user['role'] !== $expectedRole) {
            $_SESSION['error'] = 'This account is not registered as a ' . ucfirst($expectedRole) . ' account.';
            header('Location: ?page=login-' . $expectedRole);
            exit;
        }

        if (($user['status'] ?? 'active') !== 'active') {
            $_SESSION['error'] = 'Your account is inactive. Please contact an administrator.';
            header('Location: ?page=' . ($expectedRole ? 'login-' . $expectedRole : 'login'));
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $this->redirectForRole($user['role']);
    }

    public function register(string $role = 'user')
    {
        if (isset($_SESSION['user_id'])) $this->redirectForRole($_SESSION['user_role']);
        require BASE_PATH . '/app/views/auth/register.php';
    }

    public function registerUser(string $role = 'user')
    {
        $allowed = ['user', 'donor', 'admin'];
        if (!in_array($role, $allowed, true)) $role = 'user';

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $bloodGroup = trim($_POST['blood_group'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        $back = '?page=register-' . $role;
        if ($name === '' || $email === '' || $phone === '' || $password === '') {
            $_SESSION['error'] = 'Please fill in all required fields.';
            header('Location: ' . $back);
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Please enter a valid email address.';
            header('Location: ' . $back);
            exit;
        }
        if ($role === 'donor' && $bloodGroup === '') {
            $_SESSION['error'] = 'Blood group is required for donor registration.';
            header('Location: ' . $back);
            exit;
        }
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters.';
            header('Location: ' . $back);
            exit;
        }
        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: ' . $back);
            exit;
        }
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'An account with this email already exists.';
            header('Location: ' . $back);
            exit;
        }

        $ok = $this->userModel->create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'blood_group' => $bloodGroup,
            'location' => $location,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'availability' => $role === 'donor' ? 'Available' : 'Not Available',
            'role' => $role,
            'status' => 'active'
        ]);

        $_SESSION[$ok ? 'success' : 'error'] = $ok ? 'Registration successful. Please login.' : 'Registration failed. Please try again.';
        header('Location: ?page=login-' . $role);
        exit;
    }

    public function resetPassword(string $role = 'user')
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require BASE_PATH . '/app/views/auth/reset-password.php';
            return;
        }
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $back = '?page=reset-password-' . $role;
        if ($email === '' || $phone === '' || $new === '' || $confirm === '') {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: ' . $back);
            exit;
        }
        if (strlen($new) < 6) {
            $_SESSION['error'] = 'New password must be at least 6 characters.';
            header('Location: ' . $back);
            exit;
        }
        if ($new !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: ' . $back);
            exit;
        }
        if (!$this->userModel->resetPasswordByIdentity($email, $phone, $role, password_hash($new, PASSWORD_DEFAULT))) {
            $_SESSION['error'] = 'No matching ' . $role . ' account was found for the provided email and phone.';
            header('Location: ' . $back);
            exit;
        }
        $_SESSION['success'] = 'Password reset successful. Please login.';
        header('Location: ?page=login-' . $role);
        exit;
    }

    public function changePassword()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require BASE_PATH . '/app/views/auth/change-password.php';
            return;
        }
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        if ($current === '' || $new === '' || $confirm === '') {
            $_SESSION['error'] = 'All password fields are required.';
            header('Location:?page=change-password');
            exit;
        }
        if (strlen($new) < 6) {
            $_SESSION['error'] = 'New password must be at least 6 characters.';
            header('Location:?page=change-password');
            exit;
        }
        if ($new !== $confirm) {
            $_SESSION['error'] = 'New passwords do not match.';
            header('Location:?page=change-password');
            exit;
        }
        $user = $this->userModel->findById($_SESSION['user_id']);
        if (!$user || !password_verify($current, $user['password'])) {
            $_SESSION['error'] = 'Current password is incorrect.';
            header('Location:?page=change-password');
            exit;
        }
        $this->userModel->updatePassword($_SESSION['user_id'], password_hash($new, PASSWORD_DEFAULT));
        $_SESSION['success'] = 'Password changed successfully.';
        $this->redirectForRole($_SESSION['user_role']);
    }

    public function logout()
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $params['path'], 'domain' => $params['domain'], 'secure' => $params['secure'], 'httponly' => $params['httponly'], 'samesite' => $params['samesite'] ?? 'Lax']);
        }
        session_destroy();
        header('Location:?page=login');
        exit;
    }

    private function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login first.';
            header('Location:?page=login');
            exit;
        }
    }
}
