<?php
require_once('Database.php');

class User {

  public function get_all_users() {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM users;");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create_user($username, $password) {
    $db = db_connect();

    $statement = $db->prepare("SELECT id FROM users WHERE username = :username");
    $statement->execute([':username' => $username]);
    if ($statement->fetch()) {
      return "Username already taken.";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $statement = $db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
    $success = $statement->execute([
      ':username' => $username,
      ':password_hash' => $hashed_password
    ]);

    return $success ? "Account created successfully." : "Error creating account.";
  }
}
