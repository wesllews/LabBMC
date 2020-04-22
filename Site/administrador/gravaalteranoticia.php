<?php
		include "conexao.php";
	
		$id_noticia=$_GET["id_noticia"];//ID DA noticia
	
		$texto=$_POST['texto'];
		$data=$_POST['data'];
		$fonte=$_POST['fonte'];
		$titulo=$_POST['titulo'];
		$dataexclu = "";
		$sql2="select * from noticia where id_noticia='$id_noticia'";
		$resultado2= pg_query($conecta, $sql2);
		$qtde=pg_num_rows($resultado2);	
		 if ($qtde>0)
		 {
		
							
			$sql="update noticia
			 set
			 data = '$data',
			 texto = '$texto',
			 fonte = '$fonte',
			 titulo = '$titulo'
			 where id_noticia = $id_noticia";
			
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				echo "<script type='text/javascript'>alert('Conteúdo alterado com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alteranoticia.php'>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível alterar esse Conteúdo')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alteranoticia.php'>";

			}
			// Fecha a conexão com o PostgreSQL 
		 }
		
			pg_close($conecta); 
?>