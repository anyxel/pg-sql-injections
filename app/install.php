<?php
require 'inc/header.php';

$db = mysqliDB();

// Create users table
$tabel = "users";

// Fake users
$users = [
  [
    'name' => 'Adnan Hadi',
    'username' => 'adnan',
    'password' => md5('azerty1234'),
  ],
  [
    'name' => 'Imtiyaz Shafeeq',
    'username' => 'imtiyaz',
    'password' => md5('sUp3Rpa55w0rD'),
  ],
  [
    'name' => 'Abdullah Naser',
    'username' => 'naser',
    'password' => md5('uR6+10gtyj'),
  ],
];
$users = json_decode(json_encode($users));


// Prepare queries
$queries = array();
array_push($queries, "drop table if exists $tabel");
array_push($queries, "create table $tabel (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), username VARCHAR(20), password VARCHAR(255))");

foreach ($users as $user) {
  array_push($queries, "insert into $tabel (name, username, password) values ('$user->name', '$user->username', '$user->password')");
}

// Run queries
foreach ($queries as $query) {
  $db->query($query);
}

// Close connection
$db->close();
