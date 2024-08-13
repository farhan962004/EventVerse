<?php
session_start();
$pageTitle = "Manage Admins";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: /EventVersee/public_html/index.php");
    exit;
}

// Fetch users
$users_query = "SELECT * FROM users";
$users_result = mysqli_query($conn, $users_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Update admin status
    $update_query = "UPDATE users SET is_admin = '$is_admin' WHERE id = '$user_id'";
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['admin_message'] = "Admin status updated successfully.";
    } else {
        $_SESSION['admin_error'] = "Error: " . mysqli_error($conn);
    }
    header("Location: /EventVersee/public_html/admin/manage_admins.php");
    exit;
}

mysqli_close($conn);
?>
<main>
    <div class="admin-container">
        <h2>Manage Admins</h2>
        <?php
        if (isset($_SESSION['admin_message'])) {
            echo "<div class='success-message'>" . $_SESSION['admin_message'] . "</div>";
            unset($_SESSION['admin_message']);
        }
        if (isset($_SESSION['admin_error'])) {
            echo "<div class='error-message'>" . $_SESSION['admin_error'] . "</div>";
            unset($_SESSION['admin_error']);
        }
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Admin</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($user = mysqli_fetch_assoc($users_result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                echo "<td>" . htmlspecialchars($user['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($user['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                echo "<td>" . ($user['is_admin'] ? "Yes" : "No") . "</td>";
                echo "<td>
                        <form action='/EventVersee/public_html/admin/manage_admins.php' method='post'>
                            <input type='hidden' name='user_id' value='" . htmlspecialchars($user['id']) . "'>
                            <input type='checkbox' name='is_admin' " . ($user['is_admin'] ? "checked" : "") . ">
                            <button type='submit'>Update</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
?>
