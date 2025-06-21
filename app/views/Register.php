<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Create a New Account</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="index.php?action=register" method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Confirm Password: <input type="password" name="confirm_password" required><br><br>
        <button type="submit">Register</button>
    </form>

    <p><a href="index.php?action=login">Back to Login</a></p>
</body>
</html>
