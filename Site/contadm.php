<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../assets/img/logo.png">

	<title>Softbio - Minha Conta</title>

	<script src="assets/bootstrap/jquery.js"></script>
    <script> 
       $(function(){
      $("#footer").load("../footer.html"); 
	  $("#navbar").load("../navbar.php?p=contadm");
    });


    </script> 

    <link href="assets/css/bootstrap.css" rel="stylesheet" />

        <!-- CUSTOM STYLES-->
    <link href="assets/css/conta.css" rel="stylesheet" />

</head>
<div id="navbar">
	
</div>

<body>
	     <?php
		include "conexao.php";
			session_start();

		$email= $_GET["email"];
		$_SESSION['email']=$email;
	
		
		 $sql="select * from cadastro where email='$email'";

 $resultado2= pg_query($conecta, $sql);
 $qtde2=pg_num_rows($resultado2);
 if ($qtde2 > 0)
 {
		 $linha2=pg_fetch_array($resultado2);
 }
		 ?>

 
 
 
		
		

<nav >
	  
</nav>

<form action="editarusua.php" method="post">


	<div class="container-fluidcad">
		<div class="container-fluida">
	    
					<!--<div class='form-group col-md-12 col-xs-12 '>

		  <!--<div class="row text-center" id="colorida" >  </div>-->

		  <div class="row text-center" id="colorida" >
		  
		<h1>Conta do Usuário</h1>
		

		<br></div>
		<!--</div>-->
	</div>
		  


		<br>
		
	

	
  <!--<center><span class="faixa">Sobre</span></center>-->
<br>
	
		<div class="row">
			<center><h4>Informações do Usuário</h4>
<hr align="center" width="600" size="10" color=red></center>
				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				

				<label for="inputEmail" class="control-label"><b><h4>E-mail:</b></h4></label>
			<br>
				<?php  echo $linha2['email'];?>
				
		
			</aside>
			<br>

			<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h4>Nome:</b></h4></label>
				<br>
				
						<?php echo  $linha2['nome'];?>
				
			</article>


	<br>

	

		  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  <label for="textnasc" class="control-label"><b><h4>Nascimento:</b></h4></label>
		  <br>

		  <?php 
		  $nascimento=$linha2['datanasc'];
		  echo date('d/m/Y',  strtotime($nascimento)); ?>
		  		
		  
		  </div>
</div>


   
		<br>

<center><h4>Informações do curso</h4>
<hr align="center" width="600" size="10" color=red></center>

		  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  <label for="textuniv" class="control-label"><b><h4>Universidade:</b></h4></label>
		  <br>
		  
		 <?php 
		 $univer = $linha2["id_universidade"]; //id_universidade
		 $sqlun="select nome from universidade where id_universidade=$univer";

 $resultado1= pg_query($conecta, $sqlun);
 $qtde1=pg_num_rows($resultado1);
 if ($qtde1 > 0)
 {
		 $linha1=pg_fetch_array($resultado1);
		 ?>
	
		 <?php echo $linha1['nome']?>
 <?}?>
		</div>
		<br>

<div class='form-group  col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
 
            	   
		   <label for="textdif" class="control-label"><b><h4>Dificuldade do curso SoftBio:</b></h4></label>
		   <br>
		   		<?php echo $linha2["dificuldade"];?>

</div>


		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textCurso" class="control-label"><b><h4>Curso universitário desejado:</b></h4></label>
				<br>
				<?php echo $linha2["curso"]?>
				  
	</div>
	</div>
	<br><br><br>
	<div class="row">

<?


		$_SESSION["nome"]=$linha2["nome"];
		$_SESSION["email"]=$linha2["email"];
		$_SESSION['senha']=$linha2["senha"];
		$_SESSION['nascimento']=$linha2["datanasc"];

		
		$_SESSION['dificuldade']=$linha2["dificuldade"];
		$_SESSION['curso']=$linha2["curso"];
		$_SESSION['universidade']=$linha2["id_universidade"];
		
	
		?>
		 <div class='form-group col-md-7 col-xs-8 col-xs-offset-2'>
		  <center>
		  	<a href="editarusua.php">
   <input type="button" class="button" value="Editar dados"/></a>



		  </div>
		

															

  
</div>
    </div>

		  </div>


	</form>
 
<div id="footer">
</div>
 
  </body>
  </html>
