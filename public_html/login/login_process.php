<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, trim($_POST['password'])) : '';

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Email and password are required.";
        header("Location: /EventVersee/public_html/login/login.php");
        exit;
    }

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];

            header("Location: /EventVersee/public_html/index.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid password.";
            header("Location: /EventVersee/public_html/login/login.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = "Invalid email.";
        header("Location: /EventVersee/public_html/login/login.php");
        exit;
    }
}
mysqli_close($conn);
?>
