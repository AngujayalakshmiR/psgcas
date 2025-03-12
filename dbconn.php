<?php
$servername = "localhost"; // Change if using a remote server
$username = "root"; // Change as per your DB credentials
$password = ""; // Change as per your DB credentials
$dbname = "ktg"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
