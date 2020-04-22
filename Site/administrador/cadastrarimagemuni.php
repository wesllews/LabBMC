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
		<div class="row" style="padding-top:60px;"><!--Título-->
			<center><h1 >Imagem<br>
				<small>Edição de ícone para  unidade</small>
				<hr>
			</h1></center>

		</div>

		<div class="row">
			<?php
			session_start();
			include "conexao.php";
			$tabela="unidade";
			$pasta="../img/unidade/";
			
			$unidade=$_SESSION["unidade"];
		
			
			
			$uni=strtolower($unidade);
			
			$sql2="select *from unidade where LOWER (unidade)='$uni' and excluido='n'";
			
			
			$resultado2= pg_query($conecta, $sql2);
			$qtde=pg_num_rows($resultado2);
			
			if ($qtde>0)
			{
				$linha=pg_fetch_array($resultado2);
				$_SESSION['id_unidade']=$linha[id_unidade];
				//unset($_SESSION['unidade']); 
				
			}
			
			$certo= $_SESSION["certo"];
			$vez= $_SESSION["vez"];
			?>

			<center>

				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

					<div class="form-group">



						<form action="gravaimagemunidade.php" method="POST" onsubmit="tiraVerificacao()" enctype="multipart/form-data" onsubmit="tiraVerificacao()">
							<div class="input-group">	<br><br>
							
							<label class="btn btn-default">
								<input type="file" name="arquivo" id="fileToUpload" accept=".png">
								</label>
								
							
								
								<input type="hidden" name="pasta" value="<?php echo $pasta; ?>" >
								<input type="hidden" name="nome" value="<?php echo $_SESSION['id_unidade']; ?>" >
								<input type="hidden" name="id" value="<?php echo $_SESSION['id_unidade']; ?>" >
								<input type="hidden" name="tabela" value="<?php echo $tabela; ?>" >
								
								<input type="hidden" name="redirect" value="menualteraunidade.php" >
								<br><br>	
								
								<div class="row">
								
									<center>
										<div class='form-group col-md-12 col-xs-12' style="color:red;">
									<center> <?php 
									if ($vez==2)
									{
										if ($certo==0)
											{
												
												echo "<center>A imagem não deve exceder 64 pixels na largura e na altura</center>";
												
												
											}?>
											
											
											<?php if ($certo==2)
											{
												
												echo "<center>A imagem deve ter mesma altura e largura</center>";
												
												
											}
									}?>
										</div>
									</center>
							
								</div>
								
								<br><br> 
								<div class="row">
									<center>
										<div class='form-group col-md-6 col-xs-6'>
											<button type="submit" class="btn btn-primary">Enviar</button>
										</div>
										<div class='form-group col-md-6 col-xs-6'>
											<button type="reset" class="btn btn-primary">Apagar</button>
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
	
</body>

<div id="footer">
</div>
</html>