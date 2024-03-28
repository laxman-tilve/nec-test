<?php
// Custom Global Constants
define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/nec');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "laxman-kali";
$dbname = "nec";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
