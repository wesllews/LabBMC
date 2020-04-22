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
		
				<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
		<script src="../js/formulario.js"></script>
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/holder.min.js"></script>
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
		$email= $_SESSION["emailadm"];
		
		$_SESSION['email']=$email;
		$_SESSION["emailadm"]=null;
		
if($_SESSION['adm']!='s')
header("Location: /hope/tcc/login.php");

		
?>
   
	
    <script>
	
	function data()
{
	
	var data = document.getElementById("datanasc").value;
	
	
	if(data >='2007-01-01')
	{
		alert("Por favor, informe uma data válida");

	}
	if(data <= '1910-01-01')
	{
		alert("Por favor, informe uma data válida");
			
	}
	
	
	
	
}	
	 function verifica(){
		senha = document.getElementById("senha").value;
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
	 
	
	<div class="container-fluidinho contentpagina">	
	<form  action="verifiadm.php" data-toggle="validator" onsubmit="tiraVerificacao()" method="post" name="contact_form" id="contact_form">
		
	

	<div class="container-fluida">

		    <div class="col-lg-12">
				
                <center><h1>Cadastro<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					<hr>
                </h1></center>
            </div>
	</div>


		<div class="row">
	<div class="has-warning"><!--Mensagem de erro-->
<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		
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
					<input id="inputEmail" class="form-control"   type="email"  name="email"  value="<?=$_SESSION["email"]?>" readonly> 
	<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>

	</div><!--row-->

	<br>
	<div class="row">
			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h3>Nome</b></h3></label>
				<div class="input-group">
				<input id="textNome" class="form-control" placeholder="Digite seu Nome" onkeypress="return letras();" name="nome" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
			</div>
	</div>
	<br>
	 <div class="row">
		<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

			<div class="form-group">
				<label for="senha" onclick="javascript:habilitar()" class="control-label"><h3><b>Senha</h3></b></label>
				<div class="input-group">
				<input type="password" class="form-control" id="senha" placeholder="Digite uma senha" name="senha" maxlength="32" minlength="6" data-minlength="6" onkeyup="javascript:verifica()" required >
<span class="input-group-addon add-on"></span>
				
			</div>
			<br>
				<table id="mostra"></table> 
			<form class="well form-horizontal" action="cadastrocurso.php" method="post" id="contact_form">
		   <center> <span class="help-block">Mínimo de seis (6) digitos</span></center>
		  </div>
	   </aside><br><br>
		  <article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

	  
				<div class="form-group">
				<label for="inputConfirm" class="control-label"><h3><b>Confirme a senha</b></h3></label>
				<div class="input-group">
				<input type="password" class="form-control" id="confsenha" placeholder="Confirme a Senha" maxlength="32" minlength="6" name="confsenha" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais." required>

				<span class="input-group-addon add-on"></span>
				</div>
				<div class="help-block with-errors"></div> 
				<br>
				<center> <span class="help-block">Senhas precisam ser iguais</span> </center>
				<!--<div class="help-block with-errors"></div>

				</div>   -->
				  </div>
		  </article>


	<hr>
</div>
	
	<hr>
		  

	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Enviar</button></center>
		  </div>

	</div>
</div>
	 </form>





	<script src="../js/bootstrapvalidator.min.js"></script> 
	<script src="../js/cadastro.js"></script> 
	 
	</div>
	<footer id="footer" class="footer">
	</footer>
	
</body>
</html>