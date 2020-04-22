<?php
include "conexao.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$acao=$_POST['acao'];
	$nome = $_POST['nome_img'];
	$imagem='../img/questao/'.$nome.'.jpg';
	
	if($acao=='apagar'){
		echo $imagem;
		if (file_exists($imagem)) {
			unlink($imagem);
			header('Location: ./menuquestoes.php');
		}
	}
	else{
		header('Location: ./alteraimagemquestao.php');
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
<link rel="icon" href="../img/logos/sb.ico">	
	
	<title>Softbio - Cadastro de conteúdo</title>


	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/apendices.css" rel="stylesheet">
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<script src="../js/ie-emulation-modes-warning.js"></script>
	<script src="../js/formulario.js"></script>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	<script src="../js/codigos.js"></script>


	<script src="../bootstrap/jquery.js"></script>
	<script> 
		$(function(){
			$("#footer").load("footer.html"); 
			$("#navbar").load("../navbar.php?p=adm");
		});

	</script>	
	
</head>

<div id="navbar">
</div>

<body>
	
	<div class="container contentpagina">
		<div class="row"><!--Título-->
			<center><h1 >Imagem<br>
				<small>Cadastre uma imagem para a questao</small>
				<hr>
			</h1></center>

		</div>

		<div class="row">
			<?php
			session_start();
			include "conexao.php";
			include "hashimagem.php";
			
			$_SESSION['grava_nome_img_questao'] = 's';
			$id = $_SESSION['id_questao'];
			
			
			$sql="Select id_questao, imagem from questao where id_questao = $id";
			$resultado= pg_query($conecta, $sql);
			$linha=pg_fetch_array($resultado);
			$nome_img = $linha['imagem'];
			
			if($nome_img==''){
				$nome_img = retornaHash();
				$sql="update questao set imagem = '$nome_img' where id_questao = $id";
				$resultado=pg_query($conecta,$sql);
			}
			
			$_SESSION['nome_img_questao'] = $nome_img;
			?>

			<center>

				<img src="../img/questao/<?php echo $nome_img; ?>.jpg" height="200px;" />
				<br><br><br>
			
				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

					<div class="form-group">



						<form action="inseririmagem.php" method="POST" enctype="multipart/form-data">
							<div class="input-group">
								<input type="file" name="arquivo" id="fileToUpload" accept=".jpg">
								<input type="hidden" name="pasta" value="../img/questao/" >
								<input type="hidden" name="nome" value="<?php echo $nome_img; ?>" >
								<input type="hidden" name="redirect" value="editarimagemquestao.php" >
								<input type="hidden" name="redirect_error" value="alteraimagemquestao.php" >
								<br><br>
								
								
								<div class="row">
								
									<center>
										<div class='form-group col-md-6 col-xs-6'>
											<button type="submit" class="btn btn-primary">Enviar</button>
										</div>
										</form>
										<form action="alteraimagemquestao.php" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="nome_img" value="<?php echo $nome_img; ?>" >
											<input type="hidden" name="acao" value="apagar">
											<div class='form-group col-md-6 col-xs-6'>
											<?php
												$imagem='../img/questao/'.$nome_img.'.jpg';
												if(file_exists($imagem))
												{?>
													<button type="submit" class="btn btn-primary" onClick="return confirm('Deseja realmente excluir a imagem?');">Apagar</button>
												<?php
												}
												else{?>
													<button class="btn btn-primary disabled">Apagar</button>
												<?php
												}?>
											</div>
										</form>
									</center>
								</div>
								<div class="row">
									<center>
										<div class='form-group col-md-12 col-xs-12'>
											<a href="./menuquestoes.php" class="btn btn-primary">Manter Imagem</a>
										</div>
									</center>
								</div>
							</div>

						</form>
						<div class="help-block with-errors"></div>
					</div>
				</aside>
			</center>
			
		</div><!--row-->

	</div>
	<footer id="footer" class="footer">
	</footer>
</body>


</html>