<?php
session_start();
$pageTitle = "Sign Up";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>
<main>
    <div class="login-container">
        <h2>Sign Up</h2>
        <?php
        if (isset($_SESSION['signup_error'])) {
            echo "<div class='error-message'>" . $_SESSION['signup_error'] . "</div>";
            unset($_SESSION['signup_error']);
        }
        ?>
        <form action="/EventVersee/public_html/login/signup_process.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required onkeyup="checkPassword()">
                <small id="password-help">Password must be at least 8 characters long, include an uppercase letter, a number, and a special character.</small>
                <div id="password-message"></div>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="/EventVersee/public_html/login/login.php">Login</a></p>
        <a href="/EventVersee/public_html/index.php" class="back-home">Back to Home</a>
    </div>
</main>
<script>
function checkPassword() {
    const password = document.getElementById('password').value;
    const message = document.getElementById('password-message');
    const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+]).{8,}$/;
    if (regex.test(password)) {
        message.style.color = 'green';
        message.textContent = 'Password meets the requirements.';
    } else {
        message.style.color = 'red';
        message.textContent = 'Password does not meet the requirements.';
    }
}

function validateForm() {
    const password = document.getElementById('password').value;
    const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+]).{8,}$/;
    if (!regex.test(password)) {
        alert('Password does not meet the requirements.');
        return false;
    }
    return true;
}
</script>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
?>
