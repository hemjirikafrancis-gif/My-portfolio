<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "submit";

$conn = new mysqli($host, $user, $pass, $db);

// check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>