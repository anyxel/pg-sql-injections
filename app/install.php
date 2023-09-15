<?php
require 'inc/header.php';

$db = mysqliDB();

// Create users table
$tabel = "users";

// Fake users
$digits = 13;
// echo rand(pow(10, $digits-1), pow(10, $digits)-1);

$users = [
  [
    'name' => 'Anyxel',
    'username' => 'anyxel',
    'password' => md5('7*zR079HJ$56'),
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'Bangladesh',
  ],
  [
    'name' => 'Adnan Hadi',
    'username' => 'adnan',
    'password' => md5('21"5SuP.x4;M'),
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'Palestine',
  ],
  [
    'name' => 'Sourav Datta',
    'username' => 'sourav',
    'password' => md5('5r6,;B)QJK29'),
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'India',
  ],
  [
    'name' => 'Imtiyaz Shafeeq',
    'username' => 'imtiyaz',
    'password' => md5('sUp3Rpa55w0rD'),
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'London',
  ],
  [
    'name' => 'Abdullah Naser',
    'username' => 'naser',
    'password' => md5('uR6+10gtyj'),
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'United Arab Emirates',
  ],
  [
    'name' => 'Suhail Wadid',
    'username' => 'suhail',
    'password' => md5('An06^4uZYm&`'),
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'United States of America',
  ],
];
$users = json_decode(json_encode($users));

// Prepare queries
$queries = array();
array_push($queries, "drop table if exists $tabel");
array_push($queries, "create table $tabel (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), username VARCHAR(20), country VARCHAR(100), nid VARCHAR(17), password VARCHAR(255))");

foreach ($users as $user) {
  array_push($queries, "insert into $tabel (name, username, country, nid, password) values ('$user->name', '$user->username', '$user->country', '$user->nid', '$user->password')");
}

// Run queries
foreach ($queries as $query) {
  $db->query($query);
}

// Close connection
$db->close();
