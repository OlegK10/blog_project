<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "blog";

$db= new mysqli($servername, $username, $password, $dbName);

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
?>