<?php
// Include database configuration
require_once 'config/config.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clear previous sessions data
    session_unset();
    session_start();
    // Sanitize input to prevent SQL injection and cross-site scripting (XSS) attacks
    $email = filter_input(INPUT_POST, 'login-email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'login-password', FILTER_SANITIZE_STRING);

    // Check if email and password are provided
    if (!empty($email) && !empty($password)) {
        // Retrieve user data from database
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start session and store user data

                $_SESSION['user'] = $id;
                $stmt->close();

                // Redirect to a secure location after successful login
                header('Location: upload_form.php');
                exit();
            } else {
                // Password is incorrect

                $error = "Incorrect email or password.";
            }
        } else {
            // User with the provided email does not exist
            $error = "User with this email does not exist.";
        }
    } else {
        // Email or password is empty
        $error = "Email and password are required.";
    }

    // Close the statement
    $stmt->close();

    // If there is an error, redirect to the login page with the error message
    $_SESSION['error'] = $error;

    header("Location: " . BASE_URL);
    exit();
}
