<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	 <link rel="icon" href="img/logos/sb.ico">


    <title>Softbio - Cadastro</title>
	<script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php?p=cadastrar");
    });
window.onbeforeunload = function(event) {
event.returnValue = "asdasdfasdf";
};
function tiraVerificacao(){
window.onbeforeunload = null;
};
</script>

<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/format.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	<script src="js/formulario.js"></script>
	<script src="js/codigos.js"></script>

  </head>
    <div id="navbar">
	
</div>

  <body>
  <?php
  
  /*Início do php*/
  include "conecta.php";
	 session_start();
	 $errado=$_SESSION["errado"];
	
  ?>
  <script language="javascript">
    var email = $("#email"); 
        email.blur(function() { 
            $.ajax({ 
                url: 'verificaemail.php', 
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

     <div class="container contentpagina"  id="maelogin">


	<form  class="form-inline" action="verificaemail.php" data-toggle="validator" onsubmit="tiraVerificacao()" method="post" name="contact_form" id="contact_form">

	
	<h1><b>Cadastro</h1></b>
	<br>
	<?php
	$correto=0;
	$correto=$_GET['correto'];
	?>
      
      <div class="row">
	  <div class='form-group col-md-20 col-xs-20 col-md-offset-2 col-xs-offset-1'>
<?php
if($errado==2) 
{?> <div class="alert alert-danger"><?
	echo "<b>E-mail em uso!\nPor favor, digite outro<b>";?>
	</div>
	<?
	$_SESSION["errado"]=null;
}
else
{
	?><br><?
}

?>		<center>
	<div class="form-group">
				<small>
				<label for="inputEmail" class="control-label" ><b><h3>E-mail</b></h3></label></small>
			
				<div class="input-group">
				<input id="inputEmail" class="form-control" type="email" name="email" placeholder="Digite seu e-mail" style="width:200px; " >
	<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
				<center>
			   </div>
			</div>
			
				

      </div>
				
</center>
  <br><br>
  
    <div class="col-md-offset-2 col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="entrar">Cadastrar</button>
   
	
    </div>

    </form>
	
     
    
   </center>
	<script src="js/bootstrapvalidator.min.js"></script>
	  <script src="js/cadastro.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	</div>
	<footer id="footer" class="footer">
	</footer>
 </body>
</html>
