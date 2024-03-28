<?php
 session_start();
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Clear the session variable after displaying
}

// Function to sanitize output to prevent XSS attacks
function sanitize_output($buffer)
{
    return htmlspecialchars($buffer, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <!-- Display error message if present -->
            <?php if (!empty($error)) : ?>
                <div class="error-message">
                    <?php echo sanitize_output($error); ?>
                </div>
            <?php endif; ?>

            <form id="login-form" class="login-form" action="login.php" method="post">
                <h2>Login</h2>
                <div class="input-group">
                    <label for="login-email">Email:</label>
                    <input type="email" id="login-email" name="login-email">
                </div>
                <div class="input-group">
                    <label for="login-password">Password:</label>
                    <input type="password" id="login-password" name="login-password">
                </div>
                <button type="submit">Login</button>
            </form>
            <form id="register-form" class="register-form hidden" action="register.php" method="post">
                <h2>Register</h2>
                <div class="input-group">
                    <label for="register-username">Username:</label>
                    <input type="text" id="register-username" name="register-username">
                </div>
                <div class="input-group">
                    <label for="register-email">Email:</label>
                    <input type="email" id="register-email" name="register-email">
                </div>
                <div class="input-group">
                    <label for="register-password">Password:</label>
                    <input type="password" id="register-password" name="register-password">
                </div>
                <button type="submit">Register</button>
            </form>
            <p class="switch">Already have an account? <a href="#" id="login-link">Login</a></p>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>