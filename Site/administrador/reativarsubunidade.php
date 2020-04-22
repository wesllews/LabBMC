<!DOCTYPE html>
<html lang="pt-br">
	<head>      <!--col-md-offset-4 coloca espaço (colunas) à esqurda, nesse caso 4 colunas-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="alunocti" >
		
		<title>Softbio - Reativacao de subunidade</title>

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
	

	 </head>


	<body>

	<?php
		include "conexao.php";
		
	session_start();

	
		
		$excluido='n';
		
		 
		$_SESSION["passousub"]=1;
		$id=$_SESSION['id'];

		

		


												$sql1="update subunidade set 
												excluido = '$excluido',
												dataexclusao=NULL											
												where id_subunidade='$id'";
													
												$resultado1= pg_query($conecta, $sql1);
												$linhas1= pg_affected_rows($resultado1);
											
								
												pg_close($conecta);
											
	
												header('location:submenualterasub.php');
	
			?>
											


		<script src="js/bootstrap.min.js"></script>


</body>
</html>



