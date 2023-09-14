<?php
require 'inc/header.php';

$success = true;
$data = [];
$rows = 0;

try {
  $db = pdoDB();

  // $request = "105 OR 1=1";
  $request = "google.com' OR 1=1-- ";


  // $users = $db->query("SELECT * FROM level1 ORDER BY id DESC LIMIT 1")->fetchAll();

  $query = "SELECT * FROM level1 where website = '$request'";


  var_dump($query);
  echo "<br><br>";

  $stmt = $db->query($query);

  // die();



  // $stmt->execute([$request]); 
  // $users = $stmt->fetchAll();

// $stmt->execute(array($request));
$users = $stmt->fetchAll();


  var_dump($users);
  die();

  $query = "select * from level1 where site = $request";

  $stmt = $connect->prepare($query);

  // $q = "select * from level1 where site =105 or 1=1";

  // $stmt = $db->query($query);

  
  $data = $stmt->fetch(PDO::FETCH_ASSOC);

  // $rows = $stmt->num_rows;

  // $data = $stmt->fetch_row();

  // $res = $stmt->fetch_row();
  // var_dump($res);
  // die();

  // echo "<table><tr><th>Password</th><th>Website</th></tr>";
  // if($stmt->num_rows > 0) {
  //     while($res = $stmt->fetch_row()) {
  //         echo "<tr><td>$res[0]</td><td>$res[1]</td></tr>";
  //     }   
  // }
  // echo "</table>";
} catch (\Exception $ex) {
  var_dump($ex->getMessage());
}


// Response
$response = [
  'success' => $success,
  'rows' => $rows,
  'data' => $data,
];
echo json_encode($response, JSON_PRETTY_PRINT);
