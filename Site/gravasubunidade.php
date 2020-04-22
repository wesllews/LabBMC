<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		include "conexao.php";
		
	function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = trim($sql); //Retira espaÃ§os em branco
	   $sql = strip_tags($sql); //Esta funÃ§Ã£o tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes estÃ¡ ativado ou nÃ£o. (On/Off) coloca / no lugar de '
	   return $sql;
	}

		$excluido='n';
		$id_unidade=$_POST['id_unidade'];
		
		$subunidade=$_POST['subunidade'];
		$subunidade_pronto=anti_injection($subunidade);

		
		$dificuldade=$_POST['dificuldade'];
		$dificuldade_pronto=anti_injection($dificuldade);
		
		$descricao=$_POST['descricao'];
		$descricao_pronto=anti_injection($descricao);
		
		$sub=strtolower($subunidade);
		
		$sql2="select *from subunidade where LOWER (subunidade)='$sub' and excluido='n'";
		
		$resultado2= pg_query($conecta, $sql2);
		$qtde=pg_num_rows($resultado2);	
		
		
		$sql3="select *from unidade where id_unidade=$id_unidade and excluido='n'";
		$resultado3= pg_query($conecta, $sql3);
		$qtde3=pg_num_rows($resultado3);
		
		
		
		
		 if ($qtde>0)
		 {
			echo "<script type='text/javascript'>alert('Essa subunidade já existe')</script>";
			echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
		 }
		 else
		 {
		
			 if ($qtde3>0)
			{
			
			$sql="insert into subunidade(id_subunidade,id_unidade,subunidade,dificuldade,descricao,excluido,dataexclusao)
				 values(
				nextval('subunidade_id_subunidade_seq'::regclass),
				$id_unidade,
				'$subunidade_pronto',
				'$dificuldade_pronto',
				'$descricao_pronto',
				'$excluido',
				NULL)";
			
				
				$resultado=pg_query($conecta,$sql);
				$linhas=pg_affected_rows($resultado);
				if ($linhas > 0)
				{
				echo "<script type='text/javascript'>alert('Subnidade gravada com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
				}
				else
				{
					echo "<script type='text/javascript'>alert('Não foi possível gravar essa unidade')</script>";
					echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";

				}
				// Fecha a conexão com o PostgreSQL
			}
			if ($qtde3==0)
			{
				echo "<script type='text/javascript'>alert('Não existe uma unidade com o ID digitado !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
				
			}
		 }
	
			pg_close($conecta); 
}
?>