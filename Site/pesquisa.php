<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./img/logos/sb.ico">	

  <title>Softbio - Pesquisa</title>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/questoes.css">

  
    <script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
    $("#navbar").load("navbar.php?p=pesquisa&teste=s");
    });
	
    </script> 
</head>

<div id="navbar"></div>

<body>  

<div class="container contentpagina">

<?php 
include "/administrador/substituir.php";
include "conecta.php";
session_start();

	if (!isset($_SESSION["logou"]))
	{
		$_SESSION['pagina_antes_login'] = 'pesquisa.php';
		header("Location: login.php");

	}


function limitarTexto($texto, $limite){
  $contador = strlen($texto);
  if ( $contador >= $limite ) {      
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')).' ...';
      return $texto;
  }
  else{
    return $texto;
  }
} 

function botão($categoria,$um,$dois){
	if($categoria=="noticia")
	{ 
		echo' <form method="post" action="texto.php" onsubmit="tiraVerificacao();">
				 <input type="hidden" name="id_noticia" value="'.$dois.'">
				<input type="submit" class="btn btn-success" value="Ver notícia" >
			</form>';
	}
	else if($categoria=="curiosidades")
	{ 
		echo' <form method="post" action="lermais.php" onsubmit="tiraVerificacao();">
				 <input type="hidden" name="id_curiosidades" value="'.$dois.'">
				<input type="submit" class="btn btn-success" value="Ver notícia" >
			</form>';
	}
	
	else if($categoria=="questao")
	{ 
		echo' <form method="POST" action="questoes.php" onsubmit="tiraVerificacao();">
				 <input type="hidden" name="subunidade" value="'.$um.'">
				 <input type="hidden" name="id_questao" value="'.$dois.'">
				<input type="submit" class="btn btn-success" value="Ver questão" >
			</form>';

	}
	else if($categoria=="conteudo")
	{
		echo' <form method="post" action="paginaestudo.php" onsubmit="tiraVerificacao();">
				 <input type="hidden" name="idsubunidade" value="'.$um.'">
				<input type="submit" class="btn btn-success" value="Ver conteúdo" >
			</form>';

	}
	
}






	if($_POST['pesquisa']!=""){
		$pesquisa=$_POST['pesquisa'];
		$_SESSION['pesquisa']=$pesquisa;
		}
	else
		$pesquisa=$_SESSION['pesquisa'];

$categoria =$_POST['categoria'];

$sql1 ="Select frente,unidade,subunidade,REPLACE(texto,'###','</p><p>'),conteudo.id_subunidade from conteudo JOIN subunidade ON (conteudo.id_subunidade=subunidade.id_subunidade) 
JOIN unidade ON (subunidade.id_unidade=unidade.id_unidade)
JOIN frente ON (unidade.id_frente=frente.id_frente) where texto like '%$pesquisa%' or unidade like '%$pesquisa%' or
 subunidade like '%$pesquisa%' or frente like '%$pesquisa%'";

$sql2 ="Select unidade,subunidade,id_questao,REPLACE(pergunta,'###','</p><p>'),questao.id_subunidade,a,b,c,d,e from questao JOIN subunidade ON (questao.id_subunidade=subunidade.id_subunidade) 
JOIN unidade ON (subunidade.id_unidade=unidade.id_unidade)
JOIN frente ON (unidade.id_frente=frente.id_frente) 
where pergunta like '%$pesquisa%' or
 a like '%$pesquisa%' or
 b like '%$pesquisa%' or
 c like '%$pesquisa%' or
 d like '%$pesquisa%' or
 e like '%$pesquisa%' or
 unidade like '%$pesquisa%' or
 subunidade like '%$pesquisa%' or
 frente like '%$pesquisa%' "; 

$sql3 ="Select data,titulo,id_noticia,REPLACE(texto,'###','</p><p>') from noticia where texto like '%$pesquisa%' or titulo like '%$pesquisa%' "; 

$sql4 ="Select data,titulo,id_curiosidades,REPLACE(texto,'###','</p><p>') from curiosidades where texto like '%$pesquisa%' or titulo like '%$pesquisa%' "; 

?>
<h1> Resultados para a pesquisa:  <?php echo $pesquisa;?></h1>
<?php


	if($categoria=="")
	{
			//pesquisa conteudo
		 $resultado= pg_query($conecta, $sql1);
			$total=pg_num_rows($resultado);
		?>

		<div class='panel panel-default'>
		  <div class='panel-heading'>
			<h3 class='panel-title'>Conteúdos </h3>
		  </div>
		  <div class='panel-body'>
		  
		   <b><?php echo $total;?></b>  resultados para sua pesquisa em meio ao nosso acervo de conteúdo.
		   <br>
		   <br>
		   <form method="post" action="pesquisa.php">
			   <input type="hidden" name="categoria" value="conteudo">
			   <?php if($total >0) {?>
					<input type="submit" class="btn btn-success" value="Clique para ver detalhes " > </form>
			   <?php }?>
		  </div>
		</div>
		<?php 
		//pesquisa 	questões
		$resultado= pg_query($conecta, $sql2);
			$total=pg_num_rows($resultado);
		?>
		<div class='panel panel-default'>
		  <div class='panel-heading'>
			<h3 class='panel-title'>Questões</h3>
		  </div>
		  <div class='panel-body'>
			<b><?php echo $total;?></b>  resultados para sua pesquisa disponiveis na nossa página de questões.
			<br><br>
			<form method="post" action="pesquisa.php">
			   <input type="hidden" name="categoria" value="questao">
			   <?php if($total >0) {?>
					<input type="submit" class="btn btn-success" value="Clique para ver detalhes " > </form>
			   <?php }?>
		  </div>
		</div>
		<?php
		//pesquisa 	Curiosidades
		$resultado= pg_query($conecta, $sql4);
		$total=pg_num_rows($resultado);
		?>
		<div class='panel panel-default'>
		  <div class='panel-heading'>
			<h3 class='panel-title'>Curiosidades</h3>
		  </div>
		  <div class='panel-body'>
			<b><?php echo $total;?></b>  resultados para sua pesquisa disponiveis na nossa página de curiosidades.
			<br><br>
			<form method="post" action="pesquisa.php">
			   <input type="hidden" name="categoria" value="curiosidades">
			   <?php if($total >0) {?>
					<input type="submit" class="btn btn-success" value="Clique para ver detalhes"> </form>
			   <?php }?>
		  </div>
		</div>
		<?php
		//pesquisa 	notícias
		$resultado= pg_query($conecta, $sql3);
			$total=pg_num_rows($resultado);

		?>
		<div class='panel panel-default'>
		  <div class='panel-heading'>
			<h3 class='panel-title'>Notícias</h3>
		  </div>
		  <div class='panel-body'>
			<b><?php echo $total;?></b>  resultados para sua pesquisa disponiveis na nossa página de notícias.
			<br><br>
			<form method="post" action="pesquisa.php">
			   <input type="hidden" name="categoria" value="noticia">
			   <?php if($total >0) {?>
					<input type="submit" class="btn btn-success" value="Clique para ver detalhes " > </form>
			   <?php }?>
		  </div>
		</div>
		<?php	
	}
	else{
		/////////////////////////////////////////////////////////////////////////////////////////////
if($categoria=='conteudo')
$resultado= pg_query($conecta, $sql1);

else if($categoria=='questao')
$resultado= pg_query($conecta, $sql2);

else if($categoria=='noticia')
$resultado= pg_query($conecta, $sql3);

else if($categoria=='curiosidades')
$resultado= pg_query($conecta, $sql4);

    $total=pg_num_rows($resultado);
    $pagina = (isset($_POST["pagina"])) ? ($_POST["pagina"]) : 1;
    $limite = 10;
    $tot_paginas = ceil($total / $limite);
    $inicio = ($pagina * $limite) - $limite;

	
if($categoria=='conteudo'){
$sql1 .="limit $limite offset $inicio";
$executabusca= pg_query($conecta,$sql1);
}
else if($categoria=='questao'){
$sql2 .="limit $limite offset $inicio";
$executabusca= pg_query($conecta,$sql2);}

else if($categoria=='noticia'){
$sql3 .="limit $limite offset $inicio";	
$executabusca= pg_query($conecta,$sql3);}

else if($categoria=='curiosidades'){
$sql4 .="limit $limite offset $inicio";	
$executabusca= pg_query($conecta,$sql4);}

  $qtdebusca=pg_num_rows($executabusca);
if ($qtdebusca > 0) 
{
	while($linhaBusca=pg_fetch_array($executabusca))
	{
	?>
		<div class='panel panel-success'>
			<div class='panel-heading'>
				 <h3 class='panel-title'>
					<?php
					if($categoria=='noticia' || $categoria=='curiosidades')
						echo $linhaBusca[1];
					else							
						echo $linhaBusca[0]." <b>&nbsp;&raquo;</b> ".$linhaBusca[1]." <b>&nbsp;&raquo;</b>".$linhaBusca[2];?>
				</h3> 
			</div>

			<div class='panel-body'>
				<?php 
				print(limitarTexto($linhaBusca[3], $limite = 1000));
				botão($categoria,$linhaBusca[4],$linhaBusca[2]);?>
			</div>
		</div>
		
		<?php
	 } 
	 ?>
<script>
	 function pagina(categoria2,pagina2){
		document.getElementById("pagina").value = pagina2;		
		document.getElementById("categoria").value = categoria2;	
		document.getElementById("paginacao").submit();	
     	}
</script>	 
<form action="pesquisa.php" method="post" id="paginacao"> 
	<input type="hidden" name="pagina" id="pagina" value="1"> 
	<input type="hidden" name="categoria" id="categoria" value="a"> 
	</form>
	 
<nav aria-label='Page navigation'>
  <ul class='pagination pagination-lg pagination-sm'>
  <?php
	  $antes = $pagina-1;
      $depois = $pagina+1;
//antes      
      if($antes>0)
     	 echo "<li><a onclick=\"pagina('$categoria',$antes)\" aria-label='Previous'> <span aria-hidden='true'>&laquo;
     	</span> </a>  </li>";
      else
      	echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
     	</span> </a>  </li>";
//numeros 
  for($i = 1; $i <=$tot_paginas ; $i++) {

	  	if ($i==$pagina)
	    	echo"<li class='active'><a onclick=\"pagina('$categoria',$i)\">$i</a></li>";
		else 
			echo "<li><a onclick=\"pagina('$categoria',$i)\" >$i</a></li>"; }


      if($depois<=$tot_paginas)
     	 echo "<li> <a onclick=\"pagina('$categoria',$depois)\" aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
      else
      	echo"<li class='disabled'> <a class='disabled' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";

echo"</ul></nav>";
	 
}	
echo '<div class="row ">
<hr>	
<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="pesquisa.php" class="btn btn-primary">Voltar</a> </center>
	<br>
	</div>';	
	}

?>
</div>
   <footer id="footer" class="footer">
</footer>
</body>

</html>
