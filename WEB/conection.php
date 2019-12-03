<?php

#xampp conexão
$server = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'labbmc';

$conexão = mysqli_connect($server,$user,$pass,$db) or die("Não conectado");

?>
