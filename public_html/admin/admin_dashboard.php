<?php
session_start();
$pageTitle = "Admin Dashboard";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: /EventVersee/public_html/index.php");
    exit;
}

// Fetch users and events
$users_query = "SELECT * FROM users";
$users_result = mysqli_query($conn, $users_query);

if (!$users_result) {
    die("Error fetching users: " . mysqli_error($conn));
}

$events_query = "SELECT * FROM events";
$events_result = mysqli_query($conn, $events_query);

if (!$events_result) {
    die("Error fetching events: " . mysqli_error($conn));
}
?>
<main>
    <div class="admin-container">
        <h2>Admin Dashboard</h2>
        <div class="admin-section">
            <h3>Manage Users</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
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
                    echo "<td><a href='/EventVersee/public_html/admin/delete_user.php?id=" . htmlspecialchars($user['id']) . "'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="admin-section">
            <h3>Manage Events</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($event = mysqli_fetch_assoc($events_result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($event['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['event_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['event_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['event_location']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['event_category']) . "</td>";
                    echo "<td><a href='/EventVersee/public_html/admin/delete_event.php?id=" . htmlspecialchars($event['id']) . "'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="admin-section">
            <h3>Admin Management</h3>
            <p><a href="/EventVersee/public_html/admin/manage_admins.php">Manage Admins</a></p>
        </div>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
mysqli_close($conn);
?>
