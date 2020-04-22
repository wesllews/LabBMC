<html>
<head>
	<meta charset="utf-8">
</head>
<?php 
	include "conecta.php";
	session_start();						
	
	$_SESSION["usuario"];
	
	$novasenha = $_POST['loginsenha'];
	$confsenha = $_POST['confsenha'];

	//$usuario = "biadiasbarbosa@hotmail.com";
	
	$usuario=$_SESSION["batata"];

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
				if ($_SESSION["minhaconta"]==null)
				{
				echo "<script type='text/javascript'>alert('Senha alterada com sucesso!')</script><br><br>";
				header('location: phpmailer/teste.php');
				}
				else 
				{
					$_SESSION["email"]=$usuario;
					$_SESSION["usuario"]=$usuario;
					header('location: minhaconta.php');
				}
			}

			pg_close($conecta);
			
		}
		

		
	}
	
	else{
		
		//echo "<script type='text/javascript'>alert('Operação não pode ser realizada!')</script><br><br>";
		?>
		<script type="text/javascript">alert('Email nao encontrado!')</script><br><br>
		 <meta http-equiv="refresh" content=0;url="alterarsenha.php?correto=1">
		 
		 <?php
	}

?>
	
</html>