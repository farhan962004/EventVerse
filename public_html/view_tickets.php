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
    <title>View My Tickets - EventVerse</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <header>
        <?php include 'templates/header.php'; ?>
    </header>
    <main>
        <h2>View My Tickets</h2>
        <p>Here you can view your tickets.</p>
    </main>
    <footer>
        <?php include 'templates/footer.php'; ?>
    </footer>
</body>
</html>
