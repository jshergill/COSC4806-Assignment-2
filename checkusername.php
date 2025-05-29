<?php
require_once('user.php');

if (isset($_GET['username'])) {
    $username = trim($_GET['username']);
    $user = new User();

    if ($user->is_username_taken($username)) {
        echo 'taken';
    } else {
        echo 'available';
    }
}
?>
