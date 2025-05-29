<?php
require_once('Database.php');
Class User{
  public function get_all_users(){
    $dbh = db_connect();
    $sql = "SELECT * FROM users";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}