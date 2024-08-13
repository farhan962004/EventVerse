<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_category = $_POST['event_category'];
    $event_description = strip_tags($_POST['event_description']); // Strip HTML tags
    $event_image = '';

    // Handle file upload
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/uploads/';
        $target_file = $target_dir . basename($_FILES['event_image']['name']);
        move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file);
        $event_image = 'uploads/' . basename($_FILES['event_image']['name']);
    }

    if ($event_image) {
        $query = "UPDATE events SET event_name=?, event_date=?, event_location=?, event_category=?, event_description=?, event_image=? WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $event_name, $event_date, $event_location, $event_category, $event_description, $event_image, $event_id);
    } else {
        $query = "UPDATE events SET event_name=?, event_date=?, event_location=?, event_category=?, event_description=? WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $event_name, $event_date, $event_location, $event_category, $event_description, $event_id);
    }

    if ($stmt->execute()) {
        // Redirect to the event details page
        header("Location: /EventVersee/public_html/events/event_details.php?event_id=" . $event_id);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'No changes made to the event']);
    }

    $stmt->close();
    $conn->close();
}
?>
