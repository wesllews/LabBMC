<?php
		session_start();	
		include "conexao.php";
	
		$id=$_SESSION["id"];//ID DA SUBUNIDADE
	
		$excluido='n';
		$frente=$_POST['frente'];
		$descricao=$_POST['descricao'];
		
				
			$sql="update frente
			 set
			 frente = '$frente',
			 descricao = '$descricao'
			 where id_frente = $id";
			
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				echo "<script type='text/javascript'>alert('Frente alterada com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alterafrente.php'>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível alterar essa Frente')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alterafrente.php'>";

			}
			// Fecha a conexão com o PostgreSQL 
		
		
			pg_close($conecta); 
?>