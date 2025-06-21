<?php
require_once 'app/database.php';
require_once 'app/models/User.php';

class Login {
		public function showLoginForm() {
				include 'app/views/login/index.php';
		}

		public function login() {
				session_start();
				$pdo = getDB();
				$userModel = new User($pdo);

				$username = $_POST['username'] ?? '';
				$password = $_POST['password'] ?? '';
				$user = $userModel->findByUsername($username);

				// Check for lockout
				$attempts = $userModel->getRecentFailedAttempts($username);
				if (count($attempts) === 3) {
						$lastAttempt = strtotime($attempts[0]['attempt_time']);
						if (time() - $lastAttempt < 60) {
								header("Location: index.php?action=login&error=" . urlencode("Account locked. Try again in 60 seconds."));
								exit();
						}
				}

				if ($user && password_verify($password, $user['Password'])) {
						$_SESSION['authenticated'] = true;
						$_SESSION['username'] = $username;
						$userModel->logAttempt($username, 'success');
						header("Location: index.php?action=home");
				} else {
						$userModel->logAttempt($username, 'fail');
						header("Location: index.php?action=login&error=" . urlencode("Invalid credentials"));
				}
		}

		public function logout() {
				session_start();
				session_destroy();
				header("Location: index.php?action=login");
		}
}
