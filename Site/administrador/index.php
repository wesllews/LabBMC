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
	
	
		<title>Softbio - Home</title>
	
<link href="assets/css/index.css" rel="stylesheet">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/holder.min.js"></script>

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
	<?

		include "conexao.php";
	session_start();?>
	<body>
	
<div class="contentpagina">
<br>
     

<div class="container"> 

<div class="row">

<div  class="quadradounidade1 col-md-5 col-xs-10">
	<div class="unidade">
		 <h2>Cadastrar</h2>
	</div>

	<div class="subunidade">
	<?
	
	if($_SESSION['usuario']=='adm@adm.com')
		{?>
					<h3 class="subuni" onclick="javascript:location.href='cadastradm.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Administrador</h3>
		<?}
	
	?>
					
					<h3 class="subuni" onclick="javascript:location.href='cadastrarconteudo.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Conteúdo</h3>
					<?php
					session_start();
					$_SESSION['idslide']=1; 
					$_SESSION['correto']=null;
					unset($_SESSION["subunidadehope"]);?>
			
					<h3 class="subuni" onclick="javascript:location.href='cadastrarcuriosidades.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Curiosidades</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='cadastrarnoticia.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Notícias</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='cadastrarquestao.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Questões</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='cadastrosubunidade.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Subunidade</h3>
							
					<h3 class="subuni" onclick="javascript:location.href='cadastrounidadeadm.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Unidade</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='cadastrauni.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Universidade</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='cadastraradmnormal.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Usuários</h3>
		
	</div>
</div>

<div class="col-md-2 col-xs-12"></div>

<div  class="quadradounidade col-md-5 col-xs-10">
	<div class="unidade">
		 <h2>Alterar/Excluir</h2>
	</div>

	<div class="subunidade">
<?
	$_SESSION["id"]=null;
		$_SESSION['texto']=null;
			$_SESSION['titulo']=null;
			$_SESSION['fonte']=null;
			$_SESSION['data']=null;

	
	if($_SESSION['usuario']=='adm@adm.com')
		{?>
					<h3 class="subuni" onclick="javascript:location.href='menuadm.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Administrador</h3>
		<?}
	
	?>
					<h3 class="subuni" onclick="javascript:location.href='alterarconteudo.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Conteúdo</h3>
					
				    <h3 class="subuni" onclick="javascript:location.href='editarcuriosidades.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Curiosidades</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='listanoticias.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Notícias</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='menuquestoes.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Questões</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='menualterasub.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Subunidade</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='menualteraunidade.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Unidade</h3>
					
					<h3 class="subuni" onclick="javascript:location.href='menuni.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Universidade</h3>
					
					
					<h3 class="subuni" onclick="javascript:location.href='mostrausu.php'">
					<span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
					Usuários</h3>
			
	</div>
</div>


</div>
</div>
 <br>
<br> 

	</div>
	<footer id="footer" class="footer">
	</footer>

 </body>

</html>