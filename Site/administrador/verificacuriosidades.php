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
		include "substituir.php";
		session_start();
	

		$email= $_POST["email"];
		
		$texto=$_SESSION['texto'];
		$titulo1=$_SESSION['titulo'];
		$titulo=trim($titulo1);
		
		
		$fonte=$_SESSION['fonte'];
		$data=$_SESSION['data'];
		
		
$texto = preg_replace('/(\'|")/', "", $texto);
$titulo = preg_replace('/(\'|")/', "", $titulo);
$fonte = preg_replace('/(\'|")/', "", $fonte);

		
		$exclusao='n';
	
		

		$sql="insert into curiosidades (id_curiosidades,data,texto,excluido,fonte,titulo)values(nextval('curiosidades_id_curiosidades_seq'::regclass),'$data','$texto','n','$fonte','$titulo')";
		
		$resultado= pg_query($conecta, $sql);
		$linhas= pg_affected_rows($resultado);
			
		

													
		pg_close($conecta);
		
											
											
			              
		
			
			$_SESSION['texto']=null;
			$_SESSION['titulo']=null;
			$_SESSION['fonte']=null;
			$_SESSION['data']=null;

			header("Location: editarcuriosidades.php");

			?>
											

	<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>

		<script src="../js/holder.min.js"></script>

</body>
</html>



