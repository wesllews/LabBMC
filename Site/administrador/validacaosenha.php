<html>
<head>
	<meta charset="utf-8">
</head>
<?php 
	include "conexao.php";
	session_start();
			if($_SESSION['adm']!='s')
 header("Location: /hope/tcc/login.php");						
	$altera=$_SESSION["altera"];
	$novasenha = $_POST['loginsenha'];
	$confsenha = $_POST['confsenha'];


	
	if($altera==null)
	{
		$usuario=$_SESSION["usuario"];
	}
	else
	{
		$usuario=$_SESSION["altera"];
	}
	
			
				
	$novasenha = $_POST['loginsenha'];
	$confsenha = $_POST['confsenha'];




	function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = trim($sql); //Retira espaços em branco
	   $sql = strip_tags($sql); //Esta função tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes está ativado ou não. (On/Off) coloca / no lugar de '
	   return $sql;
	}
	
	
	$novasenha=anti_injection($novasenha);
	$confsenha=anti_injection($confsenha);
	
	
	$novasenha=md5($novasenha);
	$confsenha=md5($confsenha);
	$sql="SELECT * FROM login WHERE email = '$usuario'  and excluido = 'n'";
	
	
	$resultado= pg_query($conecta, $sql);
	$total=pg_num_rows($resultado);
	

	if($total > 0 )
	{
		
		if ($novasenha==$confsenha)
		{
			
			$sql2="update login set senha='$novasenha'  where email = '$usuario'  and excluido = 'n'";
			
			$resultado2=pg_query($conecta,$sql2);
			if($resultado2>0)
			{
				echo "<script type='text/javascript'>alert('Usuário alterado com sucesso!')</script><br><br>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=minhaconta.php'>";
			}

			pg_close($conecta);
			
		}
		

		
	}
	
	else{
		
		echo "<script type='text/javascript'>alert('Operação não pode ser realizada!')</script><br><br>";
		?>
		 <meta http-equiv="refresh" content=0;url="alterarsenha.php?correto=1">
		 
		 <?php
	}


?>
	
</html>