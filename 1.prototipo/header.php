<?php
session_start();
include "connection.php";

//Define as regras de permissão
if(in_array($_SESSION['status'],array("administrator","collaborator"))){
	$_SESSION['permission'] = array("download","dashboard","delete");
} else{
	$_SESSION['permission'] = array("read");
}

// Não deixa entrar em paginas de administração
if(!in_array("dashboard",$_SESSION['permission']) && $_SESSION['pagina']=='admin'){
	header("Location: login.php");
}
 ?>
<!doctype html>
<html lang="pt">



  <head>

		<meta http-equiv="refresh" content="10000">

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="google-site-verification" content="w3Rey0pC0aRXS90rt23RMktJ-EewjpZ_l_YQU1PnCsU" />

		<!--Bootstrap CSS-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<!-- Font Awesome CSS -->
		<link href="https://fonts.googleapis.com/css?family=Baloo+2|Maven+Pro:900|Noto+Sans+SC:900&display=swap" rel="stylesheet">

		<!--LABBMC CSS-->
		<link rel="stylesheet" type="text/css" href="css/labbmc.css">

		  <!-- Custom styles for this template -->
		<link href="css/simple-sidebar.css" rel="stylesheet">

		<!-- Title and Icon page -->
		<title>BLT Database</title>
		<link rel="icon" href="img/dna-solid.svg">
  </head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <?php if(in_array("dashboard",$_SESSION['permission'])): ?>
      <div class="bg-light" id="sidebar-wrapper">
        <div class="sidebar-heading">Dashboard</div>
        <div class="list-group list-group-flush">
          <a href="users.php" class="list-group-item list-group-item-action bg-light">Users</a>

          <!-- Individual -->
          <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" data-target="#individual">Individuals</a>
          <div id="individual" class="collapse list-group list-group-flush">
            <a href="captivity_insert.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-plus"></i> Captivity</a>
            <a href="wild_insert.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-plus"></i> Wild</a>
          </div>

          <!-- Population -->
          <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" data-target="#population">Populations and Group</a>
          <div id="population" class="collapse list-group list-group-flush">
            <a href="institute.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-plus"></i> Captivity Institute</a>
            <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-plus"></i> Fragment</a>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow ">
            <?php if(in_array("dashboard",$_SESSION['permission'])): ?>
              <button class="btn btn-secondary mr-5" id="menu-toggle">Dashboard</button>
            <?php endif; ?>
            <!-- Brand -->
            <a class="navbar-brand font-weight-bold"><i class="fas fa-database text-warning shadow-lg"></i> BLT Database</a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <!-- Collapse links, flex-justify-->
          <div class="collapse navbar-collapse justify-content-between rounded" id="navbar-list">
            
            <!-- Pages links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link <?php if($_SESSION['pagina']=='home'){echo "active";} ?>" href="index.php"><i class="fas fa-home"></i> Home</a>
              </li>

              <li class="nav-item dropdown  <?php if($_SESSION['pagina']=='wild' || $_SESSION['pagina']=='captivity'){echo "active";} ?>">
                <a class="nav-link dropdown-toggle" href="#" id="lifeHistory" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fab fa-pagelines"></i> Life History
                </a>
                <div class="dropdown-menu" aria-labelledby="lifeHistory">
                  
                  <a class="dropdown-item <?php if($_SESSION['pagina']=='wild'){echo "active";} ?>" href="menu.php?page=wild"><i class="fab fa-pagelines"></i> Wild</a>

                  <a class="dropdown-item <?php if($_SESSION['pagina']=='captivity'){echo "active";} ?>" href="menu.php?page=captivity"><i class="fas fa-book-open"></i> Captivity</a>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($_SESSION['pagina']=='genetics'){echo "active";} ?>" href="menu.php?page=genetics"  data-toggle="popover" data-trigger="hover"  tabindex="0" data-container="body" data-placement="auto" data-html="true" data-content="Genotypes and Haplotypes informations">
                  <i class="fas fa-dna"></i> Genetics</a>
              </li>
            </ul>

            <!-- Login/Logout -->
            <?php if(isset($_SESSION['login']) && $_SESSION['login']=="sim"): ?>
              <a class="btn btn-danger my-2 my-sm-0" href="logout.php">Logout</a>
            <?php else: ?>
              <a class="btn btn-success my-2 my-sm-0" href="login.php">Register / Login</a>
            <?php endif; ?>
          </div>

        </nav>

