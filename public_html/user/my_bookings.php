<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /EventVersee/public_html/login/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch events the user has RSVP'd to
$query = "SELECT e.event_id, e.event_name, e.event_date, e.event_location, e.event_category, e.event_description, e.event_image 
          FROM events e 
          JOIN rsvps r ON e.event_id = r.event_id 
          WHERE r.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$pageTitle = "My Bookings";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>
<main>
    <div class="my-bookings-container">
        <h2>My Bookings</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="bookings-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="booking-item">
                        <?php if (!empty($row['event_image'])): ?>
                            <img src="/EventVersee/public_html/<?php echo htmlspecialchars($row['event_image']); ?>" alt="Event Image">
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($row['event_name']); ?></h3>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($row['event_location']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($row['event_category']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($row['event_description']); ?></p>
                        <button class="cancel-rsvp-button" data-event-id="<?php echo htmlspecialchars($row['event_id']); ?>">Cancel RSVP</button>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>You have not booked any events yet.</p>
        <?php endif; ?>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
mysqli_close($conn);
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/my_bookings.css">
<script src="/EventVersee/public_html/js/my_bookings.js"></script>
