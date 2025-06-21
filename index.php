<?php
require_once 'app/controllers/LoginController.php';
require_once 'app/controllers/HomeController.php';

$action = $_GET['action'] ?? null;

$loginController = new LoginController();
$homeController = new HomeController();

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->login();
        } else {
            $loginController->showLoginForm();
        }
        break;

    case 'logout':
        $loginController->logout();
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->register();
        } else {
            $loginController->showRegisterForm();
        }
        break;

    case 'home':
    default:
        $homeController->index();
        break;
}
