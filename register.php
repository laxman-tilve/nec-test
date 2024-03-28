<?php
// Include database configuration
require_once 'config/config.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password_hash);

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        echo "success";
        // header("Location: login_register.html");
        exit();
    } else {
        // Registration failed, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
