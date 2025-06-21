<?php
session_start();
require_once 'app/core/config.php';
require_once 'app/models/User.php';

class LoginController {
    public function showLogin() {
        include 'app/views/login/index.php';
    }

    public function login() {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $user = User::findByUsername($username);

        // Check lockout
        $failures = User::failedAttempts($username);
        if (count($failures) == 3) {
            $first = strtotime($failures[2]['timestamp']);
            if (time() - $first < 60) {
                header("Location: index.php?action=login&error=" . urlencode("Account locked. Try in 60s"));
                return;
            }
        }

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            User::logAttempt($username, 'good');
            header("Location: index.php?action=home");
        } else {
            User::logAttempt($username, 'bad');
            header("Location: index.php?action=login&error=" . urlencode("Invalid login"));
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
    }

    public function home() {
        if (!isset($_SESSION['authenticated'])) {
            header("Location: index.php?action=login");
            exit;
        }
        include 'app/views/home/index.php';
    }
}
?>
