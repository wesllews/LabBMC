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
	
	<script src="../js/codigos.js"></script>
	<script src="../bootstrap/jquery.js"></script>
	
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=alterauni");
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


		$iduni= $_POST["iduni"];
		//$sigla= $_POST["sigla"];
	
		
		 $sql="select * from universidade where id_universidade='$iduni'";

 $resultado2= pg_query($conecta, $sql);
 $qtde2=pg_num_rows($resultado2);
 if ($qtde2 > 0)
 {
		 $linha2=pg_fetch_array($resultado2);
 }
	
 ?>

<form action="editaruni.php" method="post">


	<div class="container-fluidcad">
		<div class="container-fluida">
	    
					<!--<div class='form-group col-md-12 col-xs-12 '>

		  <!--<div class="row text-center" id="colorida" >  </div>-->

		 <div class="row"><!--Título-->
            <div class="col-lg-12">
                <center><h1 >Universidades<br>
                    <small>Verifique se os dados estão corretos</small>
					<hr>
                </h1></center>
            </div>
       </div>
		<!--</div>-->
	</div>
	  
	
  <!--<center><span class="faixa">Sobre</span></center>-->
<br>
	<br>			<br>
		<div class="row">
<center><h4>Informações da Universidade</h4>
<hr></center>
		
			<br>			<br>			

			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h4>Nome:</b></h4></label>
				<br>
				
						<?php echo  $linha2['nome'];?>
				
			</div>
						
				<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   <br>			
				<label for="textNome" class="control-label"><b><h4>Sigla:</b></h4></label>
				<br>
				
						<?php echo  $linha2['sigla'];?>
				
			</div>


	<br>



	
	</div>

</div>
   
		<br>
				<br>			<br>

	<div class="row">

<?
$_SESSION['nomeuni']=$linha2['nome'];
$_SESSION['sigla']=$linha2['sigla'];
$_SESSION['id_uni']=$linha2['id_universidade'];

				 ?>
	
		 <div class='form-group col-md-8 col-xs-8 col-xs-offset-2'>
		  <center>
<a href="menuni.php">
<input type="button" class="btn btn-primary" value="Voltar"/></a>

		  	<a href="alterauni.php">
   <input type="button" class="btn btn-primary" value="Editar"/></a>
   
		
</center>
		  </div>		
  
</div>
    </div>
				<br>			<br>	
</form>
	
		
        </div> 
			</div>  
      

    
    </div>
	
	

	
	<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/holder.min.js"></script>
	
 
<div id="footer">
</div>
 
  </body>
  </html>
