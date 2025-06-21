<?php

class HomeController {
    public function index() {
        session_start();

        if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
            header("Location: index.php?action=login");
            exit;
        }

        include __DIR__ . '/../../views/home.php';
    }
}
