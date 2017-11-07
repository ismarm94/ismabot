<?php
$servername = "localhost";
$username = "id3241895_ismabot";
$password = "";
$dbname = "id3241895_ismabot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


?>
