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

		<script src="assets/js/holder.min.js"></script>
	<script src="../js/codigos.js"></script>
	<script src="../bootstrap/jquery.js"></script>
	
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=conta");
    });


</script>
 </head>
<div id="navbar">
	
</div>

	<body>
  
	     <?php

  include "conexao.php";
  session_start();					
if($_SESSION['adm']!='s')
 header("Location: /hope/tcc/login.php");

if($_SESSION['admemail']==null)
{
	$email= $_POST['emailadm'];
}
else
{
	$email= $_SESSION['admemail'];
	$_SESSION['admemail']=null;
}
	
	
	
	

		
		 $sql="select * from login where email='$email'";
$_SESSION["altera"] = $email;

 $resultado2= pg_query($conecta, $sql);
 $qtde2=pg_num_rows($resultado2);
 if ($qtde2 > 0)
 {
		 $linha2=pg_fetch_array($resultado2);
 }
		 ?>

 
 
 
		
		<div class="contentpagina">

<form action="alterasenha.php" method="post">


	<div class="container-fluidcad">
		<div class="container-fluida">
	    
<br>
<br>

		  <div class="row text-center" id="colorida" >
		  
		<h1>Conta</h1>
		

		<br></div>

	</div>

<br>
	
		<div class="row">
			<center><h4>Informações do Administrador</h4>
<hr></center>
				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				

				<label for="inputEmail" class="control-label"><b><h4>E-mail:</b></h4></label>
			<br>
				<?php  echo $linha2['email'];?>
				
		
			</aside>	  
</div>
		<div class="row">

				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				

				<label for="inputEmail" class="control-label"><b><h4>Nome:</b></h4></label>
			<br>
				<?php  echo $linha2['nome'];?>
				
		
			</aside>	  
</div>

   
		<br>	<br>	<br>

	<div class="row">

		 <div class='form-group col-md-8 col-xs-8 col-xs-offset-2'>
		  <center>
<a href="menuadm.php"><input type="button" class="btn btn-primary" data-toggle="modal" value="Voltar "/></a>

		<?php 

		if($linha2["excluido"]=="n")
				{
					?>
	 <a href="#modalexcluir" data-toggle="modal"><input type="button" class="btn btn-primary" data-toggle="modal" value="Excluir "/></a>
		
		
			<?php
				} 
			else{
				?>
	 <a href="#modalreativar" data-toggle="modal"><input type="button" class="btn btn-primary" data-toggle="modal" value="Reativar "/></a>

				<?php
			}
				?>
								
</center>
		  </div>		
  
</div>
    </div>
</form>
	
	
		<!-- modais-->

 <div  class="modal fade" id="modalexcluir" tabindex="-1" role="dialog" aria-labelledby="modalexcluirLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente excluir este administrador?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="excluiradm.php" method="post">
				
		
				<button type="submit" class="btn btn-primary" id="finalizar">Excluir</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
			</form>
            </div>
        </div> 
			</div>  
          </font>
    </div>
	
	
		<!-- outro modal -->
	
	 <div  class="modal fade" id="modalreativar" tabindex="-1" role="dialog" aria-labelledby="modalreativarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente reativar este administrador?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="reativaradm.php" method="post">
				
				<button type="submit" class="btn btn-primary" id="finalizar">Reativar</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
    </div>    
    </div>
	
	<footer id="footer" class="footer">
	</footer>

 </body>

</html>