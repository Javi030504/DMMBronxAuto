<?php
// database connection settings
$host = "localhost";
$user = "root";
$password = "";
$dbname = "dmmbronxauto";

// create connection to MySQL database
$conn = new mysqli($host, $user, $password, $dbname);

// check if connection works
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>