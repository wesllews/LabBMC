<!DOCTYPE html>
<html lang="pt-br">
	<head>      <!--col-md-offset-4 coloca espaço (colunas) à esqurda, nesse caso 4 colunas-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="alunocti" >
		
		<title>Softbio - Cadastro de curiosidades</title>

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
	

	 </head>


	<body>

	<?php
		include "conexao.php";
		
	session_start();

	if($_SESSION['adm']!='s')
header("Location: /hope/tcc/login.php");
		
		$excluido='s';
		
		$dataexclusao = date("Y-m-d"); 
		
		$email=$_SESSION['email'];



		


												$sql1="update login set 
												excluido = '$excluido',
												dataexclusao = '$dataexclusao'
											
												where email='$email'";
													
												$resultado1= pg_query($conecta, $sql1);
												$linhas1= pg_affected_rows($resultado1);
											
								
												pg_close($conecta);
											
	
												header('location:mostrausu.php');
	
			?>
											


		<script src="js/bootstrap.min.js"></script>


</body>
</html>



