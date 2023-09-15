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
    'password' => '7zR079HJ56',
    'mobile' => '+8801158549741',
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'Bangladesh',
  ],
  [
    'name' => 'Adnan Hadi',
    'username' => 'adnan',
    'password' => '215SuPx4M',
    'mobile' => '+97084696883',
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'Palestine',
  ],
  [
    'name' => 'Sourav Datta',
    'username' => 'sourav',
    'password' => '5r6B)QJK29',
    'mobile' => '+913856050491',
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'India',
  ], 
  [
    'name' => 'Imtiyaz Shafeeq',
    'username' => 'imtiyaz',
    'password' => 'sUp3Rpa55w0rD',
    'mobile' => '+442079460346',
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'London',
  ],
  [
    'name' => 'Abdullah Naser',
    'username' => 'naser',
    'password' => 'uR610gtyj',
    'mobile' => '+971550003628',
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'United Arab Emirates',
  ],
  [
    'name' => 'Suhail Wadid',
    'username' => 'suhail',
    'password' => 'An064uZYm',
    'mobile' => '+12025550126',
    'nid' => rand(pow(10, $digits-1), pow(10, $digits)-1),
    'country' => 'United States of America',
  ],
];
$users = json_decode(json_encode($users));

// Prepare queries
$queries = array();
array_push($queries, "drop table if exists $tabel");
array_push($queries, "create table $tabel (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), username VARCHAR(20), password VARCHAR(255), mobile VARCHAR(20), nid VARCHAR(17), country VARCHAR(100))");

foreach ($users as $user) {
  array_push($queries, "insert into $tabel (name, username, password, mobile, nid, country) values ('$user->name', '$user->username', '$user->password', '$user->mobile', '$user->nid', '$user->country')");
}

// Run queries
foreach ($queries as $query) {
  $db->query($query);
}

// Close connection
$db->close();
