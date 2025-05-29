  <?php
  require_once('user.php');

  $message = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = trim($_POST['username']);
      $password = $_POST['password'];

      $user = new User();
      $message = $user->create_user($username, $password);

      // If account created successfully, redirect to login
      if ($message === "Account created successfully.") {
          header("Location: login.php");
          exit();
      }
  }
  ?>

  <!DOCTYPE html>
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

          fetch('check_username.php?username=' + encodeURIComponent(username))
            .then(response => response.text())
            .then(data => {
              if (data === 'taken') {
                document.getElementById('user-status').innerText = 'Username already taken';
                document.getElementById('user-status').style.color = 'red';
              } else {
                document.getElementById('user-status').innerText = 'Username available';
                document.getElementById('user-status').style.color = 'green';
              }
            });
        }
      </script>
    </head>
    <body>

      <h1>Create Account</h1>

      <?php if ($message): ?>
        <p style="color: red;"><?= htmlspecialchars($message) ?></p>
      <?php endif; ?>

      <form action="Register.php" method="post">
        <label>Username:</label><br>
        <input type="text" name="username" id="username" onkeyup="checkUsername()" required>
        <span id="user-status"></span>
        <br><br>

        <label>Password (min 8 characters):</label><br>
        <input type="password" name="password" minlength="8" required><br><br>

        <input type="submit" value="Register">
      </form>

      <p>Already have an account? <a href="login.php">Login here</a></p>

    </body>
  </html>

