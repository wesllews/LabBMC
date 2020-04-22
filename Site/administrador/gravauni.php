<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset=utf-8>

</head>
<?php
		session_start();
		include "conexao.php";
function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = trim($sql); //Retira espaÃ§os em branco
	   $sql = strip_tags($sql); //Esta funÃ§Ã£o tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes estÃ¡ ativado ou nÃ£o. (On/Off) coloca / no lugar de '
	   return $sql;
	}
	
	
	
	function tiratudo($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}


	function retiraNumeros($texto){
		$texto=str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '', $texto); 
		return $texto;
	}
		$_SESSION["imguni"]=0;
		
		
		$_SESSION["certo"]=1;
		$excluido='n';
		$id_frente=$_POST['id_frente'];
		
		$_SESSION["passou"]=null;
		$unidade=$_POST['unidade'];
		$_SESSION["unidade"]=$unidade;
		$uni_inj= anti_injection($unidade);
		$uni_num=retiraNumeros($uni_inj);
		
		$dificuldade1=$_POST ['dificuldade'];
		$dificuldade= anti_injection($dificuldade1);
		
		$descricao=$_POST['descricao'];
		$desc_inj= anti_injection($descricao);
		
		
		$uni_tira=tiratudo($uni_inj);
		$uni1=strtolower($uni_tira);
		$uni=trim($uni1);
		
		if ($uni=="")
		{
			echo "<script type='text/javascript'>alert('O campo unidade não foi preenchido')</script>";
			echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrounidadeadm.php'>";
			return;
		}
		
		
		
//TESTE MESMA UNIDADE		
		$sql_unidade="select  * from  unidade";
		$resultado_unidade= pg_query($conecta, $sql_unidade);
		$qtde_unidade=pg_num_rows($resultado_unidade);
		$entrou=0;
	

			if ($qtde_unidade > 0)
			{
				
					
					while ($linha_unidade=pg_fetch_array($resultado_unidade))
					{
						//echo $linha_unidade['unidade'];
						$teste=$linha_unidade['unidade'];
						$teste_tira=tiratudo($teste);
						$teste_min1=strtolower($teste_tira);
						$teste_min=trim($teste_min1);
						
						if ($teste_min==$uni)
						{
							$entrou=1;
							echo "<script type='text/javascript'>alert('Essa unidade já existe')</script>";
							echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrounidadeadm.php'>";
							return;
						}
					}		

			}

//fim teste mesma unidade
		

		$sql3="select *from frente where id_frente=$id_frente and excluido='n'";
		$resultado3= pg_query($conecta, $sql3);
		$qtde3=pg_num_rows($resultado3);
		
		
		
		

		 
		 if ($entrou==0)
		 {
			
			if ($qtde3>0)
		 {
		
		
		$sql="insert into unidade(id_unidade,id_frente,unidade,dificuldade,descricao,excluido,dataexclusao)
			 values(
			nextval('unidade_id_unidade_seq'::regclass),
			$id_frente,
			'$uni_num',
			'$dificuldade',
			'$desc_inj',
			'$excluido',
			NULL)";
		
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				$_SESSION["unidade"]=$unidade;
				
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrarimagemuni.php'>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível gravar essa unidade')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrounidadeadm.php'>";

			}
			// Fecha a conexão com o PostgreSQL
			}
			if ($qtde3==0)
			{
				echo "<script type='text/javascript'>alert('Não existe uma frente com o ID digitado !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrounidadeadm.php'>";
			
			}
		 }
		 
	
			pg_close($conecta); 
?>
</html>