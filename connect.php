<?php
$host = "localhost";
$user = "root";     
$pass = "";        
$db   = "bookipedia";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("connection error" . $conn->connect_error);
}
?>
