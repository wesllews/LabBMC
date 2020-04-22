<?php 
	include "conexao.php";
	include "substituir.php";
	include "hashimagem.php";

	session_start();	
	
	//funcoes
	function anti_injection_adaptado($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = strip_tags($sql); //Esta função tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes está ativado ou não. (On/Off) coloca / no lugar de '
	   return $sql;
	}

	function retiraNumeros($texto){
		$texto=str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '', $texto); 
		return $texto;
	}

	$correto=0;

	//variaveis - post

	$idslide=$_POST['idslide'];
	$finalizar=$_POST['botao'];
	if($idslide==1){
		$subunidade = strtolower($_POST['subunidade']);
		?>
		
		<script>alert("asuahushauhsu");</script>
		
		<?php
		$_SESSION["subunidadehope"] = $subunidade;
		//echo $subunidade;
	}
	//else if($finalizar==1){
	//	$subunidade = strtolower($_POST['subunidadehidden']);
	//}	
	else{
		$subunidade = strtolower($_POST['subunidadehidden']);
		$_SESSION["subunidadehope"] = $subunidade;
	}

	$subunidade=str_replace("_" , chr(32), $subunidade);

	$tabela=$_POST['tabela'];

	$id=$_POST['id'];

	$type="image/png,image/jpeg,image/jpg";

	if($_POST["gif"] && $_POST["gif"]=="s")
	$type.=",image/gif";
	else
	$gif="n";

/*
	if($_POST['nome'])
	$nome=$_POST['nome'];
	else
	$nome=$_POST['tabela'];*/

	$nome=retornaHash();

	if($_POST['pasta'])
	$pasta=$_POST['pasta'];
	else
	$pasta="/hope/tcc/img";

	$target_file = $pasta . basename($_FILES['arquivo']['name']);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$target_file = $pasta.$nome.".".$imageFileType;
	$nome_apagar=$pasta.$nome.".";


//	echo "<br><br>".$imageFileType;
//	echo "<br><br>".$target_file;

	$layout = $_POST['layout'];
	$titulo = $_POST['titulo'];
	$conteudo= $_POST['conteudo'];

	//validacao back-end
	$titulo = anti_injection_adaptado($titulo);
	$conteudo= anti_injection_adaptado($conteudo);
	$subunidade=anti_injection_adaptado($subunidade);
	$subunidade=retiraNumeros($subunidade);
	
	$_SESSION['subunidadehope']=$subunidade;

	$conteudo=textobanco($conteudo);
	
	if ($conteudo=="" || $subunidade=="" || $titulo=="" )
	{
		
		if ($finalizar==1)
		{
		header('location: cadastrarconteudo.php');
		$_SESSION['correto']=1;
		$_SESSION['idslide']=$idslide;
		return;
		}
		else if ($finalizar==2)
		{
			header('location: index.php');
		}
		else
		{
			header('location: cadastrarconteudo.php');
			$_SESSION['correto']=1;
			$_SESSION['idslide']=$idslide;
			return;
			
		}
	}

	

	echo $titulo;
	echo "<br><br><br>".$conteudo;
	//$imagem = $_POST['imagem'];
    $excluido='n';
    $data=date("d/m/Y");
    $dataexclusao=null;
    $imagem=null;



	//funcionalidades do sistema
	//select 
    $sql="SELECT id_subunidade FROM subunidade WHERE lower(subunidade) = '$subunidade' and excluido = 'n'";
	//echo $sql."sub".$subunidadefinal;

	$resultado= pg_query($conecta, $sql);
	$total=pg_num_rows($resultado);
	
	$linha = pg_fetch_array($resultado);

	//echo $sql;

	if($total > 0 && $finalizar==1 || $total > 0 && $finalizar==0)
	{	
		
		$idsubunidade=$linha['id_subunidade'];

		if($idslide==1){
		//testar se a subunidade já tem slides, se sim avisar para o usuário usar a página de alteração de conteúdo

			$sqlsub="SELECT id_subunidade FROM conteudo";
			echo $sqlsub;

			$resultadosub= pg_query($conecta, $sqlsub);
			$totalsub=pg_num_rows($resultadosub);

			while($linhasub = pg_fetch_array($resultadosub)){
				if($linhasub['id_subunidade']==$idsubunidade){
					$correto=2;//subunidades iguais

				}
			}
			$_SESSION['coreto']=$correto;

		}
	
		if($correto!=2)
		{
			
		$sqlconteudo="insert into conteudo values(nextval('conteudo_id_conteudo_seq'::regclass),$idsubunidade,'$conteudo','$data','$excluido',NULL,$idslide,
		NULL,'$titulo',$layout)";
		//echo "<br>SQL: ".$sqlconteudo;
		$resultadoconteudo=pg_query($conecta,$sqlconteudo);
		$linhasconteudo=pg_affected_rows($resultadoconteudo);
		
		$idslide++;
		$_SESSION['idslide']=$idslide;
		//echo "<br>ID: ".$idslide;

		if ($linhasconteudo > 0)//se deu certo
		{
			
			//cadastrarfoto
		
			// Check if file already exists
			if (file_exists($target_file)) {
				unlink($target_file);
				header($_SERVER['PHP_SELF']);
			}
			// Check file size
			if ($_FILES["arquivo"]["size"] > 500000) {
				echo "<script>alert('A imagem excede o tamanho ideal');</script>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Desculpe, apenas os formatos JPG, JPEG, PNG e GIF sÃ£o permitidos";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Desculpe, nÃ£o foi possÃ­vel cadastrar a imagem.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
					echo "O arquivo ".$nome."-$pasta". " foi enviado com sucesso!";
					//atualizar bd
					$sql="update conteudo set imagem='$target_file'	where id_conteudo = $id";

					$resultado=pg_query($conecta,$sql);
					$linhas=pg_affected_rows($resultado);
					if($linhas<0)
					{
						echo "<script>alert('Desculpe, tivemos um problema com o Banco de Dados. Tente Mais Tarde');  </script>";
					}
					else
					{
						//cadastrado com sucesso
					}


				} else {
					echo $_FILES['userfile']['error'];
					echo "Desculpe, não foi possível cadastrar sua imagem.";
				}
			}

			$subunidade=str_replace(chr(32), "_", $subunidade);

			if($finalizar!=1 && $finalizar!=2)
			{
				header('location: cadastrarconteudo.php');
			}	
			
			else
			{
				header('location: index.php');
			}
		}
		else{
			//se deu merda
			header('location: index.php');
		}
		}
		else{
			$subunidade=str_replace(chr(32), "_", $subunidade);
			$_SESSION['correto']=$correto;
			
			header('location: cadastrarconteudo.php');
			
		}
    }
    else{
		if($finalizar==2){
			//unset($_SESSION["subunidadehope"]);
			unset($_SESSION['idslide']);
			header('location:index.php');
		}
		else{
			$correto=1;
						$subunidade=str_replace(chr(32), "_", $subunidade);
			$_SESSION['correto']=$correto;
			
			header('location: cadastrarconteudo.php');
			
		}

    }
		

?>