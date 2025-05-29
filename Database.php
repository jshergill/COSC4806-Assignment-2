<?php

  require_once('Config.php');
  function db_connect(){
    try {
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';port='.DB_PORT, DB_USERNAME, DB_PASSWORD);
        return $dbh;   
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }