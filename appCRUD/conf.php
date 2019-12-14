<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "db_clientes";

// Create connection
$conn = new mysqli($server_name, $user_name, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
