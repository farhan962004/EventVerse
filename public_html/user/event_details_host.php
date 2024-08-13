<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /EventVersee/public_html/login/login.php");
    exit;
}

$event_id = $_GET['event_id'] ?? null;

if (!$event_id) {
    header("Location: /EventVersee/public_html/user/manage_events.php");
    exit;
}

$query = "SELECT e.*, u.first_name, u.last_name, u.email FROM events e JOIN users u ON e.user_id = u.id WHERE e.event_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Event not found.";
    exit;
}

$event = $result->fetch_assoc();

$attendee_query = "SELECT u.first_name, u.last_name, u.email FROM rsvps r JOIN users u ON r.user_id = u.id WHERE r.event_id = ?";
$attendee_stmt = $conn->prepare($attendee_query);
$attendee_stmt->bind_param('i', $event_id);
$attendee_stmt->execute();
$attendees_result = $attendee_stmt->get_result();

$pageTitle = "Event Details Host";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>
<main>
    <div class="event-details-container">
        <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($event['event_category']); ?></p>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($event['event_description'])); ?></p>
        <p><strong>Organizer:</strong> <?php echo htmlspecialchars($event['first_name'] . ' ' . $event['last_name']); ?> (<?php echo htmlspecialchars($event['email']); ?>)</p>

        <h3>Attendees</h3>
        <?php if ($attendees_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($attendee = $attendees_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($attendee['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($attendee['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($attendee['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No attendees yet.</p>
        <?php endif; ?>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
mysqli_close($conn);
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/event_details_host.css">
