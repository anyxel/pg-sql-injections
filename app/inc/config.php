<?php
session_start();

// Define database
define('DB_HOST', getenv('DB_HOST'));
define('DB_PORT', getenv('DB_PORT'));
define('DB_USERNAME', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_DATABASE', getenv('DB_DATABASE'));

// MySQLi connection
function mysqliDB()
{
  $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

  if ($conn->connect_error) {
    die($conn->connect_error);
  }

  return $conn;
}


// PDO connection
function pdoDB()
{
  try {
    $connect = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . "; dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connect;
  } catch (PDOException $e) {
    die(json_encode([
      'success' => false,
      'message' => $e->getMessage()
    ], JSON_PRETTY_PRINT));
  }
}
