<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

$lastEventId = isset($_POST['lastEventId']) ? (int)$_POST['lastEventId'] : 0;

// Fetch next set of events
$query = "SELECT * FROM events WHERE id > $lastEventId ORDER BY event_date DESC LIMIT 6";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($event = mysqli_fetch_assoc($result)) {
        echo "<div class='event-item' data-id='" . htmlspecialchars($event['id']) . "'>";
        echo "<h3>" . htmlspecialchars($event['event_name']) . "</h3>";
        echo "<p>Date: " . htmlspecialchars($event['event_date']) . "</p>";
        echo "<p>Location: " . htmlspecialchars($event['event_location']) . "</p>";
        echo "<p>Category: " . htmlspecialchars($event['event_category']) . "</p>";
        if (!empty($event['event_image'])) {
            echo "<img src='/EventVersee/public_html/" . htmlspecialchars($event['event_image']) . "' alt='Event Image'>";
        }
        echo "<a href='/EventVersee/public_html/events/event_details.php?id=" . htmlspecialchars($event['id']) . "'>View Details</a>";
        echo "</div>";
    }
} else {
    echo "<p>No more events found.</p>";
}

mysqli_close($conn);
?>
