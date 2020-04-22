<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	 <link rel="icon" href="img/logos/sb.ico">
	
	<title>Softbio - Mapas mentais</title>

	
	<link rel="stylesheet" type="text/css" href="css/curiosidades.css"/>
		    
	<script src="js/formulario.js"></script>

	<script src="bootstrap/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
		
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>

	<script src="js/codigos.js"></script>
	

	
	<script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  	$("#navbar").load("navbar.php?p=mapasmentais");
    });
    </script> 
	
</head>

	<div id="navbar">
	</div>

<body>

<?php
session_start();

			if (!isset($_SESSION["logou"]))
			{
				$_SESSION['pagina_antes_login'] = 'mapasmentais.php';
				header("Location: login.php");

			}

?>
<div class="contentpagina">

	<div class="container col-md-12 col-xs-12 ">
	
		<div class="row">
            <div class="col-lg-12">
                <center><h1>Mapas mentais<br>
                    <small>Simplifique seus estudos com estes resumos!</small>
					
                </h1></center>
            </div>
       </div><br><br>
	   
	   <div class="row">
	   <a href="mapas/origem.pdf" class="mapinhas" target="_blank">
	   <div class='form-group col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-2 '>
		<div id="estadousuario" class="grow">
		
		 <br>
		 <center><h4>Origem da vida</h4></center><br> 
		 <center> Ver mapa mental de origem da vida</center><br><br>
				  
		  </div>

		</div></a>
		
		<a href="mapas/biocelular.pdf" class="mapinhas" target="_blank">
		<div class='form-group col-md-4  col-xs-10 col-xs-offset-1 col-md-offset-0 '>
		<div id="estadousuario" class="grow">

		 <br>
		 <center> <h4>Biologia celular</h4> </center><br>
		 <center> Ver mapa mental de biologia celular</center><br><br>
		  
		  </div>


		 </div></a>
		  
	   </div>
	   
	     <div class="row">
	   
	  <a href="mapas/virus.pdf" class="mapinhas" target="_blank">
	   <div class='form-group col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-2'>
		<div id="estadousuario" class="grow">
		
		 <br>
		 <center> <h4>Vírus</h4> </center><br>
		 <center> Ver mapa mental de vírus</center><br><br>
		  
		  </div>
		</div>
		</a>
		
		 <a href="mapas/reinos.pdf" class="mapinhas" target="_blank">
		<div class='form-group col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-0 '>
		<div id="estadousuario" class="grow">

		 <br>
		  <center><h4>Os principais reinos da biologia</h4> </center>
		 <br>
		 <center>Ver mapa mental dos 5 reinos</center><br><br>
		  
		  </div>


		 </div>
		  </a>
		  
	   </div>
	   
	    <div class="row">
	   
	    <a href="mapas/evolucao.pdf" class="mapinhas" target="_blank">
	   <div class='form-group col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-2'>
		<div id="estadousuario" class="grow">
		
		 <br>
		 <center> <h4>Evolução e classificação dos seres</h4> </center><br>
		 <center>Ver mapa mental de Evolução</center><br><br>
		  
		  </div>

		</div>
		</a>
		
		<a href="mapas/ecologia.pdf" class="mapinhas" target="_blank">
		 <div class='form-group col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-0'>
			<div id="estadousuario" class="grow">
		
		 <br>
		 <center> <h4>Ecologia</h4> </center><br>
		 <center> Ver mapa mental de Ecologia</center><br><br>
		  
		  </div>
		</div>
		</a>
		</div>
		
		<div class="row">
	   
	    <a href="mapas/corpohumano.pdf" class="mapinhas" target="_blank">
	   <div class='form-group col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-2'>
		<div id="estadousuario" class="grow">
		
		 <br>
		 <center> <h4>Principais sistemas do corpo humano</h4> </center><br>
		 <center>Ver mapa mental de sistemas do corpo humano</center><br><br>
		  
		  </div>

		</div>
		</a>
		
				</div>
		
	  
	  <br><br>
	   
	<div class="row">
		<center>
		<a href="index.php" class="btn btn-primary">Voltar</a>
		</center>
		<br><br>
	</div>

	</div>
	
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>
  
</html>
