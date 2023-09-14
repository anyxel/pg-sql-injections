<?php
error_reporting(0);
require '../../inc/config.php';

$success = false;
$message = "Please pass username and password!";
$user = [];
$table = "users";

try {
  $db = pdoDB();

  if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = md5($_GET['password']);
  
    // $username = "adnan' OR 1=1-- 1";

    $query = "SELECT * FROM $table where username = '$username' AND password = '$password'";

    $stmt = $db->query($query);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = $stmt->rowCount();

    if($rows > 0) {
      $success = true;
      $message = "Successfully retrieved the data!";
    }else {
      $success = true;
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
  'rows' => $rows,
  'user' => $user,
];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_PRETTY_PRINT);