<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "d0237a35";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"."<br>";
?>
