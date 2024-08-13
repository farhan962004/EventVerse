<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: /EventVersee/public_html/index.php");
    exit;
}

if (isset($_GET['id'])) {
    $event_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete event
    $delete_query = "DELETE FROM events WHERE id = '$event_id'";
    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['admin_message'] = "Event deleted successfully.";
    } else {
        $_SESSION['admin_error'] = "Error: " . mysqli_error($conn);
    }
    header("Location: /EventVersee/public_html/admin/admin_dashboard.php");
    exit;
}

mysqli_close($conn);
?>
