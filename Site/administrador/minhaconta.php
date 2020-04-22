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
	
		<title>Softbio - Conta Usuário</title>
		
				<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/format.css" rel="stylesheet">
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


</script>
 </head>
<div id="navbar">
	
</div>

	<body>
  
	     <?php

  include "conexao.php";
  session_start();						
	$_SESSION["usuario"];
	$_SESSION["senha"];  
	$_SESSION["altera"]=null;
 
	
	$correto=$_GET['correto'];
	$email=	$_SESSION["usuario"];
		
		 $sql="select * from login where email='$email'";

 $resultado2= pg_query($conecta, $sql);
 $qtde2=pg_num_rows($resultado2);
 if ($qtde2 > 0)
 {
		 $linha2=pg_fetch_array($resultado2);
 }
		 ?>


<div class="container-fluidcad contentpagina">
<form action="editarusua.php" method="post">


	
		<div class="container-fluida">
	    
					<!--<div class='form-group col-md-12 col-xs-12 '>

		  <!--<div class="row text-center" id="colorida" >  </div>-->

	 <div class="row"><!--Título-->
            <div class="col-lg-12">
                <center><h1 >Minha conta - Administrador<br>
                    <small>Verifique se seus dados estão corretos</small>
					<hr>
                </h1></center>
            </div>
       </div>
		<!--</div>-->
	</div>

  <!--<center><span class="faixa">Sobre</span></center>-->
<br>
	<br>
<br>
		<div class="row">
			<center><h4>Informações do administrador</h4>
<hr></center>
				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				

				<label for="inputEmail" class="control-label"><b><h4>E-mail:</b></h4></label>
			<br>
				<?php  echo $linha2['email'];?>
				
		
			</aside>
<br>
<br>
</div>
<div class="row">
			
				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				

				<label for="inputEmail" class="control-label"><b><h4>Nome:</b></h4></label>
			<br>
				<?php  echo $linha2['nome'];?>
				
		
			</aside>
<br>
<br>
</div>


	<div class="row">

		 <div class='form-group col-md-7 col-xs-8 col-xs-offset-2'>
		  <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="alterasenha.php">
   <input type="button" class="btn btn-primary" value="Editar senha"/></a>
   </center>

		  </div>
		<br>
<br>

															

  
</div>
    </div>

		  </div>


	</form>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/holder.min.js"></script>
	
 
	<footer id="footer" class="footer">
	</footer>

 </body>

</html>