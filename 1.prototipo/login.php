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
				<div class="order-xs-1 col-md-5">
					<?php 
					$password = md5($_POST['password']);
					$query= "SELECT * FROM `login` WHERE email='$_POST[email]' and password='$password';";
					$result = $mysqli->query($query);
					$rows =$result->num_rows;
					if ($rows==1) {
						$rows = $result->fetch_array();

						if($rows['status']!="requested"){
							$_SESSION['login']=$rows['status'];
							header("Location: index.php");
						} else {
							$_SESSION['login']="requested";
							?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								Your request is under evaluation! We will contact you by email when it is approved!
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
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required>
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
							Somethong got wrong with your registration submit. Please, try again!!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php unset($_SESSION['register']); ?>
					<?php endif;?>

					<form role="form" method="post" action="register.php">
						<fieldset>							
							<p class="text-uppercase font-weight-bold"> Register</p>	
								<div class="form-group">
								<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Name" required>
							</div>

							<div class="form-group">
								<input type="text" name="institution" id="institution" class="form-control input-lg" placeholder="Institution" required>
							</div>
							<div class="form-group">
								<input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-mail Address" required>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required>
							</div>
							<div class="form-group">
								<textarea class="form-control input-lg" name="justification" placeholder="Justify Permission" rows="3" required></textarea>
							</div>

							<input type="submit" class="btn btn-secondary btn-block float-right" value="Register">
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