<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account - EventVerse</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <header>
        <?php include 'templates/header.php'; ?>
    </header>
    <main>
        <h2>Manage Account</h2>
        <p>Welcome, <?php echo $_SESSION['username']; ?>! This is your account management page.</p>
    </main>
    <footer>
        <?php include 'templates/footer.php'; ?>
    </footer>
</body>
</html>
