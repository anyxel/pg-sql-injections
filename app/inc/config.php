<?php
session_start();

// Define database
define('dbhost', 'anyxel_db');
define('dbuser', 'root');
define('dbpass', '123456');
define('dbname', 'anyxel');


class Config {
  static $host = dbhost;
  static $db = dbname;
  static $user = dbuser;
  static $pass = dbpass;
}


function mysqliDB() {
  // $db = new mysqli(dbhost, dbname, dbuser, dbpass);
  $db = new mysqli(Config::$host, Config::$user, Config::$pass, Config::$db);
  
  if($db -> connect_error) {
    die($db -> connect_error);
  }

  return $db;
}


function pdoDB() {
  try {
    $connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connect;
  }
  catch(PDOException $e) {
    die(json_encode([
      'success' => false,
      'message' => $e->getMessage()
    ], JSON_PRETTY_PRINT));
  }
}


// Connecting database
try {
	$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
  die(json_encode([
    'success' => false,
    'message' => $e->getMessage()
  ], JSON_PRETTY_PRINT));
}
