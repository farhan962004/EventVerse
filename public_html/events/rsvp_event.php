<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 0;

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Insert RSVP record
        $query = "INSERT INTO rsvps (event_id, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $event_id, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'RSVP successful.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to RSVP.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    }
}

$conn->close();
?>
