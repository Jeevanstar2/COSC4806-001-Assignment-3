<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login Page</h2>
<form action="index.php?action=doLogin" method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <?php if (!empty($_GET['error'])) echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>"; ?>
    <input type="submit" value="Login">
</form>
<p>Don't have an account? <a href="index.php?action=register">Create a new account</a></p>
</body>
</html>