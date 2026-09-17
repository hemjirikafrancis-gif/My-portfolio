<?php
/* Database connection for ALIRA Farm.
   Default values below match a standard WAMP setup
   (user "root", no password). Change if your setup differs. */

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "alira_farm";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
