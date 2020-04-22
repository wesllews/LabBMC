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
		$_SESSION["passousub"]=1;
		$excluido='n';
		$id=$_SESSION["id"];//ID DA SUBUNIDADE
	
		$excluido='n';
		$id_unidade=$_POST['id_unidade'];
	
		$subunidade=$_POST['subunidade'];
		$subunidade_pronto=anti_injection($subunidade);
		$subunidade_pronto2=retiraNumeros($subunidade_pronto);
		
		$dificuldade=$_POST['dificuldade'];
		$dificuldade_pronto=anti_injection($dificuldade);
		
		$descricao=$_POST['descricao'];
		$descricao_pronto=anti_injection($descricao);
		

		
		$sub1=tiratudo($subunidade_pronto);
		$sub=strtolower($sub1);
		//echo "Subunidadade: ".$sub."<br>";
		
		
//TESTE SE O NOME DA UNIDADE INSERIDA É O MESMO QUE O ANTERIOR
		$sql_uni="select  * from  subunidade where id_subunidade=".$id;
		
		$resultado_uni= pg_query($conecta, $sql_uni);
		$qtde_uni=pg_num_rows($resultado_uni);
	
	

if ($qtde_uni > 0)
{
				
					
					while ($linha_uni=pg_fetch_array($resultado_uni))
					{
						$teste2=$linha_uni['id_subunidade'];
						$teste=$linha_uni['subunidade'];
						$teste_tira=tiratudo($teste);
						$teste_min1=strtolower($teste_tira);
						$teste_min=trim($teste_min1);
						
						if ($teste_min==$sub && $id==$teste2)
						{
							$entrou=0;
							$mesmauni=1;
							
						}
					}		

}


if ($mesmauni==0)
{

		
//TESTE SE SUBUNIDADE JÁ FOI GRAVADA NO BANCO (se já existe)		
		$sql_subunidade="select  * from  subunidade";
		
		$resultado_subunidade= pg_query($conecta, $sql_subunidade);
		$qtde_subunidade=pg_num_rows($resultado_subunidade);
		$entrou=0;
	

if ($qtde_subunidade > 0)
{
				
					
					while ($linha_subunidade=pg_fetch_array($resultado_subunidade))
					{
						//echo $linha_subunidade['SUBunidade'];
						$teste=$linha_subunidade['subunidade'];
						$teste_tira=tiratudo($teste);
						$teste_min1=strtolower($teste_tira);
						$teste_min=trim($teste_min1);
					
						if ($teste_min==$sub)
						{
							$entrou=1;
							echo "<script type='text/javascript'>alert('Essa subunidade já existe')</script>";
							echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=submenualterasub.php'>";
							return;
						}
					}		

}
}
//fim teste mesma unidade


		
if ($entrou==0)
{
		
		
			
			$sql="update subunidade
			 set
			 id_unidade = $id_unidade,
			 subunidade = '$subunidade_pronto2',
			 dificuldade = '$dificuldade_pronto',
			 descricao = '$descricao_pronto'
			 where id_subunidade = $id";
		
		
		
		
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				//echo "<script type='text/javascript'>alert('Subnidade alterada com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=submenualterasub.php'>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Não foi possível alterar essa subunidade')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=submenualterasub.php'>";

			}
			// Fecha a conexão com o PostgreSQL
		}
		
			pg_close($conecta); 
?>