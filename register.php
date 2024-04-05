<?php
// Include database configuration
require_once 'config/config.php';
require_once 'helpers/sanitization.php';


// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];

    // Check if username, email, and password are not empty
    if (empty($username) || empty($email) || empty($password)) {
        echo "Username, email, and password are required";
        exit();
    }

    // Sanitize form data
    $username = sanitize_input($username);
    $email = sanitize_input($email);
    $password = sanitize_input($password);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }


    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password_hash);

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        echo "success";
        exit();
    } else {
        // Registration failed, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
