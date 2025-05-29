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
  $stmt = $db->prepare("SELECT id FROM users WHERE username = :username");
  $stmt->execute([':username' => $username]);
  return $stmt->fetch() ? true : false;
}

public function create_user($username, $password) {
  if ($this->is_username_taken($username)) {
    return "Username already taken.";
  }

  $db = db_connect();
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $statement = $db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
  $success = $statement->execute([
    ':username' => $username,
    ':password_hash' => $hashed_password
  ]);

  return $success ? "Account created successfully." : "Error creating account.";
}

public function authenticate_user($username, $password) {
  $db = db_connect();

  $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute([':username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password_hash'])) {
    return $user;
  }

  return false;
  }
}
