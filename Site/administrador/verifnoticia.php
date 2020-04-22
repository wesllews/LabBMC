<?php
session_start();
include "substituir.php";
include "conexao.php";

$excluido='n';
$id = $_POST['id_noticia'];
$pagina=$_POST['pagina'];
$texto=$_POST['texto'];
$data=$_POST['data'];
$fonte=$_POST['fonte'];
$titulo=$_POST['titulo'];
$acao=$_POST['acao'];


if($pagina == 'cadastra'){
	$_SESSION['noticia_texto'] = $texto;
	$_SESSION['noticia_data'] = $data;
	$_SESSION['noticia_fonte'] = $fonte;
	$_SESSION['noticia_titulo'] = $titulo;
}
else{
	$_SESSION['id_noticia'] = $id;
}
$dataexclu = "";

$texto_pronto = textobanco($texto);
$fonte_pronto = textobanco($fonte);
$titulo_pronto = textobanco($titulo);

$titulo_repete = mb_strtoupper($titulo_pronto);
$texto_repete = mb_strtoupper($texto_pronto);

if($acao=='update' || $acao=='restaurar')
	$sql1="select * from noticia where upper(titulo) = '$titulo_repete' and excluido = 'n' and id_noticia<>$id";
else if($acao=='incluir')
	$sql1="select * from noticia where upper(titulo) = '$titulo_repete' and excluido = 'n'";
$resultado=pg_query($conecta,$sql1);
$qtde1=pg_num_rows($resultado);
$linha1=pg_fetch_array($resultado);
$id1 = $linha1['id_noticia'];

if($acao=='update' || $acao=='restaurar')
	$sql2="select * from noticia where upper(texto) = '$texto_repete' and excluido = 'n' and id_noticia<>$id";
else if($acao=='incluir')
	$sql2="select * from noticia where upper(texto) = '$texto_repete' and excluido = 'n'";
$resultado=pg_query($conecta,$sql2);
$qtde2=pg_num_rows($resultado);
$linha2=pg_fetch_array($resultado);
$id2 = $linha2['id_noticia'];

if($acao=='delete'){		
		$data = date("Y-m-d");
		$sql="update noticia set excluido='s', dataexclusao='$data' where id_noticia=$id";
		$resultado=pg_query($conecta,$sql);
		$linhas=pg_affected_rows($resultado);
		
		if ($linhas > 0){
			echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
			header("location: listanoticias.php");
			exit;
		}
		else{
			echo "<script type='text/javascript'>alert('Erro na alteração!')</script>";
			$_SESSION['id_noticia'] = $id;
			header("location:./editarnoticia.php");
			exit;
		}
	}

	else if($qtde1>0){ //titulo igual
		$_SESSION['noticia_problema'] = 'titulo';
		$_SESSION['id_noticia_problema'] = $id1;
		if($pagina=='cadastra'){
			header('Location: ./cadastrarnoticia.php');
			exit();
		}
		elseif($pagina=='edita'){
			header('Location: ./editarnoticia.php');
			exit();
		}
	}
	else if($qtde2>0){ //texto igual
		$_SESSION['noticia_problema'] = 'texto';
		$_SESSION['id_noticia_problema'] = $id2;
		if($pagina=='cadastra'){
			header('Location: ./cadastrarnoticia.php');
			exit();
		}
		elseif($pagina=='edita'){
			header('Location: ./editarnoticia.php');
			exit();
		}
	}
	else if(empty($_POST['titulo']) || strlen(trim($_POST['titulo']))==0 ||
		empty($_POST['texto']) || strlen(trim($_POST['texto']))==0 ||
		empty($_POST['data']) || strlen(trim($_POST['data']))==0 ||
		empty($_POST['fonte']) || strlen(trim($_POST['fonte']))==0){
		
		$_SESSION['noticia_problema'] = 'texto_branco';
	if($pagina=='cadastra'){
		header('Location: ./cadastrarnoticia.php');
		exit;
	}
	elseif($pagina=='edita'){
		header('Location: ./editarnoticia.php');
		exit;
	}
}
else if($acao=='incluir'){
	$sql="insert into noticia(data,texto,fonte,excluido,titulo)
	values(
	'$data',
	'$texto_pronto',
	'$fonte_pronto',
	'$excluido',
	'$titulo_pronto')";

	$resultado=pg_query($conecta,$sql);
	$linhas=pg_affected_rows($resultado);
	if ($linhas > 0)
		echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
	else
		echo "<script type='text/javascript'>alert('Não foi possível cadastrar a noticia !!!')</script>";
	$sql="SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 1";
	$resultado = pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	if ($qtde > 0)
	{
		$linha=pg_fetch_array($resultado);
			//pegar o resultado e colocar na session:
		$_SESSION['id_noticia']=$linha['id_noticia'];
	}

	unset($_SESSION['noticia_titulo']);
	unset($_SESSION['noticia_texto']);
	unset($_SESSION['noticia_data']);
	unset($_SESSION['noticia_fonte']);
	header('Location: ./cadastroimagemnoticia.php');
	exit;
}
else if($acao=='update'){
	$sql="update noticia set data='".$data."', texto='".$texto_pronto."', fonte='".$fonte_pronto."', titulo='".$titulo_pronto."' where id_noticia=".$id."";	
	$resultado=pg_query($conecta,$sql);
	$linhas=pg_affected_rows($resultado);
	$_SESSION['id_noticia'] = $id;
	if ($linhas > 0){
		echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
		header("location: alteraimagemnoticia.php");
		exit;
	}
	else{
		echo "<script type='text/javascript'>alert('Erro na alteração!')</script>";
		header("location:./editarnoticia.php");
		exit;
	}
}
else if ($acao == 'restaurar'){
	$sql="update noticia set excluido='n' where id_noticia=$id";
	$resultado=pg_query($conecta,$sql);
	$linhas=pg_affected_rows($resultado);
	$_SESSION['id_noticia'] = $id;
	header("location:./editarnoticia.php");
	exit;
		//header("location:./listanoticias.php");
}

pg_close($conecta);
exit;
?>