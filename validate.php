<?php
session_start();
require_once('user.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = new User();
    $authenticatedUser = $user->authenticate_user($username, $password);

    if ($authenticatedUser) {
        $_SESSION['authenticated'] = 1;
        $_SESSION['username'] = $authenticatedUser['username'];
        $_SESSION['user_id'] = $authenticatedUser['Id']; // assuming the column is "Id"

        header("Location: index.php");
        exit();
    } else {
        // Redirect back with error flag
        header("Location: login.php?error=1");
        exit();
    }
} else {
    // Invalid access
    header("Location: login.php");
    exit();
}
