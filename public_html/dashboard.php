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
    <title>Dashboard - EventVerse</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <header>
        <?php include 'templates/header.php'; ?>
    </header>
    <main>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is your dashboard. From here, you can manage your events and profile!</p>
        <!-- Add more dashboard features as needed -->
    </main>
    <footer>
        <?php include 'templates/footer.php'; ?>
    </footer>
</body>
</html>
