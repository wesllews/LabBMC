<?php
#xampp conexão
$server = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'labbmc';


$mysqli = new mysqli($server,$user,$pass,$db);
$mysqli ->set_charset('utf8');
if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
