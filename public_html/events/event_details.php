<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

// Get the event_id from the URL parameter, allowing for both 'id' and 'event_id'
$event_id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0);

// Check if event_id is valid
if ($event_id <= 0) {
    echo "Invalid event ID.";
    exit;
}

// Prepare and execute the query to fetch event details
$query = "SELECT * FROM events WHERE event_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if event exists
if ($result->num_rows > 0) {
    $event = $result->fetch_assoc();
} else {
    echo "Event not found.";
    exit;
}

// Check if the user has RSVP'd to this event
$isRSVPd = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $rsvp_query = "SELECT * FROM rsvps WHERE event_id = ? AND user_id = ?";
    $rsvp_stmt = $conn->prepare($rsvp_query);
    $rsvp_stmt->bind_param("ii", $event_id, $user_id);
    $rsvp_stmt->execute();
    $rsvp_result = $rsvp_stmt->get_result();

    if ($rsvp_result->num_rows > 0) {
        $isRSVPd = true;
    }

    $rsvp_stmt->close();
}

$pageTitle = "Event Details";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>

<main>
    <div class="event-details-container">
        <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
            <div class="success-message">Event updated successfully!</div>
        <?php endif; ?>
        <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($event['event_category']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($event['event_description']); ?></p>
        <?php if (!empty($event['event_image'])): ?>
            <img src="/EventVersee/public_html/<?php echo htmlspecialchars($event['event_image']); ?>" alt="Event Image">
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <button id="rsvp-button" data-event-id="<?php echo htmlspecialchars($event_id); ?>" <?php if ($isRSVPd) echo 'style="display:none;"'; ?>>RSVP</button>
            <button id="unrsvp-button" data-event-id="<?php echo htmlspecialchars($event_id); ?>" <?php if (!$isRSVPd) echo 'style="display:none;"'; ?>>Cancel RSVP</button>
        <?php else: ?>
            <button id="loginPrompt">RSVP</button>
        <?php endif; ?>
    </div>
</main>

<!-- Login Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Need to login to RSVP.</p>
        <a href="/EventVersee/public_html/login/login.php">Login</a>
    </div>
</div>

<!-- RSVP Confirmation Modal -->
<div id="rsvpModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Thank you for RSVPing! See you at the event.</p>
    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
$stmt->close();
$conn->close();
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/event_details.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/EventVersee/public_html/js/event_details.js"></script>
