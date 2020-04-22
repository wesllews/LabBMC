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
	
	
		<title>Softbio - Editar curiosidades</title>
		
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
		<script src="../bootstrap/jquery.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/noticias.css"/>
	<link rel="stylesheet" type="text/css" href="../css/curiosidades.css"/>
	
	<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/holder.min.js"></script>
	
	
	<script src="../js/codigos.js"></script>
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

	<div class="container contentpagina">
		<div class="row"><!--Título-->
            <div class="col-lg-12">
                <center><h1 >Curiosidades<br>
                    <small>Alteração de curiosidades</small>
					<hr>
                </h1></center>
            </div>
       </div>
	   <div class="row">
	   <form method="post"  action="edicaocuriosidade.php">
		<center>
	   <?php
			include "conexao.php";
			session_start();
			clearstatcache(); 

			$_SESSION["id"]=null;
			$_SESSION['texto']=null;
			$_SESSION['titulo']=null;
			$_SESSION['fonte']=null;
			$_SESSION['data']=null;
			//unset($_SESSION["id_curiosidades"]);
			
			$sql_contagem="select * from curiosidades order by titulo ASC";


			$resultado= pg_query($conecta, $sql_contagem);
			$total=pg_num_rows($resultado);

   // Executa a consulta
				// Verifica se $pagina existe, senão deixa na primeira página como padrão
				$pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
				// Defina aqui a quantidade máxima de registros por página.
				if($pagina==1){
					$limite = 5;
				}
				else{
					$limite = 6;
				}
				// O sistema calcula o início da seleção fazendo:
				// (página atual * quantidade por página) - quantidade por página
				if ($pagina==2){
					$inicio = ($pagina * $limite) - $limite - 1;
				}
				else{
					$inicio = ($pagina * $limite) - $limite;
				}
				$tot_paginas = ceil($total / 6);
	   if($pagina==1){
			echo "<div class='column'>";
				echo"<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
					echo"<div class='post-module'>";
						echo"<a href='cadastrarcuriosidades.php' class='link-preto'>";
					echo"<div class='thumbnail'>";
						echo"<img src='../img/noticias/plus.png' class='img-rounded'/></img>";
					echo"</div>";
				echo"<div class='post-content'>";
					echo"<div class='dia'> <br></div>";
					echo"<h3 class='title'>INCLUIR CURIOSIDADE</h3>
			
				</div>
				
				</a>
				</div>
			</div>
			</div>";
	   }
	   
	   
			?>
			
			<div id="paginacao">
			
			<?php
			
			
			$sql="Select * from curiosidades order by id_curiosidades desc limit $limite offset $inicio";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado); 

			if ($qtde > 0)
			{
			
			for ($cont=0; $cont < $qtde; $cont++)
			{
				$linha=pg_fetch_array($resultado);
				
				//$_SESSION["idcuriosidade"]=$linha["id_curiosidades"];
					
					echo "<div class='column'>";
				echo"<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
			
			$id=$linha['id_curiosidades'];
			$imagem=$linha['imagem'];
			echo"<form action='edicaocuriosidade.php' method='post'>";
			
			echo"<input type='hidden' name='id_curiosidades' id='id_curiosidades' value='$id'>";
					echo"<div class='post-module'>";
					
				echo"<button type='submit' name='submit' class='button'>";
				
				echo"<div class='thumbnail'>";
				
					$nome_final= "../img/curiosidades/".$imagem.".jpg";
					if(file_exists($nome_final))
					{
						echo"<img src='".$nome_final."' class='img-rounded'/></img>";
					}
					else
					{
						echo"<img src='../img/curiosidades/homem.png' class='img-rounded'/></img>";
					}
					
				echo"</div>";
				
				echo"<div class='post-content'>";
					echo"<div class='dia'>".date('d/m/Y',  strtotime($linha['data']))."</div>";
					
					if($linha["excluido"]=="s")
					{
						echo"<h3 class='title1'>".$linha['titulo']."</h3>";
					}
					else{
						echo"<h3 class='title'>".$linha['titulo']."</h3>";
					}
				
					
			
				echo "</div>
				
						</div>
				
				
				</button>
		</div>
			</form>
			</div>";
			
				}
			}
			else
			echo "Erro na busca!!!<br><br>";
			
				
		?>
		
		
		</center>	
	   </div>
	   
	   
  <div class="row">
	   <center>
	   		<div class="paginas">
				<nav aria-label='Page navigation'>
				<ul class='pagination pagination-lg pagination-sm'>
					<?php	
						$antes = $pagina-1;
						$depois = $pagina+1;
					//antes      
						if($antes>0)
							echo "<li><a href='editarcuriosidades.php?pagina=$antes' aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
						else
							echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
					//numeros 
						for($i = 1; $i <=$tot_paginas ; $i++) {
							if ($i==$pagina)
								echo"<li class='active'><a href='editarcuriosidades.php?pagina=$i'>$i</a></li>";
							else 
								echo "<li><a href='editarcuriosidades.php?pagina=$i'>$i</a></li>";
						}
						
						if($depois<=$tot_paginas)
							echo "<li> <a href='editarcuriosidades.php?pagina=$depois' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						else
							echo"<li class='disabled'> <a class='disabled' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						
						echo"</ul></nav>";
					?>
					
						</div>
				</center>
				</div>
	
			</div>

	   
	</div>
	</form>
	
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>