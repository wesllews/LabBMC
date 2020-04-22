<?php 
session_start();
include "substituir.php";

		include "conexao.php";
				$id_questao=$_SESSION['id_questao'];
		$data=$_POST['data'];
		$excluido='n';
		$pergunta=$_POST['pergunta'];
		$pergunta=textobanco($pergunta);
		$a=$_POST['alternativaA'];
		$b=$_POST['alternativaB'];
		$c=$_POST['alternativaC'];
		$d=$_POST['alternativaD'];
		$e=$_POST['alternativaE'];
		$peso=$_POST['dificuldade'];	
		$resposta=$_POST['resposta'];
		$id_subunidade=$_POST['sub_uni'];
		$id_universidade=$_POST['universidade'];
		$dataexclu = "";
		if($resposta=='E' && $e=="")
		{
				$_SESSION['cont']=2;
					pg_close($conecta);
			header("Location: cadastrarquestao.php");
		}
		if ($data>2018 || $data==""){
			
			$_SESSION['ola']=3;
					pg_close($conecta);
			header("Location: cadastrarquestao.php");
		}
		
		else{
			
			$sql="update questao set id_universidade=$id_universidade ,
			id_subunidade=$id_subunidade,
			peso='$peso',
			pergunta='$pergunta',
			a='$a',
			b='$b',
			c='$c',
			d='$d',
			e='$e',
			resposta='$resposta',
			excluido='$excluido',
			data=$data where id_questao=$id_questao";
	
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			
			if ($linhas > 0){
				echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
			
			}
			else{
				echo "<script type='text/javascript'>alert('Erro na Gravação !!!')</script>";
			}
			
		}
				$_SESSION['id_questao']=$id_questao;

 	header('Location: ./alteraimagemquestao.php');
		pg_close($conecta);
		exit;

?>