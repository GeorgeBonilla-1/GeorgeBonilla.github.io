<?php

$host = "ls-cded0dc04fe953f536ab0ac5d7eb83f49b9f6f17.c4jkc6a4itmx.us-east-1.rds.amazonaws.com";
$user = "dbmasteruser";
$password = "-ZS&d?TKokFfH;5u(_wRpLur7o7al?Ew";
$database = "users_db";
$port = "3306";

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
