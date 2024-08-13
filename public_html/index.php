<?php
$pageTitle = "Home";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>
<main>
    <section class="hero-section">
        <div class="container">
            <h1>Your community, your events, your way</h1>
            <p>Discover and create amazing events with Eventverse.</p>
            <button onclick="window.location.href='/EventVersee/public_html/events/find_events.php'">Find an Event Now</button>
        </div>
    </section>
    <section class="plans">
        <div class="container">
            <h2>No Plans Yet? Don't Worry We Got You!</h2>
            <div class="categories">
                <div class="category" onclick="window.location.href='/EventVersee/public_html/events/find_events.php?category=Music'">Music</div>
                <div class="category" onclick="window.location.href='/EventVersee/public_html/events/find_events.php?category=FoodDrinks'">Food & Drinks</div>
                <div class="category" onclick="window.location.href='/EventVersee/public_html/events/find_events.php?category=NightlifeParties'">Nightlife and Parties</div>
                <div class="category" onclick="window.location.href='/EventVersee/public_html/events/find_events.php?category=Learning'">Learning</div>
                <div class="category" onclick="window.location.href='/EventVersee/public_html/events/find_events.php?category=Gaming'">Gaming</div>
                <div class="category" onclick="window.location.href='/EventVersee/public_html/events/find_events.php?category=Sports'">Sports</div>
            </div>
        </div>
    </section>
    <section class="top-events">
        <div class="container">
            <h2>Top Happenings Around You</h2>
            <div class="event-cards">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/top_happenings.php'; ?>
            </div>
        </div>
    </section>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/testimonials.php'; ?>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/home.css">
<script src="/EventVersee/public_html/js/testimonials.js"></script>
