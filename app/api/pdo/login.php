<?php
require '../../inc/config.php';

$success = false;
$message = "Please pass username and password!";
$user = [];
$rows = 0;
$query = "users";

$qu  = "SELECT * FROM users where username = 'anyxel' OR 1=1' AND password =";

try {
  $db = pdoDB();

  if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = md5($_GET['password']);

    $query = "SELECT * FROM users where username = '$username' AND password = '$password'";

    $stmt = $db->query($query);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = $stmt->rowCount();

    if($rows > 0) {
      $success = true;
      $message = "Successfully retrieved the data!";
    }else {
      $success = false;
      $message = "User not found!";
    }
  }
} catch (Exception $ex) {
  $success = false;
  $message = $ex->getMessage();
}


// Response
$response = [
  'success' => $success,
  'message' => $message,
  'query' => $query,
  'user' => $user,
  'user' => $user,
];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT);