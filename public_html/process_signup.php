<?php
include '../private/config.php';
session_start();

$email = "";
$password = "";
$confirm_password = "";
$first_name = "";
$last_name = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error_message = "An account with this email address already exists.";
    } else {
        if ($password != $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (email, password, first_name, last_name) VALUES ('$email', '$hashed_password', '$first_name', '$last_name')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                header("Location: index.php"); // Redirect to homepage after sign up
                exit;
            } else {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - EventVerse</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <header>
        <?php include 'templates/header.php'; ?>
    </header>
    <main>
        <h2>Sign Up</h2>
        <form action="process_signup.php" method="POST" onsubmit="return validateSignupForm()">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>" required>
            
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            
            <button type="submit">Sign Up</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <div id="error_message"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </main>
    <footer>
        <?php include 'templates/footer.php'; ?>
    </footer>
    <script src="scripts/main.js"></script>
</body>
</html>
