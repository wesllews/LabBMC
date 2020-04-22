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
	
		$mesmauni=0;
		$entrou=0;
		
		$excluido='n';

		$id=$_SESSION["id_unidade"];
		$_SESSION["valorid"]=$id;
		$_SESSION["idaqui"]=1;
		$id_frente= $_POST['id_frente'];
		
		$unidade=$_POST['unidade'];
		$unidade_pronto=anti_injection($unidade);
		$unidade_pronto2=retiraNumeros($unidade_pronto);
		
		$_SESSION["unidade"]=$unidade_pronto2;
		
		$descricao=$_POST['descricao'];
		$descricao_pronto=anti_injection($descricao);
		
		$uni1=tiratudo($unidade_pronto);
		$uni=strtolower($uni1);
		
	
//TESTE SE O NOME DA UNIDADE INSERIDA É O MESMO QUE O ANTERIOR
		$sql_uni="select  * from  unidade where id_unidade=".$id;
		$resultado_uni= pg_query($conecta, $sql_uni);
		$qtde_uni=pg_num_rows($resultado_uni);
	
	

if ($qtde_uni > 0)
{
				
					
					while ($linha_uni=pg_fetch_array($resultado_uni))
					{
						$teste2=$linha_uni['id_unidade'];
						$teste=$linha_uni['unidade'];
						$teste_tira=tiratudo($teste);
						$teste_min1=strtolower($teste_tira);
						$teste_min=trim($teste_min1);
						
						if ($teste_min==$uni && $id==$teste2)
						{
							$entrou=0;
							$mesmauni=1;
							
						}
					}		

}




//TESTE MESMA UNIDADE QUANDO ALTERADA	
if ($mesmauni==0)
{

	
			$sql_unidade="select  * from  unidade";
			$resultado_unidade= pg_query($conecta, $sql_unidade);
			$qtde_unidade=pg_num_rows($resultado_unidade);
			
		

	if ($qtde_unidade > 0)
	{
					
						
						while ($linha_unidade=pg_fetch_array($resultado_unidade))
						{
							//echo $linha_unidade['unidade'];
							$teste=$linha_unidade['unidade'];
							$teste_tira=tiratudo($teste);
							$teste_min1=strtolower($teste_tira);
							$teste_min=trim($teste_min1);
							
							if ($teste_min==$uni )
							{
								$entrou=1;
								echo "<script type='text/javascript'>alert('Essa unidade já existe')</script>";
								echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=menualteraunidade.php'>";
								return;
							}
						}		

	}



} 
//fim teste mesma unidade	
		
		
		
		
if ($entrou==0)
{
	
			
			$sql="update unidade
			 set
			 id_frente = $id_frente,
			 unidade = '$unidade_pronto2',
			 descricao = '$descricao_pronto'
			 where id_unidade = $id";
		
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				//echo "<script type='text/javascript'>alert('Unidade alterada com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=menualteraunidade.php'>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível alterar essa unidade')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=menualteraunidade.php'>";

			}
		
		
			// Fecha a conexão com o PostgreSQL
}			
		
			pg_close($conecta); 
?>