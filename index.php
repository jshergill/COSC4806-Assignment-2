<?php 
session_start();
 if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] ==1) {

    } else{
    header("Location: login.php");}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>COSC4806</title>
  </head>
  <body>

    <h1>Assignment 1</h1>
    <p>Welcome, <?=$_SESSION['username']?></p>
    <p> Date:<? echo date("Y-m-d")?></p>


  </body>
 <footer> 
    <p> <a href = "/logout.php">Click here to logout.</a></p>
</html>
