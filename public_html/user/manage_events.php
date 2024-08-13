<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /EventVersee/public_html/login/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT e.*, COUNT(r.event_id) AS rsvp_count FROM events e LEFT JOIN rsvps r ON e.event_id = r.event_id WHERE e.user_id = ? GROUP BY e.event_id";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$pageTitle = "Manage My Events";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>
<main>
    <div class="manage-events-container">
        <h2>Your Hosted Events</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th>RSVP Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_location']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_category']); ?></td>
                            <td><?php echo htmlspecialchars($row['rsvp_count']); ?></td>
                            <td>
                                <a href="/EventVersee/public_html/user/event_details_host.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-primary">View Details</a>
                                <a href="/EventVersee/public_html/user/edit_event.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-secondary">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You haven't hosted any events yet. Looking to host an event? <a href="/EventVersee/public_html/events/host_event_intro.php" class="btn btn-secondary">Click here to get started</a>.</p>
        <?php endif; ?>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
mysqli_close($conn);
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/manage_events.css">
