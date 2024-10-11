<?php
// db.php

$servername = "localhost";  // Database server (usually localhost)
$username = "root";         // Database username (default for XAMPP is 'root')
$password = "";             // Database password (default for XAMPP is empty)
$dbname = "ecom";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
