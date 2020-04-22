<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<link rel="icon" href="img/logos/sb.ico">


    <title>Softbio - Alterar Senha</title>
<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/formatacaoaltera.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	<script src="js/formulario.js"></script>
	<script src="js/codigos.js"></script>

<script>
  function limitarInput(obj) {
    obj.value = obj.value.substring(0,6); //Aqui eu pego o valor e só deixo o os 10 primeiros caracteres de valor no input
  }
</script>

<script>
  function desabilita()
{
	document.getElementById("#confsenha").disabled = true; //Desabilitando
}
function habilitar()
{
	document.form_contact.confsenha.disabled = false; 
}
</script>

<script>
						
	 function verifica(){
		senha = document.getElementById("loginsenha").value;
		forca = 0;
		mostra = document.getElementById("mostra");
		if((senha.length >= 4) && (senha.length <= 7)){
			forca += 10;
		}else if(senha.length>7){
			forca += 25;
		}
		if(senha.match(/[a-z]+/)){
			forca += 10;
		}
		if(senha.match(/[A-Z]+/)){
			forca += 20;
		}
		if(senha.match(/d+/)){
			forca += 20;
		}
		if(senha.match(/W+/)){
			forca += 25;
		}
		return mostra_res();
	}
	function mostra_res(){
		if(forca < 30){
			mostra.innerHTML = '<tr><td bgcolor="red" width="'+forca+'"></td><td> &nbsp;Fraca </td></tr>';
		}else if((forca >= 30) && (forca < 60)){
			mostra.innerHTML = '<tr><td bgcolor="yellow" width="'+forca+'"></td><td> &nbsp;Justa </td></tr>';;
		}else if((forca >= 60) && (forca < 85)){
			mostra.innerHTML = '<tr><td bgcolor="blue" width="'+forca+'"></td><td> &nbsp;Forte </td></tr>';
		}else{
			mostra.innerHTML = '<tr><td bgcolor="green" width="'+forca+'"></td><td> &nbsp;Excelente </td></tr>';
		}
	}



</script>

<script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php?p=alterarsenha"); 
    });
</script>

</head>
<div id="navbar">
	
</div>

 <body>
  <?php
  
session_start();
  include "conecta.php";
  $batata=$_SESSION["batata"];
  if ($batata==null)
  {
 	if (!isset($_SESSION["logou"]))
		{
	
			header("Location: login.php");

		}
  }

	//$_SESSION["usuario"];
	//$usuario=$_GET["usuario"];
	// $_SESSION["usuario"];
	//$usuario=$_GET['usuario'];
		
	$_SESSION["usuario"]=$usuario;
	 $_SESSION["emailesqueci"];
	//$_SESSION["usuario"]=$usuario;
	$_SESSION["senha"];  
	
	$correto=$_GET['correto'];
  ?>

     <div class="container contentpagina"  id="maesenha">

<form class="form-inline" id="formtudo" name="formtudo"  action="validacaosenha.php" method="post">	<h1><b>Alterar Senha</h1></b>
     
      <div class="row">
      <div class="form-group col-md-8">
		
	  <label for="loginsenha" class="control-label" id="label1">Nova senha:</label>
<br>	
	<input type="password" class="form-control input-lg" id="loginsenha" placeholder="Digite sua nova senha" name="loginsenha" onblur="habilita();" maxlength="32" onkeyup="javascript:verifica()" minlength="6" data-minlength="6"  required >
      			<br>
				<table id="mostra"></table>
	
	  
      </div>
      </div>
	  <br>
	
	   <div class="row">
      <div class="form-group col-md-8">
	  <label class="control-label">Confirma nova senha:</label>
      <input type="password" class="form-control input-lg" 
	  name="confsenha"   maxlength="32" minlength="6" id="confsenha"  placeholder="Redigite sua nova senha"  aria-describedby="addon3" data-match="#loginsenha" data-match-error="Atenção! As senhas não estão iguais." required>
	  
	 </div>
     </div>
  <br><br>
  
    <div class="col-sm-offset-2 col-sm-10">
<center>
      <button type="submit" class="btn btn-default" id="entrar">ALTERAR</button>
</center>
    </div>

    </form>
 </center>


	<script src="js/bootstrapvalidator.min.js"></script>
	  <script src="js/alterarsenha.js"></script>

    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>
