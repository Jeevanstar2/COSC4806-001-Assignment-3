<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login Page</h2>
    <form action="index.php?action=doLogin" method="POST">
        Username: <input type="text" name="username" required>
        Password: <input type="password" name="password" required>
        <?php if (!empty($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="index.php?action=register">Create a new account</a></p>
</body>
</html>
