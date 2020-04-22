<?php
include "conexao.php";
if(isset($_POST['email']))
	
{ 
	$email1 = $_POST['email'];
		$email=strtolower($email1);


	$sqlemail="SELECT email FROM login WHERE email = '$email' and excluido = 'n' ";
	$resultadoemail= pg_query($conecta, $sqlemail);
	$total=pg_num_rows($resultadoemail);
	
	$linha = pg_fetch_array($resultadoemail);

	if($total>0)
	{

		 echo "<script type='text/javascript'>alert('Esse email já existe')</script>";
		echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastraradm.php'>";
	
	}
}
	
	
		$excluido='n';
		$senha=$_POST['senha'];
		$senha=md5($senha);

		$adm='s';
		
		
		$sql="insert into login(email,senha,adm,excluido,dataexclusao)
			 values(
			'$email',
			'$senha',
			'$adm',
			'$excluido',
			NULL)";
		
			
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			if ($linhas > 0)
			{
				echo "<script type='text/javascript'>alert('Administrador gravado com sucesso !!!')</script>";
				echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastraradm.php'>";
			}
		
			else
			echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastraradm.php'>";
			// Fecha a conexão com o PostgreSQL
		
			pg_close($conecta);

		?>
		
		
		

		