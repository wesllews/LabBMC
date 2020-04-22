<?php
include "conexao.php";
	session_start();

		$titulo1 = $_POST['titulo'];
		$titulo2 = strtolower($titulo1);
		$titulo22=trim($titulo2);
		$texto=$_POST['texto'];
		$exclusao='n';
		$data=$_POST['data_texto'];
		$fonte=$_POST['fonte'];
		
		$_SESSION['texto']=$texto;
		$_SESSION['titulo']=$titulo1;
		$_SESSION['fonte']=$fonte;
		$_SESSION['data']=$data;
		
		$id=$_SESSION["id"];
		
		

	$sql="SELECT titulo FROM curiosidades WHERE lower(titulo) = '$titulo22' and id_curiosidades!='$id'";
	$resultado= pg_query($conecta, $sql);
	$total=pg_num_rows($resultado);
	
	$linha = pg_fetch_array($resultado);

	if($total>0)
	{
		$_SESSION['correto']=2;
		$_SESSION['id_cur']=$id;
		
		 ?>
		
		<meta http-equiv="refresh" content=0;url="edicaocuriosidade.php">
		 
		 <?php
	}
	else 
	{	
		header("Location: verificaeditacuriosidade.php");
	}
	
		?>
		
		
		

		