<?php
require_once 'app/database.php';
require_once 'app/models/User.php';

class Register {
    public function showRegisterForm() {
        include 'app/views/register/index.php';
    }

    public function register() {
        $pdo = getDB();
        $userModel = new User($pdo);

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm = trim($_POST['confirm_password'] ?? '');

        if ($password !== $confirm) {
            header("Location: index.php?action=register&error=" . urlencode("Passwords do not match."));
            return;
        }

        if ($userModel->findByUsername($username)) {
            header("Location: index.php?action=register&error=" . urlencode("Username already exists."));
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userModel->create($username, $hashedPassword);
        header("Location: index.php?action=login&success=" . urlencode("Account created. Please login."));
    }
}
