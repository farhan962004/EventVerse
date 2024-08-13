<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : "";
$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventVerse - <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/EventVersee/public_html/css/home.css">
    <link rel="stylesheet" href="/EventVersee/public_html/css/header.css">
    <?php if ($pageTitle == "Login" || $pageTitle == "Sign Up" || $pageTitle == "User Profile" || $pageTitle == "Event Details") : ?>
        <link rel="stylesheet" href="/EventVersee/public_html/css/login.css">
    <?php endif; ?>
    <?php if ($pageTitle == "Find Events" || $pageTitle == "Event Details") : ?>
        <link rel="stylesheet" href="/EventVersee/public_html/css/events.css">
    <?php endif; ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <a href="/EventVersee/public_html/index.php">EventVerse</a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Find an event...">
            <button>Search</button>
        </div>
        <nav>
            <a href="/EventVersee/public_html/index.php">Home</a>
            <a href="/EventVersee/public_html/events/find_events.php">Find Events</a>
            <a href="/EventVersee/public_html/events/host_event_intro.php">Host an Event</a>
            <?php if ($email): ?>
                <a href="/EventVersee/public_html/user/my_bookings.php">My Bookings</a>
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
                        <a href="/EventVersee/public_html/user/profile.php">Manage Account</a>
                        <a href="/EventVersee/public_html/user/manage_events.php">Manage My Events</a>
                        <a href="/EventVersee/public_html/user/my_bookings.php">View My Tickets</a>
                        <?php if ($is_admin): ?>
                            <a href="/EventVersee/public_html/admin/admin_dashboard.php">Admin Management</a>
                        <?php endif; ?>
                        <a href="/EventVersee/public_html/user/logout.php">Log Out</a>
                    </div>
                    <div class="welcome-text">
                        Welcome, <?php echo htmlspecialchars($first_name); ?>
                    </div>
                </div>
            <?php else: ?>
                <a href="/EventVersee/public_html/login/login.php">Login</a>
                <a href="/EventVersee/public_html/login/signup.php">Sign Up</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<script src="/EventVersee/public_html/js/header.js"></script>
</body>
</html>
