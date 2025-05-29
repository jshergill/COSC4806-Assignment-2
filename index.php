<?php 
session_start();

require_once('user.php');

$user = new User();
$user_list = $user->get_all_users();

echo "<pre>";
print_r($user_list);
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 1) {
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Welcome</title>
  </head>
  <body>
    <h1>Assignment 2</h1>
    <p>Welcome, <?=$_SESSION['username'] ?></p>
    <p>Date: <?= date("Y-m-d") ?></p> <br>
  </body>
 <footer> 
    <p> <a href = "/logout.php">Click here to logout.</a></p>
</html>
