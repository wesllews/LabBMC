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
	
	
		<title>Softbio - Cadastro </title>
		

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/format.css" rel="stylesheet">
		<script src="../js/formulario.js"></script>
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>


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
  <div class="contentpagina">
  <?php
  
  /*Início do php*/
  include "conexao.php";
session_start();

  ?>
  <script language="javascript">
    var email = $("#email"); 
        email.blur(function() { 
            $.ajax({ 
                url: 'verificaemailadm.php', 
                type: 'POST', 
                data:{"email" : email.val()}, 
                success: function(data) { 
                console.log(data); 
                data = $.parseJSON(data); 
                $("#resposta").text(data.email);
            } 
        }); 
    }); 
	</script>
<script language="javascript">

window.onbeforeunload = function(event) {
event.returnValue = "asdasdfasdf";
};
function tiraVerificacao(){
window.onbeforeunload = null;
};
</script>


     <div class="container"  id="maelogin">


	<form  class="form-inline" action="verificadm.php" data-toggle="validator" onsubmit="tiraVerificacao()"  method="post" name="contact_form" id="contact_form">

	
	<h1><b>Cadastro</h1></b>
	<br>

      <div class="row">
	  <div class='form-group col-md-20 col-xs-20 col-md-offset-2 col-xs-offset-1'>
<?php
$correto=$_SESSION['correto'];
$_SESSION['correto']=0;
if($correto==2) 
{?> <div class="alert alert-danger"><?
	echo "<b>E-mail em uso!\nPor favor, digite outro<b>";?>
	</div>
	<?
}
else
{
	?><br><?
}

?>

			<div class="form-group">
				
				<label for="inputEmail" class="control-label email"><b><h4>E-mail</b></h4></label>
				
				<div class="input-group">
					<input id="inputEmail" class="form-control" type="email" name="email" placeholder="Digite o e-mail" >
	<span class="input-group-addon add-on"></span>
				</div>
				<center>
				<div class="help-block with-errors"></div>
				<center>
			   </div>
			</div>
			
				

      </div>
				
	
  <br><br>
    <div class="col-md-offset-2 col-sm-offset-4 col-sm-10">
      <button type="submit" class="btn btn-default" id="entrar">Cadastrar</button>
   
	
    </div>


    </form>
	
   </center>

    

	<script src="../js/bootstrapvalidator.min.js"></script>
	  <script src="../js/cadastro.js"></script>
	  
	  </div>
</div>	
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>