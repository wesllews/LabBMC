<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Softbio - Notícias</title>
	
	<link rel="icon" href="./img/iconesub/sb.ico">
	    <link rel="icon" href="img/logos/sb.ico">

	<script src="bootstrap/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/noticias.css"/>
	<?php
		session_start();
	?>
	<script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  	$("#navbar").load("navbar.php?p=noticias");
    });
    </script> 
	
</head>

	<div id="navbar">
	</div>

<body>

	<div class="container contentpagina">
		<div class="row"><!--Título-->
            <div class="col-lg-12">
                <center><h1 >Notícias<br>
                    <small>Mantenha-se informado</small>
					<hr>
                </h1></center>
            </div>
       </div>
	   <div class="row"><!--Noticias-->
		<center>
	   <?php
			include "conecta.php";
			
			$sql="Select * From noticia where excluido='n' order by data desc";
			$resultado= pg_query($conecta, $sql);
			$total=pg_num_rows($resultado);
			
			
			// Executa a consulta
				// Verifica se $pagina existe, senão deixa na primeira página como padrão
				$pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
				// Defina aqui a quantidade máxima de registros por página.
				$limite = 6;
				// O sistema calcula o início da seleção fazendo:
				// (página atual * quantidade por página) - quantidade por página
				$inicio = ($pagina * $limite) - $limite;
				$tot_paginas = ceil($total / $limite);
				// seleciona os itens a serem apresentados por página. Uso de LIMIT e OFFSET:
			

			$sql="Select * From noticia where excluido='n' order by data desc limit $limite offset $inicio";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
			if ($qtde > 0)
			{
			
			for ($cont=0; $cont < $qtde; $cont++)
			{
				$linha=pg_fetch_array($resultado);
				
				
					echo "<div class='column'>";
				echo"<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
			
				$id=$linha['id_noticia'];
				$imagem=$linha['imagem'];
				
				echo"<form action='texto.php' method='post'>";
				echo"<input type='hidden' name='id_noticia' id='id_noticia' value='$id'>";
					echo"<div class='post-module'>";
				echo"<button type='submit' name='submit' class='button'>";
			
				echo"<div class='thumbnail'>";
				$nome_final= "img/noticias/".$imagem.".jpg";
					if(file_exists($nome_final))
					{
						echo"<img src='".$nome_final."' class='img-rounded'/></img>";
					}
					else
					{
						echo"<img src='img/noticias/jornal.png' class='img-rounded'/></img>";
					}
					echo"</div>";
				
				echo"<div class='post-content'>";
					echo"<div class='dia'>".date('d/m/Y',  strtotime($linha['data']))."</div>";
					echo"<h3 class='title'>".$linha['titulo']."</h3>
			
				</div>
				
				</button>
			</div>
			</form>
			</div>";
			
				}
			}
			else
			echo "Erro na busca!!!<br><br>";
			// Fecha a conexão com o PostgreSQL
			pg_close($conecta); 
			
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
							echo "<li><a href='noticias.php?pagina=$antes' aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
						else
							echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
					//numeros 
						for($i = 1; $i <=$tot_paginas ; $i++) {
							if ($i==$pagina)
								echo"<li class='active'><a href='noticias.php?pagina=$i'>$i</a></li>";
							else 
								echo "<li><a href='noticias.php?pagina=$i'>$i</a></li>";
						}
						
						if($depois<=$tot_paginas)
							echo "<li> <a href='noticias.php?pagina=$depois' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						else
							echo"<li class='disabled'> <a class='disabled' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						
						echo"</ul></nav>";
					?>
					
						</div>
				</center>
				</div>
	</div>
	
	<footer id="footer" class="footer">
	</footer>
	
</body>


</html>