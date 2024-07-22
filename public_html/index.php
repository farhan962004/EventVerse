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
<header>
    <div class="logo">
        <h1>EventVerse</h1>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Find an event...">
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="find_events.php">Find Events</a>
        <a href="host_event.php">Host an Event</a>
        <?php if ($email): ?>
            <a href="tickets.php">My Tickets</a>
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
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section class="hero">
        <h1>Your community, your events, your way</h1>
        <button>Find an Event Now -></button>
    </section>
    
    <section class="intro">
        <h2>NO Plans Yet? Don't Worry We Got You!</h2>
    </section>

    <section class="categories">
        <div>
            <img src="images/music.png" alt="Music">
            <p>Music</p>
        </div>
        <div>
            <img src="images/food.png" alt="Food & Drinks">
            <p>Food & Drinks</p>
        </div>
        <div>
            <img src="images/nightlife.png" alt="Nightlife and Parties">
            <p>Nightlife and Parties</p>
        </div>
        <div>
            <img src="images/learning.png" alt="Learning">
            <p>Learning</p>
        </div>
        <div>
            <img src="images/gaming.png" alt="Gaming">
            <p>Gaming</p>
        </div>
        <div>
            <img src="images/sports.png" alt="Sports">
            <p>Sports</p>
        </div>
    </section>

    <section class="top-happenings">
        <h2>Top Happenings Around You</h2>
        <div class="happenings-grid">
            <div>1</div>
            <div>2</div>
            <div>3</div>
            <div>4</div>
        </div>
    </section>

    <section class="testimonials">
        <h2>Hear What the Community Says!</h2>
        <div class="testimonial">
            <div>
                <img src="images/user.png" alt="User">
                <p>I love EventVerse, it's just so convenient!</p>
                <h3>John Doe</h3>
            </div>
            <div>
                <img src="images/user.png" alt="User">
                <p>Finding events has never been easier!</p>
                <h3>Jane Smith</h3>
            </div>
        </div>
    </section>
</main>

<footer>
<?php include 'templates/footer.php'; ?>
</footer>
</body>
</html>
