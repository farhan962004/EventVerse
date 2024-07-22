<?php
session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : "";
$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <title>EventVerse</title>
</head>
<body>
<div class="logo">
    <h1>EventVerse</h1>
</div>
<div class="search-bar">
    <input type="text" placeholder="Find an event...">
</div>
<nav>
    <a href="index.php">Home</a>
    <?php if ($email): ?>
        <div class="user-menu">
            <span>
                <?php
                if (!empty($first_name) && !empty($last_name)) {
                    echo strtoupper($first_name[0] . $last_name[0]);
                } else {
                    echo "NN"; // Default initials if first_name or last_name is empty
                }
                ?>
            </span>
            <div class="dropdown">
                <a href="manage_account.php">Manage Account</a>
                <a href="manage_events.php">Manage My Events</a>
                <a href="view_tickets.php">View My Tickets</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
        <a href="find_events.php">Find Events</a>
        <a href="host_event.php">Host an Event</a>
        <a href="tickets.php">Tickets</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>
</nav>
</body>
</html>
