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
	
		<title>Softbio - Editar Usuário</title>
		
				<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
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
  




		
	     <?php
		include "conexao.php";
			session_start();
		
	$_SESSION["usuario"];
	$_SESSION["senha"];  

	
	$correto=$_GET['correto'];
	$email=	$_SESSION["usuario"];
	
				 $sql="select * from cadastro where email='$email'";

 $resultado2= pg_query($conecta, $sql);
 $qtde2=pg_num_rows($resultado2);
 if ($qtde2 > 0)
 {
		 $linha2=pg_fetch_array($resultado2);
 }
		 ?>




	
	<form  action="minhaconta.php" data-toggle="validator" onsubmit="tiraVerificacao()"  method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluidinho">	

	
	
	<div class="row text-center" id="colorida" >
		  
    <center><h1 class="page-header titulo">Editar dados<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					    </h1></center>



		<br>
		</div>


	<div class="container-fluida1">
	<form class="form-horizontal" data-toggle="validator">
	   
		<div class="row map-options">
					
					<div class="col-md-12 text-center">
					
						<div class="parte-user actived parte-1">
							<span class="numberact">1</span>
							<span class="textoact">Dados pessoais</span>
							
						</div>
	

					</div>
				</div>
		</div>

		<div class="row">
	<div class="has-warning"><!--Mensagem de erro-->
<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
			<center><label for="warning" class="control-label"><br>Verifique seus dados e altere o que for necessário.</label></center>
		</div>
		  </div>
	</div>
	<div class="container-fluidcad">
	<fieldset>
		<div class="row">

				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>E-mail</b></h3></label>
				<div class="input-group">
					<input id="inputEmail" class="form-control" placeholder="Digite seu e-mail" value="<?=$_SESSION["usuario"]?>" name="email" type="email" readonly maxlength="50" >
					<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
				
		
			<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h3>Nome</b></h3></label>
				<div class="input-group">
				<input id="textNome" class="form-control" placeholder="Digite seu Nome" onkeypress="return letras();" name="nome" value="<?=$linha2['nome']?>" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
			</article>
	</div><!--row-->
	<hr>
	


	<hr>
		<br>

	


	<hr>
		  

	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Salvar alterações</button></center>
		  </div>

	</div>
	</div>
	 </form>
	  </fieldset>
	  </div>


		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/holder.min.js"></script>


	<script src="assets/js/bootstrapvalidator.min.js"></script> 
	<script src="assets/js/cadastro.js"></script> 
	 
  </body>
	     <div id="footer">

</div>
	 
</html>
