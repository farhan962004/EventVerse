<?php
session_start();
$pageTitle = "Login";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
?>
<main>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo "<div class='error-message'>" . $_SESSION['login_error'] . "</div>";
            unset($_SESSION['login_error']);
        }
        ?>
        <form action="/EventVersee/public_html/login/login_process.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/EventVersee/public_html/login/signup.php">Sign Up</a></p>
        <a href="/EventVersee/public_html/index.php" class="back-home">Back to Home</a>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
?>
