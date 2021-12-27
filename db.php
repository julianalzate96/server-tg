<?php

$servername = "bacfaw8ladyfblafqdaf-mysql.services.clever-cloud.com";
$username = "utkibcs3devkzbio";
$password = "aGlnG4NJjThITLqB1L2k";
$database = "bacfaw8ladyfblafqdaf";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
return $conn
?>