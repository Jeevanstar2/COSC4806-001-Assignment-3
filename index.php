<?php
require_once 'app/core/config.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        require 'app/controllers/LoginController.php';
        (new LoginController())->showLogin();
        break;

    case 'doLogin':
        require 'app/controllers/LoginController.php';
        (new LoginController())->login();
        break;

    case 'logout':
        require 'app/controllers/LoginController.php';
        (new LoginController())->logout();
        break;

    case 'register':
        require 'app/controllers/RegisterController.php';
        (new RegisterController())->showForm();
        break;

    case 'store':
        require 'app/controllers/RegisterController.php';
        (new RegisterController())->create();
        break;

    case 'home':
        require 'app/controllers/LoginController.php';
        (new LoginController())->home();
        break;

    default:
        echo "404 Not Found";
}
?>
