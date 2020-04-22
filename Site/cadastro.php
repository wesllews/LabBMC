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

	<script  type="text/javascript" src="bootstrap/jquery.js"></script>
	<script  type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->
	<!--<script src="js/ie-emulation-modes-warning.js"  rel="stylesheet"></script>-->
	<link href="css/conta.css" rel="stylesheet">
	<script src="js/formulario.js"  rel="stylesheet"></script>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	<script src="js/codigos.js"  rel="stylesheet"></script>




	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8" media="screen"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8" media="screen"></script>




    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php?p=cadastro");
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
		include "conecta.php";
		
		 session_start();
		$email= $_SESSION['emailcadastro'];
		$_SESSION['emailcadastro']=null;
		$_SESSION['email']=$email;
		
?>
	
	
    <script>

window.history.forward(1);


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
		
	
	<form  action="verificacadastro.php" data-toggle="validator" onsubmit="tiraVerificacao()" method="post" name="contact_form" id="contact_form">
	<div class="container contentpagina">



	<div class="container-fluida">

		  <div class="col-lg-12">
				
                <center><h1>Cadastro<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					<hr>
                </h1></center>
            </div>
	</div>

	<div class="container-fluida1" >
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
	
				
		
			<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h3>Nome</b></h3></label>
				<div class="input-group">
				<input id="textNome" class="form-control" placeholder="Digite seu Nome" onkeypress="return letras();" name="nome" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
			</article>
	</div><!--row-->
	<hr>
	<br>

	 <div class="row">
		<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

			<div class="form-group">
				<label for="senha" onclick="javascript:habilitar()" class="control-label"><h3><b>Sua senha</h3></b></label>
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
				<input type="password" class="form-control" id="confsenha" placeholder="Confirme sua Senha" maxlength="32" minlength="6" name="confsenha" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais." required>

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
	<div class="row">

	<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">
                <h3>Nascimento</h3> 
                <div  class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="data" data-link-format="dd-mm-yyyy">
                    <input class="form-control"  type="text" readonly name="data_texto" id="data_texto">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="datanasc" name="datanasc" required>
	</div>
		
	<script>
	$('.form_date').datetimepicker({
language: 'pt-BR',
weekStart: 1,
startDate:'01-01-1930', 
endDate: '01-01-2006',
format: 'dd-mm-yyyy',
todayBtn: 1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
minView: 2,
forceParse: 0
});
	</script>
	
	
		<!--<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1 input-group date form_date" data-date="" data-date-format="dd MM yyyy"
data-link-field="data" data-link-format="dd-mm-yyyy">
 <input class="form-control" type="text" readonly name="data_texto"
id="data_texto" >
<span class="input-group-addon">
<span class="glyphicon glyphicon-calendar">
</span>
</span>
</div>
<input type="hidden" id="datanasc" name="datanasc" required>
</div>
	-->
</div>
	<hr>
		<br>

	<div class="row">
				<div class="row map-options">
					
					<div class="col-md-12 text-center">
				
						
			
					  
						
						<div class="parte-user actived  parte-2">
							<span class="numberact">2</span>
							<span class="textoact">Dados do Curso</span>
						</div>
						</div>
						

					</div>
				</div>
				
				<br>


	<div class="row">

		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  <h3><b>Universidade</b></h3> 
				<div class="input-group">
	  
			<select name="universidade" id="universidade" class="form-control" required>
				<optgroup label="Universidades">
									<?php
		
									
										$sql1="select * from universidade";
										$resultado1= pg_query($conecta, $sql1);
										while($linha1 = pg_fetch_array($resultado1)){
										?>
											<option value="<?php echo $linha1[id_universidade]; ?>"><?php echo $linha1[nome]; ?></option>
											
										<?php
										//$_SESSION['id_universidade']=$linha1[id_universidade];
										}
									?>
								</optgroup>
								</select>				
				<span class="input-group-addon add-on"></span><center> 
				  
		  </div><br>
		  <center><span class="help-block">Escolha a universidade que você quer prestar</span></center>
		</div>
		<br>

		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textCurso" class="control-label"><b><h3>Curso pretendido</b></h3></label>
				<div class="input-group">
				<input id="textCurso" class="form-control" placeholder="Digite o curso universitário" onkeypress="return letras();" name="curso" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
	</div>
	
	<br>
	<div class='form-group  col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
 
            <div class="form-group">		   
		   <b><h3>Dificuldade curso SoftBio</b></h3>
		    <div class="input-group">
    	   <select class="form-control" name="dificuldade" required>
			  <optgroup label="Tipo do curso">
				<option value="Básico">Básico</option>
				
				<option value="Intensivo">Intensivo</option>  
			  </optgroup>
		   </select>

		 <span class="input-group-addon add-on"></span>
           </div>  
      </div>
</div>
		
</div>
	<hr>
		  

	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Enviar</button></center>
		  </div>

	</div>
	</div>
	 </form>
	  </fieldset>
	  </div>


		<script src="js/jquery.min.js" rel="stylesheet"></script>

	<script src="js/bootstrapvalidator.min.js" rel="stylesheet"></script> 
	<script src="js/cadastro.js" rel="stylesheet"></script> 
	 
</div>
 </body>
  	<footer id="footer" class="footer">
	</footer>
</html>
