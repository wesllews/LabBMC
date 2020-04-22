<!DOCTYPE html>
<html lang="pt-br">
	<head>      <!--col-md-offset-4 coloca espaço (colunas) à esqurda, nesse caso 4 colunas-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="alunocti" >
		
		<title>SoftBio</title>

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
	

	 </head>


	<body>

	<?php
		include "conexao.php";
	session_start();
	$_SESSION['cont']=0;

		$nomeuni= $_POST["nome"];
		$nomemin=strtolower($nomeuni);
		$nometrim=trim($nomemin);
		
		$sigla = $_POST['sigla'];
		$sigla=strtoupper($sigla);
		

		$sql="select id_universidade from universidade where sigla='$sigla'";

		$resultado= pg_query($conecta, $sql);
		$qtde=pg_num_rows($resultado);
		if ($qtde > 0)
		{
			$_SESSION['cont']=2;
					pg_close($conecta);
			header("Location: cadastrauni.php");
		}
		else
		{
			
		$sql_uni="insert into universidade (id_universidade,nome,sigla,excluido)values(nextval('universidade_id_universidade_seq'),'$nomeuni','$sigla','n')";
		
	
		$resultado1= pg_query($conecta, $sql_uni);
		$linhas1= pg_affected_rows($resultado1);
		
		


						
		pg_close($conecta);
		
								

				header("Location: menuni.php");

		}
			?>
		

											

	<script src="../js/jquery.min.js"></script>

</body>
</html>



