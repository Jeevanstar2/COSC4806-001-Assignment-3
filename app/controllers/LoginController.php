<?php
require_once __DIR__ . '/../models/User.php';

class LoginController {

    public function showLoginForm() {
        include 'views/login.php';
    }

    public function login() {
        session_start();

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $user = User::find($username);

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['login_attempts'] = 0;
            User::logAttempt($username, 'success');
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            User::logAttempt($username, 'fail');

            $failCount = User::getFailedAttempts($username);
            $lastFail = User::getLastFailedTime($username);

            if ($failCount >= 3 && (time() - strtotime($lastFail)) < 60) {
                $error = "Too many failed attempts. Please wait 60 seconds.";
            } else {
                $error = "Login failed. Attempts: " . $_SESSION['login_attempts'];
            }

            header("Location: index.php?action=login&error=" . urlencode($error));
            exit;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }

    public function showRegisterForm() {
        include 'views/register.php';
    }

    public function register() {
        session_start();

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm = trim($_POST['confirm_password']);

        if (empty($username) || empty($password) || empty($confirm)) {
            $error = "All fields are required.";
        } elseif (strlen($password) < 8) {
            $error = "Password must be at least 8 characters.";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $error = "Password must contain at least one uppercase letter.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $error = "Password must contain at least one number.";
        } elseif ($password !== $confirm) {
            $error = "Passwords do not match.";
        } elseif (User::find($username)) {
            $error = "Username already exists.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            if (User::create($username, $hashed)) {
                header("Location: index.php?action=login&success=" . urlencode("Account created! Please log in."));
                exit;
            } else {
                $error = "Error creating account.";
            }
        }

        header("Location: index.php?action=register&error=" . urlencode($error));
        exit;
    }
}
