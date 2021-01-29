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

		$query= "SELECT * FROM `login` WHERE status='administrator'";
		$result = $mysqli->query($query);
		while ($row =$result->fetch_array()) {
			$email = $row["email"];
			$subject = 'BLT Database: New Request of Acess';
			$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "MIME-Version: 1.0\r\n";

			// Vars of CSS
			$button = "background-color: #007bff;  border: none;  color: white;  padding: 15px 32px;  text-align: center;  text-decoration: none; display:inline-block; ";
			$container = " width: 300px; max-height: 300px; margin:10px auto 10px auto; padding:10% 25% 10% 25%; text-align:center; background-color: #f8f9fa;";

			//Email body
			$message = '<html><body>';
			$message .= '
			<div style="'.$container.'">
				<h1 style="color: #343a40;"><span style="color: #007bff.">'.$_POST[name].'</span> requested access to database!</h1>
				<a href="https://www.bltdatabase.ufscar.br/login.php" style="'.$button.'">Analyse Request</a>
			</div>';
			$message .= '</body></html>';
			mail($email, $subject, $message, $headers);		
		}		
		header("Location: login.php");
		exit;
	} else{
		$_SESSION['register']="error";
		header("Location: login.php");
		exit;
	}
}


