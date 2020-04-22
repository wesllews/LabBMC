<?php 
session_start();
include "conexao.php";
$id=$_SESSION['id_questao'];
$data = date('Y-m-d');
$sql="update questao set excluido='s', dataexclusao='$data' where id_questao=$id";
$resultado=pg_query($conecta,$sql);
$linhas=pg_affected_rows($resultado);
	if ($linhas > 0){
		echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";		
}
else{
	echo "<script type='text/javascript'>alert('Erro na Gravação !!!')</script>";
	}
		pg_close($conecta);
		header('Location: ./menuquestoes.php');

		exit;
?>