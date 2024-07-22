<?php
// Determine if the environment is local or remote
$local = ($_SERVER['SERVER_NAME'] === 'localhost');

if ($local) {
    // Local configuration
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'khan2g1_EventVerse');
} else {
    // Remote (myweb) configuration
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'khan2g1_EventVerse');
    define('DB_PASSWORD', '5ytGkfmAZUcAeD7PNYfu');
    define('DB_NAME', 'khan2g1_EventVerse');
}

// Database connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
