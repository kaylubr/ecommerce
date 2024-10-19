<?php
$host = 'localhost';
$db = 'ecommerce_db';
$user = 'root'; 
$pass = '2005'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
