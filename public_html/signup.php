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
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <button type="submit">Sign Up</button>
        </form>
        <div id="error_message"></div>
    </main>
    <footer>
        <?php include 'templates/footer.php'; ?>
    </footer>
    <script src="scripts/main.js"></script>
</body>
</html>
