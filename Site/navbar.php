<?php 
session_start();
$adm =$_SESSION['adm'];
$p = $_GET['p'];
$teste = $_GET['teste'];

if(($_SESSION['adm']!='s'&& $p=='adm')||($teste=='s' && $_SESSION['logou']!='s'))
{
	echo "<script>window.location='/hope/tcc/login.php';</script>";
}
?>
<link rel="stylesheet" href="css/apendices.css"/>
<header>
		<nav <?php if($adm =='s'){echo "id='adm'";} ?> class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-navbar" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="logo-nav" href="index.php"><img src="/hope/tcc/img/logos/softbio95.png" ></a>
				</div>
				<div class="collapse navbar-collapse" id="collapse-navbar">
				<!--<span class="sr-only">(current)</span>-->
					<ul class="nav navbar-nav" style="text-align: left;">
						<?php if($adm !='s' && $p == 'index'){?><li class="menu-active"><a href="index.php">Home</a></li><?php } 
						else if($adm !='s' && $p != 'index'){?>	<li class="botao"><a href="index.php">Home</a></li> <?php } ?>

						<?php if($adm !='s' && $p == 'noticias'){?><li class="menu-active"><a href="noticias.php">Notícias</a></li><?php } 
						else if($adm !='s' && $p != 'noticias'){?>	<li class="botao"><a href="noticias.php">Notícias</a></li> <?php } ?>

						<?php if($adm !='s' && $p == 'paggeralcont'){?><li class="menu-active"><a href="paggeralcont.php">Estudar</a></li><?php } else if($adm !='s' && $p != 'paggeralcont'){?>
						<li class="botao"><a href="paggeralcont.php">Estudar</a></li> <?php } ?>
						
						<?php if($adm !='s' && $p == 'questoes'){?><li class="menu-active"><a href="questoes.php">Questões</a></li><?php } 
						else if($adm !='s' && $p != 'questoes'){?>	<li class="botao"><a href="questoes.php">Questões</a></li> <?php } ?>
						
												
						<?php if($adm !='s' && $p == 'curiosidades'){?><li class="menu-active"><a href="curiosidades.php">Curiosidades</a></li><?php } 
						else if($adm !='s' && $p != 'curiosidades'){?>	<li class="botao"><a href="curiosidades.php">Curiosidades</a></li> <?php } ?>
						
						<?php if($adm !='s' && $p == 'mapasmentais'){?><li class="menu-active"><a href="mapasmentais.php">Mapas mentais</a></li><?php } 
						else if($adm !='s' && $p != 'mapasmentais'){?>	<li class="botao"><a href="mapasmentais.php">Mapas mentais</a></li> <?php } ?>
						

						
						<?php if($adm !='s' && $p == 'sobre'){?><li class="menu-active"><a href="sobre.html">Sobre</a></li><?php } 
						else if($adm !='s' && $p != 'sobre'){?>	<li class="botao"><a href="sobre.html">Sobre</a></li> <?php } ?>
						
						<?php if($adm =='s' && $p == 'index'){?>
						<li class="menu-active"><a href="/hope/tcc/administrador/index.php">
						<span class="glyphicon glyphicon-home"></span></a></li>
						<?php } else if($adm =='s'){?> <li class="botao"><a href="/hope/tcc/administrador/index.php">
						<span class="glyphicon glyphicon-home"></span></a></li> <?php } ?>


						
											
					</ul>
					<?php
					if($adm =='s')
					{
						?><ul class="nav navbar-nav navbar-right">
						<li class="botao"><a class="" href="/hope/tcc/logout.php">Sair</a></li>
						</ul>
						<?php 
					}
					else
					{
					?>
					<ul class="nav navbar-nav navbar-right">
						<li class="rebel" style="text-align: center;">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>
							<!---->
							<br>
							
							<?php
								if ($_SESSION["logou"] == "s")
								{
									echo "<p>Olá, ".$_SESSION["nome"]."!</p></a>"; ?>
									<ul class="dropdown-menu dropdown-menu-navbar">
									<li><a href="minhaconta.php">Minha conta</a></li>
									<li><a href="logout.php">Sair</a></li>
									</ul>
									<?php
								}
								else{
									echo "<p>Olá, visitante!</p></a>";?>
									<ul class="dropdown-menu dropdown-menu-navbar">
									<li><a href="cadastrar.php">Cadastre-se</a></li>
									<li><a href="login.php">Login</a></li>
									</ul>
									<?php 
								}
							?>
							
						</li>
					</ul>
					<?php
					}
					?>
			<?php 
					if ($adm !='s'){
					?>

					<form class="navbar-form navbar-right" method="post" action="pesquisa.php">
						<div class="input-group">
							<input type="text" name="pesquisa" class="form-control pesquisar" value="<?php if($p=='pesquisa')echo $_SESSION['pesquisa']; else{$_SESSION['pesquisa']="";}?>" placeholder="Pesquisar..." size="30">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
							</span>
						</div>
					</form>
					<?php
					}
					?>
					
				</div><!-- /.navbar-collapse -->
		</nav>
		
	<script src="bootstrap/js/bootstrap.min.js"></script>
  	<script>window.jQuery || document.write('<script src="jquery.js"><\/script>')</script>
  	<script src="js/holder.min.js"></script>
  	<?php

if($adm=='s')
{
	?>
	<style type="text/css">
	.divide{text-align:center; color:#001a1a !important;background-color:#FFF !important;}
	#adm{background-color:#001a1a !important;}
	#adm ul li a {color:#FFF !important;}
	#adm ul li a:hover {background-color:#001a1a !important; color:#94b8b8 !important;}
	footer{
	background-color: #001a1a !important;}
	</style>
	<?php
}
  	 ?>
</header>