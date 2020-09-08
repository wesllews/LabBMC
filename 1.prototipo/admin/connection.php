<?php
#xampp conexão
$server = 'web-db.ufscar.br';
$user = 'admbltdb';
$pass = 'ya3hLBrlfrig6cEp#wo&O';
$db = 'bltdatabase_db';


$mysqli = new mysqli($server,$user,$pass,$db);
$mysqli ->set_charset('utf8');
if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
