<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>

    <img src="https://www.icegif.com/wp-content/uploads/2023/01/icegif-162.gif" alt="Rickroll" style="width: 100%; max-width: 600px;">

    <p><a href="index.php?action=logout">Logout</a></p>
</body>
</html>
