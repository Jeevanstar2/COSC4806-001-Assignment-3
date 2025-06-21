<?php
require_once 'app/init.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        require_once 'app/controllers/Login.php';
        $controller = new Login();
        $controller->showLoginForm();
        break;

    case 'loginUser':
        require_once 'app/controllers/Login.php';
        $controller = new Login();
        $controller->login();
        break;

    case 'register':
        require_once 'app/controllers/Register.php';
        $controller = new Register();
        $controller->showRegisterForm();
        break;

    case 'registerUser':
        require_once 'app/controllers/Register.php';
        $controller = new Register();
        $controller->register();
        break;

    case 'home':
        require_once 'app/controllers/Home.php';
        $controller = new Home();
        $controller->index();
        break;

    case 'logout':
        require_once 'app/controllers/Login.php';
        $controller = new Login();
        $controller->logout();
        break;

    default:
        header("Location: index.php?action=login");
        break;
}
