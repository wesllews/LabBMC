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
	
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8" media="screen"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8" media="screen"></script>
	
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=editausua");
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
		
		$correto=$_GET['correto'];
		if($_SESSION['adm']!='s')
 header("Location: /hope/tcc/login.php");


	
		


 ?>
 <script>
 	
	//Data
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
 </script>
		

	
	<form  action="verificaeditaradm.php" data-toggle="validator" onsubmit="tiraVerificacao()"  method="post" name="contact_form" id="contact_form">
		
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
					<input id="inputEmail" class="form-control" placeholder="Digite seu e-mail" value="<?=$_SESSION["email"]?>" name="email" type="email" readonly maxlength="50" >
					<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
				
		
			<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h3>Nome</b></h3></label>
				<div class="input-group">
				<input id="textNome" class="form-control" placeholder="Digite seu Nome" onkeypress="return letras();" name="nome" value="<?=$_SESSION["nome"]?>" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
			</article>
	</div><!--row-->
	<hr>
	


	
	<div class="row">
	<?
$nascimento=$_SESSION["nascimento"];
$nascimento =  date("d-m-Y",  strtotime($nascimento));
//	echo $nascimento;
	?>
	
	<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">
                <h3>Nascimento</h3> 
                <div  class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="data" data-link-format="dd-mm-yyyy">
                    <input class="form-control"  type="text" readonly name="data_texto" value="<?=$nascimento?>" id="data_texto">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="datanasc" name="datanasc"  required>
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
	

</div>
		<div class="row">

		  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  <h3><b>Tipo de Usuário</b></h3> 
				<div class="input-group">
	 
	  <?
	  $adm=$_SESSION['tipo'];

	  
	  if($adm=='s')
	  {
		  ?>
			<div class="radio">
			<label><input type="radio" name="tipo" value="s"checked >Administrador</label>
			<div class="radio">
			<label><input type="radio" name="tipo" value="n" >Usuário</label>
			</div>
		  <?
	  }
	  else
	  {
		 ?>
			<div class="radio">
			<label><input type="radio" name="tipo" value="s" >Administrador</label>
			</div>
			<div class="radio">
			<label><input type="radio" name="tipo" value="n" checked>Usuário</label>
			</div>
		<?
	  }
	  ?>
		</div>    
		  </div>
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
		$usuario=$_SESSION["email"];
		$iduni=$_SESSION["universidade"];
		echo "BATATA".$iduni;
									
										
										$sql2="select * from universidade";
										$resultado2= pg_query($conecta, $sql2);
										while($linha2 = pg_fetch_array($resultado2)){
										?>
											<option value="<?php echo $linha2[id_universidade]; ?>" <?php if($linha2['id_universidade'] == $iduni) echo "selected" ?> >
												<?php echo $linha2[nome]; ?></option>
											
										<?php
							
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
				<input id="textCurso" class="form-control" placeholder="Digite o curso universitário" onkeypress="return letras();" value="<?=$_SESSION["curso"]?>" name="curso" maxlength="50" type="text" required>         
				  <span class="input-group-addon add-on"></span>
				</div>
				  
	</div>
	
	<br>

		
</div>
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
