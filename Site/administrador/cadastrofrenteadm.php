<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../img/logo.png">
	
	
		<title>Softbio - Cadastro</title>
		
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
	<nav>
		<!--<img src="../img/softbio.png">-->
	</nav>

	<form  action="gravafrente.php" data-toggle="validator" onsubmit="tiraVerificacao()"  method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluid">	

	<div class="container-fluid"">
	  <!--<div class="row">
		<div class="img-responsive"  id="imgg">
	  <img src="virus.jpg" class="img-responsive"/>
	  
	  </div> 
	  </div>-->
		  <div class="row text-center" id="colorida"style="padding-top:25px; height:35%; margin-left:2px;" >
		  
		<h1>Cadastro de Frente</h1>

		<br>
		</div>
	</div>



		<div class="row">
	<div class="has-warning"><!--Mensagem de erro-->
<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
			<center><label for="warning" class="control-label"><br>É obrigatório o preenchimento dos campos com *</label></center>
		</div>
		  </div>
	</div>
	<div class="container-fluidcad">
	<fieldset>
		<div class="row">

				
			
			
			
			<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>Frente:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
					<input id="inputEmail" class="form-control"  placeholder="Digite uma frente. Ex: Botânica" type="text" maxlength="50"  name="frente"  required> 
					<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
				
		
			<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="descricao" class="control-label"><b><h3>Descrição:</b></h3></label>
				<div class="input-group">
			<textarea cols="54" rows="8" name="descricao" class="form-control"  placeholder="Digite uma descrição.Ex: Campo da biologia que estuda o reino vegetal"></textarea>
				  <span class="input-group-addon add-on"></span>
				</div>
				  
			</article>
	</div><!--row-->

	

	


	
				</div>
				
	<hr>
		  

	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Enviar</button></center>
		  </div>

	</div>
	
	
	 </form>
	  </fieldset>
	

		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>

		<script src="../js/holder.min.js"></script>


	<script src="../js/bootstrapvalidator.min.js"></script> 
	<script src="../js/cadastro.js"></script> 
	 
</div>
</body>

<div id="footer">
</div>

</html>