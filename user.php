<?php
require_once('Database.php');

class User {

  public function get_all_users() {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM users;");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function is_username_taken($username) {
    $db = db_connect();
    $stmt = $db->prepare("SELECT Id FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch() ? true : false;
  }

  public function create_user($username, $password) {
    if ($this->is_username_taken($username)) {
      return "Username already taken.";
    }

    // Password validation
    if (
      strlen($password) < 8 ||
      !preg_match('/[A-Z]/', $password) ||
      !preg_match('/[a-z]/', $password) ||
      !preg_match('/[0-9]/', $password) ||
      !preg_match('/[\W]/', $password)
    ) {
      return "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
    }

    $db = db_connect();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $success = $statement->execute([
      ':username' => $username,
      ':password' => $hashed_password
    ]);

    return $success ? "Account created successfully." : "Error creating account.";
  }

  public function authenticate_user($username, $password) {
    $db = db_connect();

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }

    return false;
  }
}

