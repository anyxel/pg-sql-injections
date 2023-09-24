<?php
error_reporting(0);
require '../../inc/config.php';

$timeStart = microtime(true);
$success = false;
$message = "Please enter query!";
$user = [];
$query = "";

try {
  $db = pdoDB();

  if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];

    $query = "SELECT id, name, username, mobile, nid, country FROM users where username = '$searchQuery'";

    $stmt = $db->query($query);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = $stmt->rowCount();

    if($rows > 0) {
      $success = true;
      $message = "Successfully retrieved the data!";
    }else {
      $message = "User not found!";
    }
  }
} catch (Exception $ex) {
  $success = false;
  $message = "User not found!";
}

// execution time
$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart); // seconds

if((int)$executionTime == 0) {
  $executionTime = round($executionTime * 1000, 3) . ' ms';
}else {
  $executionTime = round($executionTime, 3) . ' s';
}

// Response
$response = [
  'success' => $success,
  'message' => $message,
  'execution_time' => $executionTime,
  'query' => $query,
  'user' => $user,
];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT);