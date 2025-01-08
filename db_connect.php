<?php
$servername = "localhost";
$username = "root";
$password = "noem20042003"; // Add your new password here
$dbname = "gargour company";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
