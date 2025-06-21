public function showRegisterForm() {
    include __DIR__ . '/../views/register.php';
}

public function register() {
    require_once __DIR__ . '/../models/User.php';
    session_start();

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if (empty($username) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $error = "Password must contain at least one uppercase letter.";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $error = "Password must contain at least one number.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (User::find($username)) {
        $error = "Username already exists.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        if (User::create($username, $hashed)) {
            header("Location: index.php?action=login&success=" . urlencode("Account created! Please log in."));
            exit;
        } else {
            $error = "Error creating account.";
        }
    }

    header("Location: index.php?action=register&error=" . urlencode($error));
    exit;
}
