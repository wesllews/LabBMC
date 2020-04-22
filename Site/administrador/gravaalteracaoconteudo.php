<?php
		session_start();	
		include "conexao.php";
	
		$id=$_SESSION["id"];//ID DA SUBUNIDADE
	
		$excluido='n';
		$id_subunidade=$_POST['id_subunidade'];
		$texto=$_POST['texto'];
		$data = date('Y-m-d H:i');
		$sql2="select *from subunidade where id_subunidade='$id_subunidade'";
		$resultado2= pg_query($conecta, $sql2);
		$qtde=pg_num_rows($resultado2);	
		 if ($qtde>0)
		 {
		
				
			$sql="update conteudo
			 set
			 id_subunidade = '$id_subunidade',
			 texto = '$texto',
			 
			 data = '$data'
			 where id_conteudo = $id";
			
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				echo "<script type='text/javascript'>alert('Conteúdo alterado com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alteraconteudo.php'>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível alterar esse Conteúdo')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alteraconteudo.php'>";

			}
			// Fecha a conexão com o PostgreSQL 
		 }
		
			pg_close($conecta); 
?>