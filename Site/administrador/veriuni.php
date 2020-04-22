
	<?php
		include "conexao.php";
	session_start();
	$_SESSION['cont']=0;

	$id=$_SESSION['id_uni'];
		$nomeuni= $_POST["nomeuni"];
		$nomemin=strtolower($nomeuni);

		
		$sigla = $_POST["sigla"];
		$sigla=strtoupper($sigla);
		

		$sql="select id_universidade from universidade where LOWER(nome)='$nomemin' and id!='$id'";
		$resultado= pg_query($conecta, $sql);
		$qtde=pg_num_rows($resultado);
		if ($qtde > 0)
		{
			$_SESSION['cont']=2;
					pg_close($conecta);
			header("Location: alterauni.php");
		}
		else
		{

		
		$sql1="update universidade set 
		nome='$nomeuni',
		sigla='$sigla'
		where id_universidade = '$id'";

		$resultado1= pg_query($conecta, $sql1);
		$linhas1= pg_affected_rows($resultado1);

						
		pg_close($conecta);
		
								

			header("Location: menuni.php?id=$id");

		}
			?>
		

											

	<script src="../js/jquery.min.js"></script>




