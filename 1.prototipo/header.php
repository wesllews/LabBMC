<?php
session_start();
include "connection.php"; ?>
<!doctype html>
<html lang="pt">



  <head>

		<meta http-equiv="refresh" content="3">

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



  <header>

	    <!-- NavBar-Class -->
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow ">

	    	<!-- Brand -->
	    	<a class="navbar-brand font-weight-bold" href="http://web-01.ufscar.br/webdb/"><i class="fas fa-database text-warning shadow-lg"></i> BLT Database</a>

		    <!-- Toggler -->
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

		    <!-- Collapse links, flex-justify-->
			<div class="collapse navbar-collapse justify-content-between rounded" id="navbar-list">
				
				<!-- Pages links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link <?php if($_SESSION['pagina']=='home'){echo "active";} ?>" href="index.php"><i class="fas fa-home"></i> home</a>
					</li>

					<li class="nav-item dropdown  <?php if($_SESSION['pagina']=='wild' || $_SESSION['pagina']=='captivity'){echo "active";} ?>">
						<a class="nav-link dropdown-toggle" href="#" id="lifeHistory" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fab fa-pagelines"></i> Life History
						</a>
						<div class="dropdown-menu" aria-labelledby="lifeHistory">
							
							<a class="dropdown-item <?php if($_SESSION['pagina']=='wild'){echo "active";} ?>" href="mainWild.php"><i class="fab fa-pagelines"></i> Wild</a>

							<a class="dropdown-item <?php if($_SESSION['pagina']=='captivity'){echo "active";} ?>" href="mainCaptivity.php"><i class="fas fa-book-open"></i> Captivity</a>
						</div>
					</li>

					<li class="nav-item dropdown <?php if($_SESSION['pagina']=='genotypes'){echo "active";}?>">
						<a class="nav-link dropdown-toggle" href="#" id="Headergenetics" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-dna"></i> Genetics</a>
						</a>
						<div class="dropdown-menu" aria-labelledby="Headergenetics">
							<a class="dropdown-item <?php if($_SESSION['pagina']=='genotypes'){echo "active";}?>" href="genotypes.php"><i class="fas fa-fingerprint"></i> Genotypes and Alleles</a>

						<!--
							<a class="dropdown-item" href="#"><i class="fas fa-barcode"></i> Haploypes</a>

							<div class="dropright">
								<a class="dropdown-item dropdown-toggle dropright" href="#" id="test" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-circle"></i> Exemplo</a>
								</a>
								<div class="dropdown-menu" aria-labelledby="test">
									<a class="dropdown-item" href="#">Exemplo 1</a>
									<a class="dropdown-item" href="#">Exemplo 2</a>
								</div>
							</div>
						-->

					</li>

					<?php if(in_array($_SESSION['login'],array("administrator","collaborator"))): ?>
						<li class="nav-item">
							<a class="nav-link text-warning <?php if($_SESSION['pagina']=='admin'){echo "active";} ?>" href="admin.php"><i class="fas fa-cog"></i> Dashboard</a>
						</li>
					<?php endif; ?>

				</ul>

				<!-- User Name -->
				<?php if(isset($_SESSION['login']) && $_SESSION['login']!="nao"): ?>
					<a class="btn btn-danger my-2 my-sm-0" href="logout.php">Logout</a>
				<?php else: ?>
					<a class="btn btn-success my-2 my-sm-0" href="login.php">Register / Login</a>
				<?php endif; ?>

				<!-- Search 
				<form class="form-inline mt-2 mt-md-0" >
					<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
				-->
			</div>

		</nav>
  </header>



  <body>
