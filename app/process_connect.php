<?php
// connect database 
$servername = "127.0.0.1";
$username_db = "db_tickets_user";
$password_db = "Mysql$123456789";
$dbname = "db_tickets";
//$port = 3307;

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}
