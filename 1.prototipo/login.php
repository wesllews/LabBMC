<?php
session_start();
include "connection.php"; ?>
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

			<div class="row">
				<!--Login-->
				<div class="order-xs-1 col-md-5">
					<?php 
					$password = md5($_POST['password']);
					$query= "SELECT * FROM `login` WHERE email='$_POST[email]' and password='$password';";
					$result = $mysqli->query($query);
					$rows =$result->num_rows;
					if ($rows==1) {
						$rows = $result->fetch_array();

						if(!in_array($rows['status'], array("requested","denied"))){
							$_SESSION['login']="sim";
							$_SESSION['status']=$rows['status'];
							$_SESSION['email']=$rows['email'];
							header("Location: index.php");
						} elseif($rows['status']=="requested") {
							$_SESSION['login']="nao";
							?>
							<div class="alert alert-primary alert-dismissible fade show" role="alert">
								Your request is under evaluation! We will contact you by email when it is analyzed!
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php
						} elseif($rows['status']=="denied") {
							$_SESSION['login']="nao";
							?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								Unfortunately your access was denied! Try to contact our administrators to review your profile.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php
						}						
					}	elseif(isset($_POST['email'])) {
						$_SESSION['login']="nao";
						?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Something went wrong with the <strong>User</strong> or <strong>Password</strong>!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<?php
					}
					?>

					<form role="form" method="post" action="login.php">
						<fieldset>							
							<p class="text-uppercase font-weight-bold"> Login using your account: </p>	

							<div class="form-group">
								<input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-mail" required>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="login_password" class="form-control input-lg" placeholder="Password" required>
								<a href="forgotpassword.php" class="btn float-right font-italic text-decoration-none text-secondary" style="font-size: 12px;">Forgot your password?</a>
							</div>
							<div>
								<input type="submit" class="btn btn-warning btn-block float-right" value="Sign In">
							</div>
						</fieldset>
					</form>	
				</div>

					
				<div class="order-xs-2 col-md-2 py-5">
					<!-------null------>
				</div>

				<!--Register-->
				<div class="col-md-5">
					<?php if($_SESSION['register']=="exist"):	?>
						<div class="alert alert-primary alert-dismissible fade show" role="alert">
							Register has been already done on this e-mail! Try login or wait for our approval contact by e-mail.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php unset($_SESSION['register']); ?>

					<?php elseif($_SESSION['register']=="done"): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Your registration has been submitted for approval! You will receive an e-mail confirming your access !!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php unset($_SESSION['register']); ?>

					<?php elseif($_SESSION['register']=="error"): ?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							Something got wrong with your registration submit. Please, try again!!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php unset($_SESSION['register']); ?>
					<?php endif;?>

					<form id="register" method="post" action="#">
						<fieldset>							
							<p class="text-uppercase font-weight-bold"> Register</p>	
								<div class="form-group">
								<input type="text" name="name" id="register_name" class="form-control input-lg" placeholder="Name" required>
								<small id="register_name-sm" class="text-danger"></small>
							</div>

							<div class="form-group">
								<input type="text" name="institution" id="register_institution" class="form-control input-lg" placeholder="Institution" required>
								<small id="register_institution-sm" class="text-danger"></small>
							</div>

							<div class="form-group">
								<input type="email" name="email" id="register_email" class="form-control input-lg" placeholder="E-mail Address" required>
								<small id="register_email-sm" class="text-danger"></small>
							</div>

							<div class="form-group">
								<div class="input-group">
									<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required>
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

							<div class="form-group">
								<textarea class="form-control input-lg" name="justification" id="register_justification" placeholder="Justify Permission" rows="3" required></textarea>
								<small id="register_justification-sm" class="text-danger"></small>
							</div>

							<input type="submit" form="register" class="btn btn-secondary btn-block float-right" value="Register">
						</fieldset>
					</form>
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