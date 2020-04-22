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
	

		$email= $_POST["email"];
		
		$nome = $_POST['nome'];
		$senha1=$_POST['confsenha'];
		$senha = md5($senha1);
		$exclusao='n';
		$nascimento=$_POST['data_texto'];
		 $nascimento =  date("Y-m-d",  strtotime($nascimento));


		$dificuldade=$_POST['dificuldade'];
		$curso=$_POST['curso'];
		$universidade=$_POST['universidade'];

		$_SESSION['nome']=$nome;
		$_SESSION['email']=$email;
		$_SESSION['senha']=$senha;
		$_SESSION['nascimento']=$nascimento;

		
		$_SESSION['dificuldade']=$dificuldade;
		$_SESSION['curso']=$curso;
		$_SESSION['universidade']=$universidade;



		$sql_dados="insert into login (email,senha,adm,excluido)values('$email','$senha','n','n')";
		
		$resultado1= pg_query($conecta, $sql_dados);
		$linhas1= pg_affected_rows($resultado1);
													
								
		$sql_cadastro ="insert into cadastro (email, nome, datanasc, curso, dificuldade, id_universidade)values('$email','$nome','$nascimento','$curso','$dificuldade',$universidade)";
													
												
		$resultado_cadastro = pg_query($conecta, $sql_cadastro);
		$linhas_cadastro = pg_affected_rows($resultado_cadastro);
													
			
					
													
		pg_close($conecta);
		
		$_SESSION['emailveri']=$email;

				header("Location: cadastraradmnormal.php");

			?>
											

	<script src="../js/jquery.min.js"></script>

</body>
</html>



