<?php
		include "conexao.php";
		$excluido='n';
		$frente=$_POST['frente'];
		$descricao=$_POST['descricao'];
		$sql2="select *from frente where frente='$frente' and excluido='n'";
		$resultado2= pg_query($conecta, $sql2);
		$qtde=pg_num_rows($resultado2);	
		 if ($qtde>0)
		 {
			echo "<script type='text/javascript'>alert('Essa frente já existe')</script>";
			echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrofrenteadm.php'>";
		 }
		else
		{
		
		$sql="insert into frente(id_frente,frente,descricao,excluido,dataexclusao)
			 values(
			nextval('frente_id_frente_seq'::regclass),
			'$frente',
			'$descricao',
			'$excluido',
			NULL)";
		
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				echo "<script type='text/javascript'>alert('Frente gravada com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrofrenteadm.php'>";

			}
		
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível gravar essa frente')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrofrenteadm.php'>";

			}
			// Fecha a conexão com o PostgreSQL
		}
			pg_close($conecta); 
?>