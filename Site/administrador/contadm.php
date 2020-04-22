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
	  $("#navbar").load("../navbar.php?p=contadm");
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


			if($_SESSION['emailveri']==null)
			{
				$email= $_POST["emailusu"];
			}
			else
			{
				$email= $_SESSION['emailveri'];
				$_SESSION['emailveri']=null;
			}
		
		$_SESSION['email']=$email;
	
		
		 $sql="select * from cadastro where email='$email'";

 $resultado2= pg_query($conecta, $sql);
 $qtde2=pg_num_rows($resultado2);
 if ($qtde2 > 0)
 {
		 $linha2=pg_fetch_array($resultado2);
 }
		

 
 		$sql5="select * from login where email='$email'";

		 $resultado5= pg_query($conecta, $sql5);
		 $qtde5=pg_num_rows($resultado5);
		 if ($qtde5 > 0)
		 {
				 $linha5=pg_fetch_array($resultado5);
		 }
			$_SESSION['tipo']=$linha5["adm"];

	
 ?>
		

<div class="container-fluidcad contentpagina">
<form action="editarusua.php" method="post">


	
		<div class="container-fluida">
	    
					<!--<div class='form-group col-md-12 col-xs-12 '>

		  <!--<div class="row text-center" id="colorida" >  </div>-->

		 <div class="row"><!--Título-->
            <div class="col-lg-12">
                <center><h1 >Conta do usuário<br>
                    <small>Verifique se os dados estão corretos</small>
					<hr>
                </h1></center>
            </div>
       </div>
		<!--</div>-->
	</div>
	  
	
  <!--<center><span class="faixa">Sobre</span></center>-->
<br>
	
		<div class="row">
<center><h4>Informações do Usuário</h4>
<hr></center>
				<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				

				<label for="inputEmail" class="control-label"><b><h4>E-mail:</b></h4></label>
			<br>
				<?php  echo $linha2['email'];?>
				
		
			</div>
			<br>

			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="textNome" class="control-label"><b><h4>Nome:</b></h4></label>
				<br>
				
						<?php echo  $linha2['nome'];?>
				
			</div>


	<br>

	

		  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  <label for="textnasc" class="control-label"><b><h4>Nascimento:</b></h4></label>
		  <br>

		  <?php 
		  $nascimento=$linha2['datanasc'];
		  echo date('d/m/Y',  strtotime($nascimento)); ?>
		  		
		  
		  </div>

		  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  <label  class="control-label"><b><h4>Tipo de Usuário:</b></h4></label>
				<div class="input-group">
			
	 
	  <?

	
	  if($linha5["adm"]=='s')
	  {
		 echo "Administrador";
	  }
	  else
	  {
		  
		echo "Usuário";
	  }
	  ?>
		</div>    
		  </div>
	</div>

</div>
   
		<br>

<center><h4>Informações do Curso</h4>
<hr></center>
<div class="row">
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
	<br><br>
	
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
	
		 <div class='form-group col-md-8 col-xs-8 col-xs-offset-2'>
		  <center>
<a href="mostrausu.php"><input type="button" class="btn btn-primary" value="Voltar"/></a>
		  	<a href="editarusua.php">
   <input type="button" class="btn btn-primary" value="Editar dados"/></a>
   
		<?php if($linha5["excluido"]=="n")
				{
					?>
	 <a href="#modalexcluir" data-toggle="modal"><input type="button" class="btn btn-primary" data-toggle="modal" value="Excluir usuário"/></a>
		
		
			<?php
				} 
			else{
				?>
	 <a href="#modalreativar" data-toggle="modal"><input type="button" class="btn btn-primary" data-toggle="modal" value="Reativar usuário"/></a>

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
              <h3 class="modal-title"><b>Deseja realmente excluir este usuário?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="excluirusuario.php" method="post">
		
		
		
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
              <h3 class="modal-title"><b>Deseja realmente reativar este usuário?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="reativarusuario.php" method="post">
		
		
				<button type="submit" class="btn btn-primary" id="finalizar">Reativar</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
    </div>
	
	
	
	
	
	
	
	<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/holder.min.js"></script>
	

	<footer id="footer" class="footer">
	</footer>

 </body>

</html>