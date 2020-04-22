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
		$_SESSION['corretoadm']=null;
	if($total>0)
	{
		$_SESSION['corretoadm']=2;
		 ?>
		
		<meta http-equiv="refresh" content=0;url="cadastraradmnormal.php">
		 
		 <?php
	}
	else 
	{	
		$_SESSION['emailusuadm']=$email;
		header("Location: cadastrarusuarioadm.php");
	}
	}
		?>
		
		
		

		