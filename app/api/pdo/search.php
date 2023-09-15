<?php
error_reporting(0);
require '../../inc/config.php';

$success = false;
$message = "Please enter query!";
$user = [];
$table = "users";

try {
  $db = pdoDB();

  if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];

    $query = "SELECT id, name, username, country, nid FROM $table where username = '$searchQuery'";

    $stmt = $db->query($query);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = $stmt->rowCount();

    if($rows > 0) {
      $success = true;
      $message = "Successfully retrieved the data!";
    }
  }
} catch (Exception $ex) {
  $success = false;
  $message = "User not found!";
}


// Response
$response = [
  'success' => $success,
  'message' => $message,
  'user' => $user,
];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT);