<?php

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id']) && !isset($_COOKIE['user_id'])) {
    header('Location: login.php');
    setcookie('user_id', '', time() - 3600);
    exit;
}

// Set the session timeout period (in seconds)
$inactive = 1800; // 30 minutes
$session_life = time() - $_SESSION['timeout'];
if ($session_life > $inactive) {
    session_destroy();
    setcookie('user_id', '', time() - 3600);
    header('Location: login.php');
    exit;
}

// Update the session timeout
$_SESSION['timeout'] = time();

// Store the user ID in a session variable
$user_id = $_SESSION['id'];

// Set a cookie for the user ID
if (isset($user_id) && !isset($_COOKIE['user_id'])) {
    setcookie('user_id', $user_id, time() + 3600);
}

// Log out the user and delete the cookie


?>