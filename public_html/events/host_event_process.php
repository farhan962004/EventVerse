<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_location = mysqli_real_escape_string($conn, $_POST['event_location']);
    $event_category = mysqli_real_escape_string($conn, $_POST['event_category']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $user_id = $_SESSION['user_id'];

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/EventVersee/public_html/uploads/";
    $file_name = basename($_FILES["event_image"]["name"]);
    $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["event_image"]["tmp_name"]);

    if ($check !== false) {
        $insert_query = "INSERT INTO events (user_id, event_name, event_date, event_location, event_category, event_description) VALUES ('$user_id', '$event_name', '$event_date', '$event_location', '$event_category', '$event_description')";
        if (mysqli_query($conn, $insert_query)) {
            $event_id = mysqli_insert_id($conn);
            $target_file = $target_dir . "img_eID_" . $event_id . "." . $imageFileType;

            if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {
                $update_query = "UPDATE events SET event_image = 'uploads/img_eID_" . $event_id . "." . $imageFileType . "' WHERE event_id = '$event_id'";
                mysqli_query($conn, $update_query);
                $_SESSION['event_message'] = "Event created successfully.";
            } else {
                $_SESSION['event_error'] = "There was an error uploading the image.";
                error_log("File upload error: " . print_r($_FILES['event_image']['error'], true));
            }
        } else {
            $_SESSION['event_error'] = "Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['event_error'] = "File is not an image.";
    }

    $_SESSION['form_data'] = $_POST;
    header("Location: /EventVersee/public_html/events/host_event.php");
    exit;
}
?>
