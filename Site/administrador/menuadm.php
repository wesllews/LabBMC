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
	
	
		<title>Softbio - Usuários</title>

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


$sql_contagem="select * from login where adm='s' and email!='adm@adm.com' order by email ASC";


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
	<div class="contentpagina">
	
				<div id="paginacao">
				
				
	  
			  
    <center><h1 class="page-header titulo">Administradores<br>
                  <br>
					    </h1>


					<div id="produtos">
						<div class="container">
						<div class="row">
						<div class="table-responsive" >
						<form method="POST" action="conta.php">
						<table class="table table-hover" >
						 <thead>
							<tr>
								<th></th>
								<th>E-mail</th>
								<th>Nome</th>
							</tr>
						 </thead>
							  <tbody id="myTable">
								<tr>
						<?php
					
						$sql = "select * from login
						where  adm='s' and email!='adm@adm.com'
						order by email ASC
						limit $limite offset $inicio"; 

			
						$resultado= pg_query($conecta, $sql);
						$qtde=pg_num_rows($resultado);
						
						
					
						if ($qtde > 0)
						{

							 while($linha = pg_fetch_array($resultado)) 
							 {
								 $cont++;
								 
							$_SESSION['cont']=$cont;
							?>
							
							
							<div class="texto_produto">
							<td><? echo$cont?></td>
							<?if ($linha["excluido"]=='s')
							{
								?>
								
								<td><button name="emailadm" value="<?php echo $linha[email] ?>" class="excluidinho"><?php echo $linha[email];?> </button></td>
								<td><button name="emailadm" value="<?php echo $linha[email] ?>" class="excluidinho"><?php echo $linha[nome];?> </button></td>
								</tr>
								<?
							}
							else
							{?>
								<td><button name="emailadm" value="<?php echo $linha[email] ?>" class="linkinho"><?php echo $linha[email];?> </button></td>
								<td><button name="emailadm" value="<?php echo $linha[email] ?>" class="linkinho"><?php echo $linha[nome];?> </button></td>
								</tr>
								
						<?	}
							
				?>
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
											echo "<li><a href='menuadm.php?pagina=$antes' aria-label='Previous'> <span aria-hidden='true'>&laquo;
											</span> </a>  </li>";
										else
											echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
											</span> </a>  </li>";
									//numeros 
										for($i = 1; $i <=$tot_paginas ; $i++) {
											if ($i==$pagina)
												echo"<li class='active'><a href='menuadm.php?pagina=$i'>$i</a></li>";
											else 
												echo "<li><a href='menuadm.php?pagina=$i'>$i</a></li>";
										}
										
										if($depois<=$tot_paginas)
											echo "<li> <a href='menuadm.php?pagina=$depois' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
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
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>
  </html>
