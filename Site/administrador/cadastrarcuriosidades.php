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
	
		<title>Softbio - Cadastro de curiosidades</title>
		
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
	
		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/holder.min.js"></script>

	
	<!-- data -->
	
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8" media="screen"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8" media="screen"></script>
<!-- data -->

	
	
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");
    });


</script>

<script language="javascript">
    var titulo = $("#titulo"); 
        titulo.blur(function() { 
            $.ajax({ 
                url: 'verificatitulo.php', 
                type: 'POST', 
                data:{"titulo" : titulo.val()}, 
                success: function(data) { 
                console.log(data); 
                data = $.parseJSON(data); 
                $("#resposta").text(data.titulo);
            } 
        }); 
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
		 
		 $correto=$_SESSION['correto'];
	$_SESSION['correto']=null;
	
	
		 
		 $_SESSION["id"]=null;
		
		 
		//$email= $_GET["email"];
		$_SESSION['email']=$email;
		
		$_SESSION['texto'];
		$_SESSION['titulo'];
		$_SESSION['fonte'];
		$_SESSION['data'];
		
		
?>
   
	
    <script>
	
	function data(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	
	if(dd<10) {
		dd = '0'+dd
	} 
	
	if(mm<10) {
		mm = '0'+mm
	} 
	
	today = yyyy + '-' + mm + '-' + dd;	
	
	var data = document.getElementById("data").value;
	if(data > today)
	{
		alert("Por favor, informe data uma válida");

	}
	if(data <= '2000-01-01')
	{
		alert("Por favor, informe data uma válida");

	}
}


	 </script>
	 <div class="contentpagina">
	
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
	<!-- Navbar -->

		<!-- Collect the nav links, forms, and other content for toggling -->
	<!--Menu-->
	<form  action="verificatitulo.php" onsubmit="tiraVerificacao()" data-toggle="validator" method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluidinho">	

	<div class="container-fluida">

		  	     <div class="row text-center" id="colorida">
		  
			<center><h1>Cadastro de curiosidades<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					    </h1></center>
<hr>
		<br>
		</div>
	</div>
  


	<div class="container-fluidcad">
	<fieldset>
	
		<div class="row">

				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>


				<div class="form-group">

				<label for="inputtitulo" class="control-label"><b><h3>Título</b></h3></label>
			<div class="input-group">

					<input id="inputtitulo" class="form-control" placeholder="Digite o título da curiosidade"  value="<?php if($_SESSION['titulo']!='') echo $_SESSION['titulo']; ?>" type="text" name="titulo" maxlength="150" required> 
	<span class="input-group-addon add-on"></span>
				</div>
				
			   <?php
				if($correto==2) 
				{
					
					echo "<h6 class='title1'><br>Esta curiosidade já existe. Por favor, cadastre outra.</h6>";
				}

				?>
				<div class="help-block with-errors"></div>
	
			   </div>

			   
			</aside>
			<br>
	
				
		
			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="texto" class="control-label"><b><h3>Texto</b></h3></label>
				<div class="input-group">

				<textarea cols="100" id="texto" rows="10" name="texto" class="form-control" style="resize: none;" required placeholder="Digite a curiosidade" style="text-align: justify;"><?php
				if($_SESSION['texto']!='') echo $_SESSION['texto']; ?></textarea>     
				  
		
		</div>
				  
			</div>
	</div><!--row-->
	<hr>
	<br>

	 <div class="row">
		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

			<div class="form-group">
				<label for="fonte" onclick="javascript:habilitar()" class="control-label"><h3><b>Fonte</h3></b></label>
				<div class="input-group">
				<input type="text" class="form-control" id="fonte" value="<?php if($_SESSION['fonte']!='') echo $_SESSION['fonte']; ?>" placeholder="Digite a fonte da curiosidade" name="fonte" required >
<span class="input-group-addon add-on"></span>
				
			</div>
		
		  </div>
		  
	   </div><br><br>
	   

	<hr>
</div>

	
	<div class="row">

	<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">
                <h3>Data</h3> 
                <div  class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="data" data-link-format="dd-mm-yyyy">
                    <input class="form-control" type="text" readonly name="data_texto" id="data_texto" value="<?php if($_SESSION['data']!='') echo date("d-m-Y",  strtotime($_SESSION['data'])); ?>" >
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="data" name="data" required>
	</div>
		
	<script>
	$('.form_date').datetimepicker({
language: 'pt-BR',
weekStart: 1,
startDate:'01-01-2005', 
startDate: '01-01-2000',
endDate: '+0d',
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

	
	
	
	<hr>
		<br>


	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Cadastrar</button>
		  <button type="reset" class="btn btn-primary">Limpar</button></center>
		  </div>

	</div>
</div>
	 </form>
	  </fieldset>
	  </div>

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