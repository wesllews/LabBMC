<?php
session_start();
include "connection.php"; 

$email = $_POST['email'];
// Enviar E-mail
if (isset($_POST['email']) && !isset($_POST["validatepassword"])) {
	$query= "SELECT * FROM `login` WHERE email='$_POST[email]';";
	$result = $mysqli->query($query);
	$rows =$result->num_rows;
	if ($rows==1):
		$novasenha = substr(md5(time()),0,6);
		$novasenha_md5 = md5($novasenha);
		$subject = 'BLT Database: New password';
		$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "MIME-Version: 1.0\r\n";

		// Vars of CSS
		$button = "background-color: #28A745;  border: none;  color: white;  padding: 15px 32px;  text-align: center;  text-decoration: none; display:inline-block; ";
		$container = " width: 300px; max-height: 300px; margin:10px auto 10px auto; padding:10% 25% 10% 25%; text-align:center; background-color: #f8f9fa;";

		//Email body
		$message = '<html><body>';
		$message .= '
		<div style="'.$container.'">
			<h1 style="color:#343a40;">Forgot your password for BLT Database?</h1>

			<form role="form" method="POST" action="https://www.bltdatabase.ufscar.br/forgotpassword.php">
				<input type="hidden" name="validatepassword" value="'.$novasenha.'">
				<input type="hidden" name="email" value="'.$email.'">
				<button type="submit" style="'.$button.'">Reset password</button>
			</form>
		</div>';
		$message .= '</body></html>';

		if (mail($email, $subject, $message, $headers)) {
			$query= "UPDATE `login` SET password = '$novasenha_md5' WHERE email='$email';";
			$result = $mysqli->query($query) or die($mysqli->error);
			$_SESSION['password'] = "sent";
		} else {
			$_SESSION['password'] = "not sent";
		}
	else:
		$_SESSION['password'] = "not resgistered";
	endif;
}
?>
<!doctype html>
<html lang="pt">



  <head>

		<!--<meta http-equiv="refresh" content="100">-->

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--Bootstrap CSS-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<!-- Font Awesome CSS -->
		<link href="https://fonts.googleapis.com/css?family=Baloo+2|Maven+Pro:900|Noto+Sans+SC:900&display=swap" rel="stylesheet">

		<!--LABBMC CSS-->
		<link rel="stylesheet" type="text/css" href="css/labbmc.css">

		<!-- Title and Icon page -->
		<title>BLT Database</title>
		<link rel="icon" href="img/dna-solid.svg">
  </head>

<body class="bg-light">
	<div class="container-fluid">
		<div class="container">	
			<h1 class="font-weight-bold mt-4">
				<a href="index.php" class="text-decoration-none text-dark"><i width="72" height="72"class="fas fa-database text-warning"></i> BLT Database</a>
			</h1>
			<hr>

			<div class="row py-5">
				<div class="d-none d-lg-block col-lg-3 my-5 py-5">
					<!-------null------>
				</div>

				<div class="col-xs-12 col-lg-6 my-5 py-5">

					<!------- ALERTS ------>
					<?php if($_SESSION['password']=="sent"): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Check your email and spam for the subject "BLT Database: New password".
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif($_SESSION['password']=="not sent"): ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Something went wrong to sent You an e-mail. <strong>Try again!!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif($_SESSION['password']=="not resgistered"): ?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Email not registered yet.</strong> Register and wait for our approval contact!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>

					<!-- Inserir email cadastrado -->
					<?php if (!isset($_POST["validatepassword"]) && !in_array($_SESSION['password'], array("sent","changed"))):?>		
							<form role="form" method="POST" action="forgotpassword.php">
								<fieldset>							
									<p class="text-uppercase font-weight-bold"> Reset your password: </p>	
											
									<div class="form-group">
										<input type="email" name="email" value="<?php echo $email; ?>" class="form-control input-lg" placeholder="E-mail" required>
									</div>
									<div>
										<input type="submit" class="btn btn-warning btn-block" value="Submit">
									</div>
									</fieldset>
							</form>	

					<!-- Link vindo do email -->
					<?php elseif(isset($_POST["validatepassword"])): ?>
						<?php 
						$validatepassword = md5($_POST["validatepassword"]);
						$query= "SELECT * FROM `login` WHERE email='$email' and password='$validatepassword';";
						$result = $mysqli->query($query);
						$rows=$result->num_rows; ?>
						<?php if($rows==1): ?>			
							<form role="form" method="POST" action="user_update.php">
								<fieldset>							
									<p class="text-uppercase font-weight-bold"> Reset your password: </p>	
									<!--Input email -->
									<div class="form-group">
										<input type="email" name="email" class="form-control input-lg" value="<?php echo $email; ?>" readonly>
									</div>
									<!--Input senha -->
									<div class="form-group">
										<div class="input-group">
											<input type="password" name="password" id="password" class="form-control input-lg" placeholder="New Password" required>
											<div class="input-group-prepend">
												<div class="input-group-text" data-toggle="popover" tabindex="0"  data-trigger="focus" data-container="body" data-placement="top" data-html="true" data-content="
												The password must contain:
												<ul>
													<li>Lowercase alphabetical character</li>
													<li>Uppercase alphabetical character</li>
													<li>Numeric character</li>
													<li>Special character(e.g. !@#$%^&*)</li>
													<li>8 characters or longer</li>
												</ul>">
													<i class="fas fa-question"></i>
												</div>
											</div>
										</div>								
										<small id="password-sm" class="text-danger"></small>
									</div>
									<!--Botão Submit-->
									<div>
										<input type="hidden" name="update" value="password">
										<input type="submit" class="btn btn-warning btn-block" value="Submit">
									</div> 
									</fieldset>
							</form>
						<?php else: ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								Something went wrong with the link!<strong>Try again!!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif;?>

					<!---- Senha trocada --->
					<?php elseif($_SESSION['password']=="changed"): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Your password has been successfully changed!!!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
							</button>							
						</div>
						<a href="login.php" class="btn btn-success btn-block p-2"> Login</a>
					<?php endif;?>
				</div>

				<!-------Clean Session------>
				<?php $_SESSION['password']="";?>

				<div class="d-none d-lg-block col-md-3 my-5 py-5">
					<!-------null------>
				</div>
					
			</div>
		</div>
	</div>


	  <!-- Optional JavaScript -->
	  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	  <script type="text/javascript" src="js/popper.min.js"></script>

	  <script type="text/javascript" src="js/bootstrap.js"></script>

	  <script type="text/javascript" src="js/labbmc.js"></script>
	  
	</body>
</html>

<?php
$mysqli->close();