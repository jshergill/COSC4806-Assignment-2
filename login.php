<?php
session_start();

if (isset($_GET['message']) && $_GET['message'] === 'registered') {
    echo "<p>Account created successfully! Please log in.</p>";
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <h1>Login Form</h1>

  <form action="validate.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
  </form>

</body>
</html>
