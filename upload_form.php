<?php
require_once 'helpers/auth.php';
redirectToLoginPageIfNotLoggedIn();

session_start();

// Display error message if present
if (isset($_SESSION['error'])) {
    echo '<div style="color: red;">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); // Clear error message
}

// Display success message if present
if (isset($_SESSION['success'])) {
    echo '<div style="color: green;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Clear success message
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
</head>

<body>

    <h2>Upload File</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" required>
        <input type="submit" value="Upload File" name="submit">
    </form>
    <!-- Logout button -->
    <a href="logout.php">Logout</a>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('fileToUpload');
            const file = fileInput.files[0];

            // Check if file is selected
            if (!file) {
                alert('Please select a jpg/png file.');
                event.preventDefault();
            }

            // Check file size (max 5MB)
            else if (file.size > 1 * 1024 * 1024) {
                alert('File size exceeds 1MB limit.');
                event.preventDefault();
            }

            // Check file type (allow jpg and png)
            const allowedTypes = ['image/jpeg', 'image/png'];
            else if (!allowedTypes.includes(file.type)) {
                alert('Only JPG and PNG files are allowed.');
                event.preventDefault();
            }
        });
    </script>

</body>

</html>