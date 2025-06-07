<?php
$servername = "localhost";
$username = "root";    // your DB username (default is root)
$password = "";        // your DB password (leave empty if none)
$database = "tourism_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
