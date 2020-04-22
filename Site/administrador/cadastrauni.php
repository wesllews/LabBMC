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
	
		<title>Softbio - Cadastro de Universidade</title>
		

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	
		<link href="../css/apendices.css" rel="stylesheet">

		<link href="../css/carousel.css" rel="stylesheet">
	
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
	<div class="contentpagina">
	
	     <?php
		include "conexao.php";
		
		 session_start();
	

		$email= $_GET["email"];
		$_SESSION['email']=$email;
			$_SESSION['cont'];
if($_SESSION['adm']!='s')
header("Location: /hope/tcc/login.php");

		
?>
   
	
 
	
	<form  action="verificauni.php" data-toggle="validator" onsubmit="tiraVerificacao()"  method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluidinho">	

	<div class="container-fluida">

		    <div class="col-lg-12">
				
                <center><h1>Cadastro de Universidade<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					<hr>
                </h1></center>
            </div>
	</div>
	<br><br><br>
		<br><br><br>
		
		
	<?
	$cont=$_SESSION['cont'];
	$_SESSION['cont']=null;
		if($cont==2)
		{
		?>
<div class="alert alert-danger">
			<center><h4>Universidade já cadastrada!</h4></center>
			
		</div>
			
	
	<?
	
		}
		else
		{
			?>
			  <div class="col-lg-12">
				<center>
                    <h4>Informe novas universidades!</h4>
					<hr>
					<br>
                </h1></center>
            </div>
			<?
		}
	?>


		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textCurso" class="control-label"><b><h3>Nome</b></h3></label>
				<div class="input-group">
				<input id="textCurso" class="form-control" placeholder="Digite o nome da universidade" onkeypress="return letras();" name="nome" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
	</div>

	<br>
		<br>
				<br>
	<br>
		<br>
		<br>
	<br>

		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textCurso" class="control-label"><b><h3>Sigla</b></h3></label>
				<div class="input-group">
				<input id="textCurso" class="form-control" placeholder="Digite a sigla da universidade" onkeypress="return letras();" name="sigla" pattern=".{0}|.{3,}"maxlength="10" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				 <br> <br> 
	</div>
		
</div>
	<br>
	<br>
	<br>



	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Enviar</button></center>
		  	<br>
		<br>
	<br>


	</div>
</div>
	 </form>
	  </fieldset>
	  </div>


		<script src="../js/bootstrap.min.js"></script>

	<script src="../js/bootstrapvalidator.min.js"></script> 
	<script src="../js/cadastro.js"></script> 
	 
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>