<?php
session_start();
include "connection.php";

$query= "SELECT * FROM `login` WHERE email='$_POST[email]'";
$result = $mysqli->query($query);
$rows =$result->num_rows;
if ($rows ==1 ) {
	$_SESSION['register']="exist";
	header("Location: login.php");
	exit;
} else {
	$date = date('Y-m-d');
	$password = md5($_POST['password']);
	$query = "INSERT INTO `login` (`id`,`name`, `institution`, `justification`, `email`, `password`, `status`, `request_date`,`approval_date`) VALUES (NULL,'$_POST[name]', '$_POST[institution]', '$_POST[justification]', '$_POST[email]', '$password', 'requested', '$date', NULL);";
	$result = $mysqli->query($query);
	if ($result === TRUE) {
		$_SESSION['register']="done";
		header("Location: login.php");
		exit;
	} else{
		$_SESSION['register']="error";
		header("Location: login.php");
		exit;
	}
}


