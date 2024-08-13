<?php
session_start();
$pageTitle = "Host an Event";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>

<main>
    <div class="host-event-container">
        <h2>Host Your Own Event on EventVerse!</h2>
        <p>Join our community of event organizers and make your event a success.</p>
        <button class="host-event-button" onclick="window.location.href='/EventVersee/public_html/events/host_event.php'">Get Started</button>

        <div class="steps-container">
            <div class="step">
                <div class="step-number">1. Create</div>
                <h3>Create an Event</h3>
                <p>Set up your event by adding a name, date, tickets, and a detailed description.</p>
            </div>
            <div class="step">
                <div class="step-number">2. Customize</div>
                <h3>Personalize Your Event</h3>
                <p>Add your unique touch to the event page with detailed information and images.</p>
            </div>
            <div class="step">
                <div class="step-number">3. Manage</div>
                <h3>Manage Effortlessly</h3>
                <p>Access booking details and customer contact information all in one place.</p>
            </div>
        </div>
    </div>
</main>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
?>

<link rel="stylesheet" href="/EventVersee/public_html/css/host_event_intro.css">
