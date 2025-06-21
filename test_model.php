<?php
require_once 'app/models/User.php';

$user = User::find('Jeevan'); // replace with an actual test username

if ($user) {
    echo "User found: " . htmlspecialchars($user['Username']);
} else {
    echo "User not found.";
}
