<?php
session_start();

// Define database
define('dbhost', 'anyxel_db');
define('dbuser', 'root');
define('dbpass', '123456');
define('dbname', 'anyxel');


// class Config {
//   static $host = dbhost;
//   static $db = dbname;
//   static $user = dbuser;
//   static $pass = dbpass;
// }


function mysqliDB() {
  // $conn = new mysqli(Config::$host, Config::$user, Config::$pass, Config::$db);
  $conn = new mysqli(dbhost, dbuser, dbpass, dbname);
  
  if($conn -> connect_error) {
    die($conn -> connect_error);
  }

  return $conn;
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
