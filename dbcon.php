<?php
$server = "localhost"; 
$username = "root";
$password = ""; 
$db = "escape-room"; 

define("DATABASE", "escape-room");
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

define("CRUD_TABLE", "questions");

try {
  $db_connection = new PDO("mysql:host=$server; dbname=$db", $username, $password);
  $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Verbinding mislukt" . $e->getMessage();
}