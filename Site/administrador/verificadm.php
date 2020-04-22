<?php
include "conexao.php";
session_start();
if(isset($_POST['email']))
	
	{ 
	$email1 = $_POST['email'];
		$email=strtolower($email1);


	$sqlemail="SELECT email FROM login WHERE email = '$email' and excluido = 'n'";
	$resultadoemail= pg_query($conecta, $sqlemail);
	$total=pg_num_rows($resultadoemail);
	
	$linha = pg_fetch_array($resultadoemail);
$_SESSION['correto']=0;
	if($total>0)
	{
		$_SESSION['correto']=2;
		 ?>
		
		<meta http-equiv="refresh" content=0;url="cadastradm.php">
		 
		 <?php
	}
	else 
	{	
		$_SESSION['emailadm']=$email;
 
		header("Location: cadastroadm.php");
	}
	}
		?>
		
		
		

		