<!DOCTYPE html>
<html lang="pt-br"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../img/logos/sb.ico">
	
	
	<title>Softbio - Cadastro de Questão</title>


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

		function verificaImagem(){
			arquivo = document.getElementById("fileToUpload").value;
			
			if(arquivo=="")
			{
				alert("Selecione um arquivo");
				return false;
			}
			return true;
		}
window.onbeforeunload = function(event) {
event.returnValue = "asdasdfasdf";
};
function tiraVerificacao(){
window.onbeforeunload = null;
};

	</script>
	
	
</head>

<div id="navbar">
</div>

<body>
	
	<div class="container contentpagina">
		<div class="row"><!--Título-->
			<center><h1 >Imagem<br>
				<small>Cadastre uma imagem para a questão</small>
				<hr>
			</h1></center>

		</div>

		<div class="row">
			<?php
			session_start();
			include "conexao.php";
			include "hashimagem.php";
			$_SESSION['grava_nome_img_questao'] = 's';
			$nome_img = retornaHash();
			$_SESSION['nome_img_questao'] = $nome_img;
			
			?>

			<center>

				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

					<div class="form-group">



						<form action="inseririmagem.php" onsubmit="tiraVerificacao()" method="POST" enctype="multipart/form-data">
							<div class="input-group">
								<input type="file" name="arquivo" id="fileToUpload" accept=".jpg">
								<input type="hidden" name="pasta" value="../img/questao/" >
								<input type="hidden" name="id" value="<?php echo $_SESSION['id_questao']; ?>" >
								<input type="hidden" name="nome" value="<?php echo $nome_img; ?>" >
								<input type="hidden" name="redirect" value="editarimagemquestao.php" >
								<br><br>
								<div class="row">
									<center>
										<div class='form-group col-md-6 col-xs-6'>
											<button type="submit" class="btn btn-primary" onclick="return verificaImagem();" style="width: 150px;">Enviar</button>
										</div>
										<div class='form-group col-md-6 col-xs-6'>
											<a href="./cadastrarquestao.php" onclick="tiraVerificacao();" class="btn btn-primary menuquestoes" style="width: 150px;">Não cadastrar</a>
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