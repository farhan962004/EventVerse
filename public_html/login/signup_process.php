<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Validate password strength
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+]).{8,}$/', $password)) {
        $_SESSION['signup_error'] = "Password must be at least 8 characters long, include an uppercase letter, a number, and a special character.";
        header("Location: signup.php");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result_email = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($result_email) > 0) {
        $_SESSION['signup_error'] = "An account already exists with the same email.";
        header("Location: signup.php");
        exit;
    }

    // Check if username already exists
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $result_username = mysqli_query($conn, $check_username_query);
    if (mysqli_num_rows($result_username) > 0) {
        $_SESSION['signup_error'] = "An account already exists with the same username.";
        header("Location: signup.php");
        exit;
    }

    // Handle profile picture upload
    $profile_picture = '';
    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/' . $profile_picture);
    }

    $query = "INSERT INTO users (first_name, last_name, email, username, password, profile_picture) VALUES ('$first_name', '$last_name', '$email', '$username', '$hashed_password', '$profile_picture')";
    if (mysqli_query($conn, $query)) {
        // Automatically log in the user
        $user_id = mysqli_insert_id($conn);
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['username'] = $username;
        $_SESSION['profile_picture'] = $profile_picture;

        header("Location: /EventVersee/public_html/index.php");
        exit;
    } else {
        $_SESSION['signup_error'] = "Error: " . mysqli_error($conn);
        header("Location: signup.php");
        exit;
    }
}

mysqli_close($conn);
?>
