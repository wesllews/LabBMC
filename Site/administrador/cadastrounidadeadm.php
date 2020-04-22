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
<?php
session_start();
if($_SESSION['adm']!='s')
 header("Location: /hope/tcc/login.php");
?>
	<div class="contentpagina">

	<form  action="gravauni.php" data-toggle="validator" onsubmit="tiraVerificacao()" method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluid">	

	<div class="container-fluid"">
	  <!--<div class="row">
		<div class="img-responsive"  id="imgg">
	  <img src="virus.jpg" class="img-responsive"/>
	  
	  </div> 
	  </div>-->
	
	  <div class="col-lg-12">
				
                <center><h1>Cadastro de Unidade<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					<hr>
                </h1></center>
            </div>
	</div>




	<div class="container-fluidcad">
	<fieldset>
		<div class="row">
		
<div class='form-group  col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

            <div class="form-group">		   
		   <b><h3>Frente:</b></h3>
		   
		    <div class="input-group">
    	  <select class="form-control" name="id_frente" required>
							  <optgroup label="ID Frente">
							  <option value="1" >1. Origem da vida e biologia celular</option>
								<option value="2" >2. Genética</option>
								<option value="3">3. Evolução e classificação dos seres</option>
								<option value="4">4. Vírus, Procariontes e Fungos</option>
								<option value="5">5. Botânica</option>
								<option value="6">6. Zoologia e Embriologia</option>
								<option value="7">7. Espécie Humana</option>
								<option value="8">8. Ecologia</option>
								
							  </optgroup>
						   </select>

		 <span class="input-group-addon add-on"></span>
           </div>  
      </div>
</div>

	
		<br>
		
		

			
			
			
			<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>Unidade:</b></h3></label>
				
				<div class="input-group">
					<input id="inputEmail" class="form-control" onkeypress="return letras();" placeholder="Digite uma unidade. Ex: Classificação" type="text" maxlength="50"  name="unidade"  required> 
					<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
			
			<br>
			
			
<div class='form-group  col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

            <div class="form-group">		   
		   <b><h3>Dificuldade:</b></h3>
		  
		    <div class="input-group">
    	   <select class="form-control" name="dificuldade" required>
			  <optgroup label="Tipo do curso">
				<option value="básico">Básico</option>
				<option value="intensivo">Intensivo</option> 
			  </optgroup>
		   </select>

		 <span class="input-group-addon add-on"></span>
           </div>  
      </div>
</div>

		
			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="descricao" class="control-label"><b><h3>Descrição:</b></h3></label>
				<div class="input-group">
				<textarea cols='100' id="descricao" rows='5' style="resize:none;" name='descricao' class='form-control' required placeholder="Digite a descrição da unidade escolhida" style='text-align: justify;'></textarea>     
				  
				</div>
				  
			</div>
			
			<br>
			
			
	</div><!--row-->

	

	


	
				</div>
				
	<hr>
		  

	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Enviar</button>
		  <a href="index.php" class="btn btn-primary">Voltar</a>
		  </center>
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
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>