<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;
$query = "SELECT * FROM events WHERE event_id = $event_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $event = mysqli_fetch_assoc($result);
} else {
    echo "Event not found.";
    exit;
}

$pageTitle = "Edit Event";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>

<main>
    <div class="edit-event-container">
        <h2>Edit Event</h2>
        <form id="edit-event-form" action="/EventVersee/public_html/user/edit_event_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">
            <div>
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required>
            </div>
            <div>
                <label for="event_date">Event Date:</label>
                <input type="datetime-local" id="event_date" name="event_date" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($event['event_date']))); ?>" required>
            </div>
            <div>
                <label for="event_location">Event Location:</label>
                <input type="text" id="event_location" name="event_location" value="<?php echo htmlspecialchars($event['event_location']); ?>" required>
            </div>
            <div>
                <label for="event_category">Event Category:</label>
                <select id="event_category" name="event_category" required>
                    <option value="Music" <?php echo $event['event_category'] == 'Music' ? 'selected' : ''; ?>>Music</option>
                    <option value="Food & Drinks" <?php echo $event['event_category'] == 'Food & Drinks' ? 'selected' : ''; ?>>Food & Drinks</option>
                    <option value="Nightlife and Parties" <?php echo $event['event_category'] == 'Nightlife and Parties' ? 'selected' : ''; ?>>Nightlife and Parties</option>
                    <option value="Learning" <?php echo $event['event_category'] == 'Learning' ? 'selected' : ''; ?>>Learning</option>
                    <option value="Gaming" <?php echo $event['event_category'] == 'Gaming' ? 'selected' : ''; ?>>Gaming</option>
                    <option value="Sports" <?php echo $event['event_category'] == 'Sports' ? 'selected' : ''; ?>>Sports</option>
                    <option value="Others" <?php echo $event['event_category'] == 'Others' ? 'selected' : ''; ?>>Others</option>
                </select>
            </div>
            <div>
                <label for="event_description">Event Description:</label>
                <textarea id="event_description" name="event_description" required><?php echo htmlspecialchars($event['event_description']); ?></textarea>
            </div>
            <div>
                <label for="event_image">Event Image:</label>
                <?php if (!empty($event['event_image'])): ?>
                    <img src="/EventVersee/public_html/<?php echo htmlspecialchars($event['event_image']); ?>" alt="Event Image">
                <?php endif; ?>
                <input type="file" id="event_image" name="event_image">
            </div>
            <button type="submit">Update Event</button>
        </form>
    </div>
</main>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
mysqli_close($conn);
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/host_event.css">
<script src="https://cdn.tiny.cloud/1/14jueqohsdl9v6buolyg6btc757bf0ijs12ymj097wq73ier/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#event_description'
});
</script>
