<?php
class User {
    public static function findByUsername($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM COSC4806001_Assignment2_Users WHERE Username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($username, $password) {
        global $pdo;
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO COSC4806001_Assignment2_Users (Username, Password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashed]);
    }

    public static function logAttempt($username, $status) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO login_log (username, status) VALUES (?, ?)");
        $stmt->execute([$username, $status]);
    }

    public static function failedAttempts($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT timestamp FROM login_log WHERE username = ? AND status = 'bad' ORDER BY timestamp DESC LIMIT 3");
        $stmt->execute([$username]);
        return $stmt->fetchAll();
    }
}
?>
