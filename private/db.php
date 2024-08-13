<?php
$servername = 'localhost';
$username = 'khan2g1_EventVerse';
$password = '5ytGkfmAZUcAeD7PNYfu';
$dbname = 'khan2g1_EventVerse';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to escape input data - Optional if needed later
function escape($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}
?>
