<?php
require_once __DIR__ . '/../core/config.php';

class User {
    public static function find($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM COSC4806001_Assignment2_Users WHERE Username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($username, $hashedPassword) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO COSC4806001_Assignment2_Users (Username, Password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }

    public static function logAttempt($username, $status) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO log (username, status) VALUES (?, ?)");
        $stmt->execute([$username, $status]);
    }

    public static function getFailedAttempts($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM log WHERE username = ? AND status = 'fail' AND time >= NOW() - INTERVAL 5 MINUTE");
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }

    public static function getLastFailedTime($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT time FROM log WHERE username = ? AND status = 'fail' ORDER BY time DESC LIMIT 1");
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }
}
