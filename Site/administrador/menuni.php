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
	
	
		<title>Softbio - Universidades</title>

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">	
		<link href="../css/tabela.css" rel="stylesheet">	
		

	<script src="../bootstrap/jquery.js"></script>

    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");
    });


</script>
<script>
$(document).ready(function(){
   $("a").click(function(){
	 var ide= document.getElementsById(nome).value;
		alert(ide);
        $.ajax(
		{ 
	
			url: "meuajax.php",
			//data: { iduni: iduni}
			success: function(result){
            $("#div1").html(result);
        }});
    });
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

		
$batman=$_GET['pagina'];
if($batman >1)
{
	$cont=$_SESSION['cont'];
}

$sql_contagem="select * from universidade where  excluido='n' order by nome ASC";


$resultado= pg_query($conecta, $sql_contagem);
$total=pg_num_rows($resultado);

   // Executa a consulta
				// Verifica se $pagina existe, senão deixa na primeira página como padrão
				$pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
				// Defina aqui a quantidade máxima de registros por página.
				if($pagina==1){
					$limite = 10;
				}
				else{
					$limite = 10;
				}
				// O sistema calcula o início da seleção fazendo:
				// (página atual * quantidade por página) - quantidade por página
				if ($pagina==2){
					$inicio = ($pagina * $limite) - $limite - 1;
				}
				else{
					$inicio = ($pagina * $limite) - $limite;
				}
				$tot_paginas = ceil($total / 10);
?>	
	<div id="div1"class="contentpagina ">
	
				<div id="paginacao">
				
				<form method="POST" action="mostrauni.php">
	  
			  
    <center><h1 class="page-header titulo">Universidades<br>
                  <br>
					    </h1>


					<div id="produtos">
						<div class="container">
						<div class="row">
						<div class="table-responsive" >
						<table class="table table-hover" >
						 <thead>
							<tr>
								<th></th>
								<th>Universidade</th>
							
								<th>Sigla</th>
							</tr>
						 </thead>
							  <tbody id="myTable">
								<tr>
						<?php
					
						$sql = "select * from universidade
						where  excluido='n'
						order by nome ASC
						limit $limite offset $inicio"; 

			
						$resultado= pg_query($conecta, $sql);
						$qtde=pg_num_rows($resultado);
						
						
					
						if ($qtde > 0)
						{

							 while($linha = pg_fetch_array($resultado)) 
							 {
								 $cont++;
							$idezinho=$linha[id_universidade];
							$_SESSION["cont"]=$cont;
							?>
							<var id="nome"><?$idezinho?></var>
							
							<div class="texto_produto">
							<td><? echo$cont?></td>
								
								<td><button  name="iduni" value="<?php echo $idezinho ?>" class="butao"><?php echo $linha[nome];?> </button></td>
								<td><button  name="iduni" value="<?php echo $idezinho ?>" class="butao"><?php echo $linha[sigla];?> </button></td></tr>
								
							
				
						</div>							
					


						<?php
						}
						}
						else{
							echo "<strong>Não foi encontrado nenhum usuário!</strong>";
						}
					?>
			         </tbody>
        </table>
</form>		
      </div>

	</div>
</div>
   
	   <center>
	   		<div class="paginas">
				<nav aria-label='Page navigation'>
				<ul class='pagination pagination-lg pagination-sm'>
					<?php	
						$antes = $pagina-1;
						$depois = $pagina+1;
					//antes      
						if($antes>0)
							echo "<li><a href='menuni.php?pagina=$antes' aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
						else
							echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
					//numeros 
						for($i = 1; $i <=$tot_paginas ; $i++) {
							if ($i==$pagina)
								echo"<li class='active'><a href='menuni.php?pagina=$i'>$i</a></li>";
							else 
								echo "<li><a href='menuni.php?pagina=$i'>$i</a></li>";
						}
						
						if($depois<=$tot_paginas)
							echo "<li> <a href='menuni.php?pagina=$depois' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						else
							echo"<li class='disabled'> <a class='disabled' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						
						echo"</ul></nav>";
					?>
					
						</div>
				</center>
				
				</div>
			</div>
	

	
	</center>
	
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/holder.min.js"></script>
 </body>
 </div>
	<footer id="footer" class="footer">
	</footer>

  </html>
