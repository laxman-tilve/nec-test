<?php
require_once 'config/config.php';
require_once 'helpers/auth.php';
redirectToLoginPageIfNotLoggedIn();


session_start();

// Define upload directory
$upload_dir = BASE_URL.'/uploads/';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is selected
    if (!empty($_FILES['fileToUpload']['name'])) {
        $file = $_FILES['fileToUpload'];

        // Check file size (max 5MB)
        if ($file['size'] > 1 * 1024 * 1024) {
            $_SESSION['error'] = "File size exceeds 5MB limit.";
        } else {
            // Check file type (allow jpg and png)
            $allowed_types = ['image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowed_types)) {
                $_SESSION['error'] = "Only JPG and PNG files are allowed.";
            } else {
                // Upload file
                $target_file = $upload_dir . basename($file['name']);
            
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $_SESSION['success'] = "File uploaded successfully.";
                } else {
                    $_SESSION['error'] = "Error uploading file.";
                }
            }
        }
    } else {
        $_SESSION['error'] = "Please select a file.";
    }
}

// Redirect back to the upload form
header("Location: upload_form.php");
exit();
?>
