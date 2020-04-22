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
	
	<title>Softbio - Cadastro de conteúdo</title>	
	<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">
	<link href="../css/questoes.css" rel="stylesheet">

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/apendices.css" rel="stylesheet">
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
	<script src="../js/cadastro.js"></script>
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
<style>
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  background-color: #53c653;
  border-color: #53c653;
}
.pagination > li > a,
.pagination > li > span {
  color:#53c653;
}
</style>
 <script>
	$(document).ready(function(){
	$('[data-toggle="popover"]').popover();  
	$(this).popover('show');
	});

	window.onbeforeunload = function(event) {
	event.returnValue = "asdasdfasdf";
	};

	function tiraVerificacao(){
	window.onbeforeunload = null;
	};
</script>

<div class="contentpagina">
  <?php
  /*Início do php*/
  include "conexao.php";
  session_start();		
if(strlen($_POST['titulo']) != 0) 	
{
$_SESSION['titulo']=$_POST['titulo'];
}
else 
	$_SESSION['titulo']="";

  $titulo=$_SESSION['titulo'];
  
  ?>

  <div class="container">
	<div class="row text-center" style="height:35%; margin-left:2px;" >
		<h1><b>Alteração de Conteúdo</b>
 				<a href="#" title="Instruções básicas" data-toggle="popover" data-trigger="hover" data-content="O conteúdo do SoftBio é dividido em slides, por favor, filtre as subunidades para poder alterar os slides cadastrados na mesma! :)">   <span class="glyphicon glyphicon-question-sign hidden-xs" aria-hidden="true" style="font-size:35px; margin-top:10px;"></span>	</a>
        </h1>
		<div class="row">
			<div class="has-warning"><!--Mensagem de erro-->
				<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
				<center><label for="warning" class="control-label"><?php  echo $_SESSION["subunidadehope"];?>Escolha a subunidade que deseja alterar os slides cadastrados.</label></center>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12" >
		<div class="form-group row">
			<h3>Filtrar por título:</h3>
			<form method="post" action="alterarconteudo.php" onsubmit="tiraVerificacao();">
				<input type="text" class="form-control" id="titulo" name="titulo" value="<?php if($titulo!="") echo $titulo;?>"><br>
				<input type="submit" class="btn btn-primary" value="Filtrar">
			</form>
		</div>

		 <div class="col col-md-12">

		
		<?php

		if($titulo=="" || $titulo==null)
		{
		$sql="SELECT conteudo.id_subunidade,max(conteudo.id_slide), subunidade.dificuldade,subunidade.subunidade FROM conteudo INNER JOIN subunidade ON conteudo.id_subunidade=subunidade.id_subunidade WHERE subunidade.excluido = 'n'GROUP BY conteudo.id_subunidade, subunidade.dificuldade, subunidade.subunidade ORDER BY subunidade ASC";

		}
		else{
			$titulosql=strtolower("%".$titulo."%");
			$sql="SELECT conteudo.id_subunidade,max(conteudo.id_slide), subunidade.dificuldade,subunidade.subunidade FROM conteudo INNER JOIN subunidade ON conteudo.id_subunidade=subunidade.id_subunidade WHERE subunidade.excluido = 'n' and lower(subunidade.subunidade) LIKE '$titulosql' GROUP BY conteudo.id_subunidade, subunidade.dificuldade, subunidade.subunidade ORDER BY subunidade ASC";
		}
		$resultado= pg_query($conecta, $sql);
		$total=pg_num_rows($resultado);
	 // Executa a consulta
				// Verifica se $pagina existe, senão deixa na primeira página como padrão
				$pagina = (isset($_POST["pagina"])) ? ($_POST["pagina"]) : 1;
				// Defina aqui a quantidade máxima de registros por página.
				if($pagina==1){
					$limite = 9;
				}
				else{
					$limite = 9;
				}
				// O sistema calcula o início da seleção fazendo:
				// (página atual * quantidade por página) - quantidade por página
				
				$inicio = ($pagina * $limite) - $limite;
				
				$tot_paginas = ceil($total / 9);

		$sql=$sql." limit $limite offset $inicio";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
		

		if($qtde > 0)
		{	
			?>
			<table class="table table-bordered table-hover">
				  <thead>
					<tr>
					  <th>Subunidade</th>
					  <th>Número de Slides</th>
					  <th>Dificuldade</th>
					</tr>
				  </thead>
				  <tbody>
			<?php  
				
			while($linha = pg_fetch_array($resultado))
			{ ?>
				<form action="alterarconteudopagina.php" method="post" id="<?php echo $linha['subunidade'];?>">
					<tr onclick="tiraVerificacao(); document.getElementById('<?php echo $linha['subunidade'];?>').submit();" style="cursor:pointer;">
					  <td><?php echo $linha['subunidade'];?></td>
					  <td><?php echo $linha[1];?></td>
					  <td><?php echo $linha[2];?></td>
					</tr>
				<input type="hidden" name="id_subunidade" value="<?php echo $linha['id_subunidade'];?>">
				<input type="hidden" name="subunidade" value="<?php echo $linha['subunidade'];?>">
				</form>
			<?php
			}
			?>
				</tbody>
			</table>
			<?php
		}
		else
		{?>
			<div class="jumbotron">
			<h1>Nenhuma conteúdo encontrado</h1>
			<p>Tente refazer a busca ou então cadastrar conteúdo!</p>
			<p><a onclick="tiraVerificacao();" href="http://200.145.153.172/hope/tcc/administrador/cadastrarconteudo.php" class="btn btn-primary btn-lg" href="#" role="button">Cadastro de Conteúdo</a></p>
			</div>
				
			<?php
		}

		
		?>

		 </div>
		 
		 </div>



	<div class="row">
	
	<script>
	 function pagina(pagina2){
		document.getElementById("pagina").value = pagina2;			
		document.getElementById("paginacao").submit();	
     	}
</script>	 
<form action="alterarconteudo.php" method="post" id="paginacao"> 
	<input type="hidden" name="pagina" id="pagina" value=""> 
	<input type="hidden" name="titulo" id="titulo" value="<?php echo $titulo;?>"> 
	</form>
	
	
	
	
		<center>
	   		<div class="paginas">
				<nav aria-label='Page navigation'>
				<ul class='pagination pagination-lg pagination-sm'>
					<?php	
	$antes = $pagina-1;
    $depois = $pagina+1;
//antes      
      if($antes>0)
     	 echo "<li><a onclick=\"pagina($antes); tiraVerificacao();\" aria-label='Previous'> <span aria-hidden='true'>&laquo;
     	</span> </a>  </li>";
      else
      	echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
     	</span> </a>  </li>";
//numeros 
  for($i = 1; $i <=$tot_paginas ; $i++) {

	  	if ($i==$pagina)
	    	echo"<li class='active'><a onclick=\"pagina($i);tiraVerificacao();\">$i</a></li>";
		else 
			echo "<li><a onclick=\"pagina($i); tiraVerificacao();\" >$i</a></li>"; }


      if($depois<=$tot_paginas)
     	 echo "<li> <a onclick=\"pagina($depois); tiraVerificacao();\" aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
      else
      	echo"<li class='disabled'> <a class='disabled' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";

echo"</ul></nav>";
					?>
					
		</center>
	</div>
	   
	</div>
	</div>

		<div class="row">
			<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://200.145.153.172/hope/tcc/administrador/index.php" class="btn btn-primary" onclick="tiraVerificacao();" >Voltar</a></center>
			<br><br>
		</div>



</div>
	
	<footer id="footer" class="footer">
	</footer>

			<script src="../js/bootstrap.min.js"></script>
		<script src="../js/holder.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 
	 
 </body>

</html>