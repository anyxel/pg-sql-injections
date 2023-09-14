<?php
session_start();

// Define database
define('dbhost', 'anyxel_db');
define('dbuser', 'root');
define('dbpass', '123456');
define('dbname', 'anyxel');

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


// function db() {
//   try {
//     $connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
//     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     return $connect;
//   }
//   catch(PDOException $e) {
//     die(json_encode([
//       'success' => false,
//       'message' => $e->getMessage()
//     ], JSON_PRETTY_PRINT));
//   }
// }