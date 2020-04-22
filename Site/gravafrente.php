<?php
		include "conexao.php";
		$excluido='n';
		$frente=$_POST['frente'];
		$id_frente=9;
		$descricao=$_POST['descricao'];
		$dataexclu = " ";
		
		$sql="insert into frente(id_frente,frente,descricao,excluido,dataexclusao)
			 values(
			nextval('frente_id_frente_seq'::regclass),
			'$frente',
			'$descricao',
			'$excluido',
			'$dataexclu')";
			echo $sql;
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
		
			else
			echo "<script type='text/javascript'>alert('Batata')</script>";
			// Fecha a conexão com o PostgreSQL
			pg_close($conecta); 
?>