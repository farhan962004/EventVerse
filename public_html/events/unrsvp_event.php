<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 0;

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Delete RSVP record
        $query = "DELETE FROM rsvps WHERE event_id = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $event_id, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'RSVP cancelled successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to cancel RSVP.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    }
}

$conn->close();
?>
