<!DOCTYPE html>
<html lang="pt-br">
	<head>      <!--col-md-offset-4 coloca espaço (colunas) à esqurda, nesse caso 4 colunas-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="alunocti" >
		
		<title>Softbio - peloamor</title>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>
		<link href="css/carousel.css" rel="stylesheet">
	

	 </head>


	<body>

	<?php
		include "conecta.php";
		
	session_start();

	$nome = $_POST['nome'];
	$email = $_POST['email'];
		
		$exclusao='n';
		$nascimento=$_POST['data_texto'];
		 $nascimento =  date("Y-m-d",  strtotime($nascimento));


		//$dificuldade=$_POST['dificuldade'];
		$curso=$_POST['curso'];
		$universidade=$_POST['universidade'];

		$_SESSION['nome']=$nome;
		$_SESSION['email']=$email;
		//$_SESSION['senha']=$senha;
		$_SESSION['nascimento']=$nascimento;

		
		//$_SESSION['dificuldade']=$dificuldade;
		$_SESSION['curso']=$curso;
		$_SESSION['universidade']=$universidade;



												$sql1="update cadastro set 
												email = '$email',
												nome='$nome',
												datanasc='$nascimento',
												curso='$curso',
												id_universidade='$universidade'
												
												where email = '$email'";
													

												 //echo $sql1."<br>";
												$resultado1= pg_query($conecta, $sql1);
												$linhas1= pg_affected_rows($resultado1);
											
												
												pg_close($conecta);
											
	
												header('location:minhaconta.php');
	
			?>
											

	<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script src="js/holder.min.js"></script>

</body>
</html>



