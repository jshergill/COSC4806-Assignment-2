<?php
require_once('user.php');

if ($_SERVER["REQUEST_METHOD"]) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    $user = new User();
    echo $user->create_user($username, $password);
}
?>
  
DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <script>
      function checkUsername() {
        const username = document.getElementById('username').value;

        if (username.length === 0) {
          document.getElementById('user-status').innerText = '';
          return;
        }
         fetch('check_username.php?username=' +            encodeURIComponent(username))
          .then(response => response.text())
          .then(data => {
         if (data === 'taken') {
              document.getElementById('user-status').innerText = 'Username already taken';
              document.getElementById('user-status').style.color = 'red';
         } else {
              document.getElementById('user-status').innerText = 'Username available';
              
            }  });
     }
    </script>
  </head>
  <body>

    <h1>Create Account</h1>

    <form action="Register.php" method="post">
      <label>Username:</label><br>
      <input type="text" name="username" required><br><br>

      <label>Password (min 8 characters):</label><br>
      <input type="password" name="password" minlength="8" required><br><br>

      <input type="submit" value="Register">
    </form> 

  </body>
</html>
