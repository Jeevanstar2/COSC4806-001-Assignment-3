<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Create a New Account</h2>
    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    <form action="index.php?action=store" method="POST">
        Username: <input type="text" name="username" required>
        Password: <input type="password" name="password" required>
        Confirm Password: <input type="password" name="confirm_password" required>
        <input type="submit" value="Register">
    </form>
    <p><a href="index.php?action=login">Back to login</a></p>
</body>
</html>
