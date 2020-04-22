<?php 
	include "conecta.php";
	session_start();						
	$_SESSION["usuario"] = $_POST["email"];
	$_SESSION["senha"] = $_POST["senha"];
	$_SESSION["correto"];

	$usuario = $_POST['email'];
	$senha = $_POST['senha'];
	
	function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = trim($sql); //Retira espaços em branco
	   $sql = strip_tags($sql); //Esta função tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes está ativado ou não. (On/Off) coloca / no lugar de '
	   return $sql;
	}
			
	$usuario=anti_injection($usuario);
	$senha=anti_injection($senha);
	$senha=md5($senha);
	$usuario= strtolower($usuario);
			
	$sql="SELECT email FROM login WHERE email = '$usuario' and excluido = 'n'";
	
	$resultado= pg_query($conecta, $sql);
	$total=pg_num_rows($resultado);
	
	$linha = pg_fetch_array($resultado);

	if($total > 0 )
	{
		$email=$linha[email];
		
		
		$sql="SELECT * FROM login WHERE email = '$email' and senha = '$senha'";
		$resultado= pg_query($conecta, $sql);
		$total=pg_num_rows($resultado);
	
		$linha = pg_fetch_array($resultado);
		$adm=$linha[adm];
		$_SESSION['adm']=$adm;
		
		if($total > 0 ){
			$_SESSION["logou"] = "s";
			
			$sql2="SELECT * FROM cadastro WHERE email = '$email'";
			$resultado2= pg_query($conecta, $sql2);
			$total2=pg_num_rows($resultado2);
			$linha2 = pg_fetch_array($resultado2);
			$nome=$linha2[nome];
			$_SESSION["nome"]=$nome;
			
			if($adm=='n'){
				session_destroy($_SESSION['correto']);
				
				if (isset($_SESSION['pagina_antes_login'])){
					header("Location: ".$_SESSION['pagina_antes_login']);
					session_destroy($_SESSION['pagina_antes_login']);
				}
				else				
					header('location:minhaconta.php');
			}
			else{
				session_destroy($_SESSION['correto']);
				header('location:administrador/index.php');
			}
		}
		else{
			
		?>
		
		 <meta http-equiv="refresh" content=0;url="login.php">
		 
		 <?php
		 $_SESSION['correto']=2;
		}

		
	}
	else{
		
		?>
		 <meta http-equiv="refresh" content=0;url="login.php">
		 
		 <?php
		  $_SESSION['correto']=1;
	}
	
	
	?>
	
