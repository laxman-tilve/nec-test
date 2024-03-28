<?php
require_once 'config/config.php';

// Start session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page

header("Location: " . BASE_URL);
exit();
?>
