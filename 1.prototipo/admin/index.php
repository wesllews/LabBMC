<?php include "connection.php";
session_start(); ?>
<!doctype html>
<html lang="pt">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--Bootstrap CSS-->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<!-- Font Awesome CSS -->
		<link href="https://fonts.googleapis.com/css?family=Baloo+2|Maven+Pro:900|Noto+Sans+SC:900&display=swap" rel="stylesheet">

		<!--LABBMC CSS-->
		<link rel="stylesheet" type="text/css" href="../css/labbmc.css">

		<!-- Title and Icon page -->
		<title>BLT Database</title>
		<link rel="icon" href="../img/dna-solid.svg">
	</head>

	<body class="p-5 bg-dark text-white">

		<?php 
		$email = $_REQUEST['email'];
		$password = md5($_REQUEST['password']);

		$sql= "SELECT * FROM login WHERE email='$email' and password='$password';";
		$query = $mysqli->query($sql);

		if(($query->num_rows)==0 && isset($_REQUEST['email'])): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Error!</strong> User or Password are wrong! Try Again.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php elseif(($query->num_rows)==1): ?>
			<?php $row = $query->fetch_array();
			$_SESSION['admin']= $row['name']; ?>

			<div class="alert alert-success alert-dismissible fade show" role="alert">
				Welcome <strong><?php echo $row['name'];?></strong>!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif; ?>

  		<form method='POST' class="form-signin my-auto">

			<span ><i width="72" height="72"class="fas fa-database text-warning shadow-lg"></i> BLT Database</span>

			<h3 class="mb-3 font-weight-normal">Please sign in</h3>

			<label for="inputEmail" class="sr-only">Email address</label>
			<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" value="<?php echo $_REQUEST['email']?>">

			<label for="inputPassword" class="sr-only">Password</label>
			<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">

			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me" disabled> Remember me
				</label>
			</div>

			<button class="btn btn-lg btn-warning btn-block" type="submit">Sign in</button>
			<a class="btn btn-link text-muted" href=#>Esqueci a senha</a>
	    </form>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script type="text/javascript" src="../js/bootstrap.js"></script>
  
</body>
</html>
