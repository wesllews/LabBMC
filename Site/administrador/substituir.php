<?php

function textobanco($texto)
{
	include "conexao.php";
	$texto_Sem_Injection=addslashes($texto);
	$texto_Sem_Injection_Com_Enter = str_replace(chr(13),"###" , $texto_Sem_Injection);
	return $texto_Sem_Injection_Com_Enter;
}

function textoinput($tabela,$nomeid,$campo,$id){
	include "conexao.php";
	$sql= "SELECT REPLACE($campo,'###','".chr(13)."') AS texto FROM $tabela where $nomeid=$id";
	$resultado=pg_query($conecta,$sql);
	$qtde=pg_num_rows($resultado);
	if($qtde>0)
	{
		$linha=pg_fetch_array($resultado);
		return $linha[0];
	}
	else {return "error";}
}

function textohtml($tabela,$nomeid,$campo,$id){
	include "conexao.php";
	$sql= "SELECT REPLACE($campo,'###','</p><p>') AS $campo FROM $tabela where $nomeid=$id";
	$resultado=pg_query($conecta,$sql);
	$qtde=pg_num_rows($resultado);
	if($qtde>0)
	{
		$linha=pg_fetch_array($resultado);
		return $linha[0];
	}
	else {return "error";}
}
function textohtml2($texto){
		$texto2=str_replace("###","</p><p>" ,$texto);
		return $texto2;
}

function textoinput2($texto){
	include "conexao.php";
	$sql= "SELECT REPLACE('$texto','###','".chr(13)."')";
	$resultado=pg_query($conecta,$sql);
	$qtde=pg_num_rows($resultado);
	if($qtde>0)
	{
		$linha=pg_fetch_array($resultado);
		return $linha[0];
	}
	else {return "error";}
}

function limitarTexto($texto, $limite){
  $contador = strlen($texto);
  if ( $contador >= $limite ) {      
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . ' ...';
      return $texto;
  }
  else{
    return $texto;
  }
} 
function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = strip_tags($sql); //Esta função tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes está ativado ou não. (On/Off) coloca / no lugar de 
	   return $sql;
	}

?>