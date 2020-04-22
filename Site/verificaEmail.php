<?php
include "conecta.php";
	 session_start();
if(isset($_POST['email']))
	
	{ 
	$email1 = $_POST['email'];
		$email=strtolower($email1);
	
	
	function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = trim($sql); //Retira espaços em branco
	   $sql = strip_tags($sql); //Esta função tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes está ativado ou não. (On/Off) coloca / no lugar de '
	   return $sql;
	}
	
	
	$email=anti_injection($email);
	

	$sqlemail="SELECT email FROM login WHERE email = '$email' and excluido = 'n'";
	$resultadoemail= pg_query($conecta, $sqlemail);
	$total=pg_num_rows($resultadoemail);
	
	$linha = pg_fetch_array($resultadoemail);

	if($total>0)
	{
		$_SESSION["errado"]="2";

		 ?>
		
		<meta http-equiv="refresh" content=0;url="cadastrar.php">
		 
		 <?php
	}
	else 
	{	
		$_SESSION["emailcadastro"]=$email;
		header("Location: cadastro.php");
	}
	}
		?>
		
		
		

		