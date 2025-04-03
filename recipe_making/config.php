<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$db         = "recipe_making";

// Create connection
$conn =  new mysqli($servername, $username, $password, $db, 3307);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>