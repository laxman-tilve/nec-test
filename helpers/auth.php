<?php
require_once 'config/config.php';

session_start();

// Function to check if the user is logged in
function isUserLoggedIn()
{
    return isset($_SESSION['user']);
}

// Function to authenticate the user
function authenticateUser($userId)
{
    $_SESSION['user'] = $userId;
}

// Function to logout the user
function logoutUser()
{
    unset($_SESSION['user']);
}

// Function to redirect to login page if not logged in
function redirectToLoginPageIfNotLoggedIn()
{
    if (!isUserLoggedIn()) {
        header("Location: " . BASE_URL);
        exit();
    }
}
