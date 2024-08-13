<?php
session_start();
$pageTitle = "Host an Event";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: /EventVersee/public_html/login/login.php");
    exit;
}

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<main>
    <div class="host-event-container">
        <h2>Host an Event</h2>
        <?php
        if (isset($_SESSION['event_message'])) {
            echo "<div class='success-message'>" . $_SESSION['event_message'] . "</div>";
            unset($_SESSION['event_message']);
        }
        if (isset($_SESSION['event_error'])) {
            echo "<div class='error-message'>" . $_SESSION['event_error'] . "</div>";
            unset($_SESSION['event_error']);
        }

        // Load form data from session if available
        $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
        ?>
        <form id="hostEventForm" action="/EventVersee/public_html/events/host_event_process.php" method="post" enctype="multipart/form-data">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" value="<?php echo htmlspecialchars($form_data['event_name'] ?? '', ENT_QUOTES); ?>" required>
            
            <label for="event_date">Event Date:</label>
            <input type="datetime-local" id="event_date" name="event_date" value="<?php echo htmlspecialchars($form_data['event_date'] ?? '', ENT_QUOTES); ?>" required>
            
            <label for="event_location">Event Location:</label>
            <input type="text" id="event_location" name="event_location" value="<?php echo htmlspecialchars($form_data['event_location'] ?? '', ENT_QUOTES); ?>" required>
            
            <label for="event_category">Event Category:</label>
            <select id="event_category" name="event_category" required>
                <option value="" disabled <?php echo empty($form_data['event_category']) ? 'selected' : ''; ?>>Select a category</option>
                <option value="Music" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Music') ? 'selected' : ''; ?>>Music</option>
                <option value="Food & Drinks" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Food & Drinks') ? 'selected' : ''; ?>>Food & Drinks</option>
                <option value="Nightlife and Parties" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Nightlife and Parties') ? 'selected' : ''; ?>>Nightlife and Parties</option>
                <option value="Learning" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Learning') ? 'selected' : ''; ?>>Learning</option>
                <option value="Gaming" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Gaming') ? 'selected' : ''; ?>>Gaming</option>
                <option value="Sports" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Sports') ? 'selected' : ''; ?>>Sports</option>
                <option value="Others" <?php echo (isset($form_data['event_category']) && $form_data['event_category'] == 'Others') ? 'selected' : ''; ?>>Others</option>
            </select>
            
            <label for="event_description">Event Description:</label>
            <textarea id="event_description" name="event_description" required><?php echo htmlspecialchars($form_data['event_description'] ?? '', ENT_QUOTES); ?></textarea>
            
            <label for="event_image">Event Image:</label>
            <input type="file" id="event_image" name="event_image" accept="image/*" required>
            
            <button type="submit">Host Event</button>
        </form>
    </div>
</main>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
unset($_SESSION['form_data']);
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/host_event.css">
<script src="https://cdn.tiny.cloud/1/14jueqohsdl9v6buolyg6btc757bf0ijs12ymj097wq73ier/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#event_description',
        menubar: false,
        plugins: 'advlist autolink lists link image charmap print preview anchor textcolor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    // Ensure TinyMCE content is synchronized on form submission
    document.getElementById('hostEventForm').addEventListener('submit', function(e) {
        tinymce.triggerSave();
    });
</script>
