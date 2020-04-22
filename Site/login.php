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


    <title>Softbio - Login</title>
	  <script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php?p=login");
    });
    </script>
    <link href="css/bootstrap-theme.css" rel="stylesheet">
	  <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/formatacaobibi.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  	<script src="js/formulario.js"></script>
  </head>
    <div id="navbar">
	
</div>
<!-- NAVBAR
================================================== -->
  <body>
  <?php
  
  /*Início do php*/
  include "conecta.php";
 	session_start();						

  /*Criação das sessions para armezenar as coisinhas do login*/
	$_SESSION["usuario"];
	$_SESSION["senha"];  
	$_SESSION["email"]=null;  
  
	if(isset($_SESSION["correto"])){
	  $correto=$_SESSION["correto"];
  }
  else{
    $_SESSION['correto']=null;
  }
  ?>
  	<div class="contentpagina">


     <div class="container"  id="maelogin">


    <!--form horizontal um em baixo do outro
    col-md muda o tamanho
    form-group coloca margin bottom 20px aprox
    -->

    <form class="form-inline" id="form" name="login" action="validacao.php" method="post">
    
	<h1><b><font face="brandonreg">Login</h1></b>
	  <?php if($correto == 1){?>
      <div class="col col-md-10 col-md-offset-1 alert alert-danger" style="font-size: 15px;">
      Email não cadastrado!
      </div>
		  <?php

		}


		?>

      <?php 
     if($correto == 2){?>
  <div class="col col-md-10 col-md-offset-1 alert alert-danger" style=" height: 5%; font-size: 15px;">
      Email e senha não conferem!
      </div>
		  <?php

		}


    $_SESSION["correto"]=0;

    
	  ?>
      <div class="row">
      <div class="form-group col-md-4">
	          <label class="control-label">Email</label>
      <input type="text" class="form-control input-lg" placeholder="Digite seu email" id="loginemail" name="email"   onBlur="validaEmail()" value="<?php if($_SESSION["usuario"]!="") echo $_SESSION["usuario"];?>" required>


      </div>

      </div>
		<br>
      <div class="row">
      <div class="form-group col-md-4">
	  <label class="control-label">Senha</label>
 <input type="password" class="form-control input-lg" 
	  name="senha" id="loginsenha" placeholder="Digite sua senha" 
	  maxlength="32" required>
     
      </div>
      </div>

  <br>
    <div class="col-sm-offset-2 col-sm-10 col-xs-10 col-xs-offset-2">
      <button type="submit" class="btn btn-default" id="entrar">Entrar</button>
   
	
    </div>
 


      Ainda não possui conta? <a href="cadastrar.php" >Cadastre-se!</a>
	  
	  <!--janela modal, código adaptado de Maurício 'Maujor' Samy Silva-->
	  <a href="#modalEsqueciSenha" data-toggle="modal">Esqueci a senha</a>
	  <!-- Conteúdo da janela modal normal -->
	



    </form>
	
  </div>
  
  <div  class="modal fade" id="modalEsqueciSenha" tabindex="-1" role="dialog" aria-labelledby="modalEsqueciSenhaLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Esqueci a senha</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="phpmailer/esqueciasenha.php" method="post">
              <label for="email">Email de acesso ao site</label>
		<input type="text" name="emailesqueci" class="form-control input-lg" placeholder="Digite seu email cadastrado" value="<?php echo $_SESSION["usuario"];?>" id="esquecisenhaemail" required><br><center>
		<button type="submit" class="btn btn-default" id="esquecisenha">Esqueci a senha</button>
              </form>
            </div>
			<!--
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>-->
        </div> 
			</div>  
  
    
    
          </font>

    
    </div> <!-- /.col-* --> 

	          <!--<li class="pull-right"><a href="#"><span class="glyphicon glyphicon-chevron-up" width="200";></span></a></li>-->
     </div><!-- /.container-fluid -->  
   </center>

	<footer id="footer" class="footer">
	</footer>
 </body>
</html>
