<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2>Create a New Account</h2>
<?php if (!empty($error_message)) echo "<p style='color:red'>" . htmlspecialchars($error_message) . "</p>"; ?>
<form action="index.php?action=store" method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Confirm Password: <input type="password" name="confirm_password" required><br><br>
    <input type="submit" value="Register">
</form>
<p><a href="index.php?action=login">Back to login</a></p>
</body>
</html>