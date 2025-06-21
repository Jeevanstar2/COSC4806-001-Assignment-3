<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM COSC4806001_Assignment3 WHERE Username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $hashedPassword) {
        $stmt = $this->pdo->prepare("INSERT INTO COSC4806001_Assignment3 (Username, Password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }

    public function logAttempt($username, $status) {
        $stmt = $this->pdo->prepare("INSERT INTO login_log (username, status, attempt_time) VALUES (?, ?, NOW())");
        return $stmt->execute([$username, $status]);
    }

    public function getRecentFailedAttempts($username) {
        $stmt = $this->pdo->prepare("
            SELECT attempt_time FROM login_log 
            WHERE username = ? AND status = 'fail' 
            ORDER BY attempt_time DESC 
            LIMIT 3
        ");
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
