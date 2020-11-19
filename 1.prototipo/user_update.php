<?php
session_start();
include "connection.php"; 

switch ($_POST['update']) {
	case 'password':
		$novasenha_md5 = md5($_POST['password']);
		$email = $_POST['email'];
		
		$subject = 'BLT Database: Password successfully changed';
		$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "MIME-Version: 1.0\r\n";

		// Vars of CSS
		$button = "background-color: #28A745;  border: none;  color: white;  padding: 15px 32px;  text-align: center;  text-decoration: none; display:inline-block; ";
		$container = " width: 300px; max-height: 300px; margin:10px auto 10px auto; padding:10% 25% 10% 25%; text-align:center; background-color: #f8f9fa;";

		//Email body
		$message = '<html><body>';
		$message .= '
		<div style="'.$container.'">
			<h1 style="color: #343a40;">Login using your new password!!</h1>
				<a href="https://www.bltdatabase.ufscar.br/login.php" style="'.$button.'">Login</a>
		</div>';
		$message .= '</body></html>';

		if (mail($email, $subject, $message, $headers)) {
			$query= "UPDATE `login` SET password = '$novasenha_md5' WHERE email='$email';";
			$result = $mysqli->query($query) or die($mysqli->error);
			$_SESSION['password']="changed";
			header("Location: forgotpassword.php");

		}
	break;

	case "status":
		$id = $_POST['id'];
		$status = $_POST['status'];
		$query= "UPDATE `login` SET status = '$status' WHERE id='$id';";
		$result = $mysqli->query($query) or die($mysqli->error);
		echo "<script>window.close();</script>";
	break;

	default:
		# code...
		break;
}
?>