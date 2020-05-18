<?php include "../connection.php"; ?>
<!doctype html>
<html lang="pt">

  <head>

		<meta http-equiv="refresh" content="1000">

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



  <header>

	    <!-- NavBar-Class -->
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow ">

	    	<!-- Brand -->
	    	<a class="navbar-brand font-weight-bold" href="http://localhost/phpmyadmin/index.php"><i class="fas fa-database text-warning shadow-lg"></i>BLT Database</a>

		    <!-- Toggler -->
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

		    <!-- Collapse links, flex-justify-->
			<div class="collapse navbar-collapse justify-content-between rounded" id="navbar-list">
				
				<!-- Pages links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link <?php if($_SESSION['pagina']=='home'){echo "active";} ?>" href="index.php"><i class="fas fa-home"></i> Insert</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($_SESSION['pagina']=='studbook'){echo "active";} ?>" href="studbook.php"><i class="fas fa-book-open"></i> Alter</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($_SESSION['pagina']=='genotypes'){echo "active";} ?>" href="genotypes.php"><i class="fas fa-dna"></i> Genotypes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="individual.php"><i class="fas fa-users"></i> About Us</a>
					</li>
				</ul>
				
				<!-- User Name -->
				<span class="d-none navbar-text text-warning"><i class="fas fa-user"></i> Hey, User!</span>
				
			</div>

		</nav>
  </header>



  <body>
