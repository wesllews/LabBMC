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
	
	
		
	function tiratudo($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function retiraNumeros($texto){
		$texto=str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '', $texto); 
		return $texto;
}

		$excluido='n';
		$id_unidade=$_POST['id_unidade'];
		
		$subunidade1=$_POST['subunidade'];
		$subunidade=anti_injection($subunidade1);
		$sub_tira=tiratudo($subunidade);
		$sub_num= retiraNumeros($subunidade);
		
		$dificuldade1=$_POST['dificuldade'];
		$dificuldade=anti_injection($dificuldade1);

		
		
		$descricao1=$_POST['descricao'];
		$descricao=anti_injection($descricao1);
	

		$sub=strtolower($sub_tira);
		$sub2=trim($sub);
		
		
		
//TESTE MESMA SUBUNIDADE		
		$sql_subunidade="select  * from  subunidade";
		$resultado_subunidade= pg_query($conecta, $sql_subunidade);
		$qtde_subunidade=pg_num_rows($resultado_subunidade);
		$entrou=0;
	

			if ($qtde_subunidade > 0)
			{
				
					
					while ($linha_subunidade=pg_fetch_array($resultado_subunidade))
					{
						//echo $linha_unidade['unidade'];
						$teste=$linha_subunidade['subunidade'];
						$teste_tira=tiratudo($teste);
						$teste_min1=strtolower($teste_tira);
						$teste_min=trim($teste_min1);
						
						if ($teste_min==$sub2)
						{
							//echo $teste_min." - Sub: ".$sub2;
							$entrou=1;
							echo "<script type='text/javascript'>alert('Essa subunidade já existe')</script>";
							echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
							return;
						}
					}		

			}

//fim teste mesma subunidade		
		

		
		/*$sql2="select *from subunidade where LOWER (subunidade)='$sub' and excluido='n'";
		
		$resultado2= pg_query($conecta, $sql2);
		$qtde=pg_num_rows($resultado2);	
		*/
		
		$sql3="select *from unidade where id_unidade=$id_unidade and excluido='n'";
		$resultado3= pg_query($conecta, $sql3);
		$qtde3=pg_num_rows($resultado3);
		
		
		
		
		 /*if ($qtde>0)
		 {
			echo "<script type='text/javascript'>alert('Essa subunidade já existe')</script>";
			echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
		 }*/
		 if ($entrou==0)
		 {
		
			 if ($qtde3>0)
			{
			
			$sql="insert into subunidade(id_subunidade,id_unidade,subunidade,dificuldade,descricao,excluido,dataexclusao)
				 values(
				nextval('subunidade_id_subunidade_seq'::regclass),
				$id_unidade,
				'$sub_num',
				'$dificuldade',
				'$descricao',
				'$excluido',
				NULL)";
			
				
				$resultado=pg_query($conecta,$sql);
				$linhas=pg_affected_rows($resultado);
				if ($linhas > 0)
				{
				//echo "<script type='text/javascript'>alert('Subnidade gravada com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
				}
				else
				{
					echo "<script type='text/javascript'>alert('Não foi possível gravar essa subunidade')</script>";
					echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";

				}
				// Fecha a conexão com o PostgreSQL
			}
			if ($qtde3==0)
			{
				//echo "<script type='text/javascript'>alert('Não existe uma unidade com o ID selecionado !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrosubunidade.php'>";
				
			}
		 }
	
			pg_close($conecta); 
}
?>