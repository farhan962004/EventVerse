<?php
// Database connection
$host = 'localhost';
$dbname = 'khan2g1_EventVerse';
$username = 'khan2g1_EventVerse';
$password = '5ytGkfmAZUcAeD7PNYfu';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the latest event postings
    $stmt = $pdo->query('SELECT event_id, event_name, event_image FROM events ORDER BY event_id DESC LIMIT 4');
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($events as $event) {
        echo '<div class="event-card">';
        echo '<a href="/EventVersee/public_html/events/event_details.php?id=' . htmlspecialchars($event['event_id']) . '">';
        echo '<img src="' . htmlspecialchars($event['event_image']) . '" alt="' . htmlspecialchars($event['event_name']) . '">';
        echo '<div class="event-name">' . htmlspecialchars($event['event_name']) . '</div>';
        echo '</a>';
        echo '</div>';
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
