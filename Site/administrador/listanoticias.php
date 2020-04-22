<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Softbio - Cadastro de notícias</title>
	
	<link rel="icon" href="../img/logos/sb.ico">
	
	<script src="../bootstrap/jquery.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/noticias.css"/>
	<link rel="stylesheet" href="../css/apendices.css"/>
	
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
                <center><h1 >Manutenção de Notícias<br>
                    <small>Selecione uma notícia para editar</small>
					<hr>
                </h1></center>
            </div>
       </div>
	   <div class="row"><!--Noticias-->
		<center>
	   <?php
	   
	   include "conexao.php";
	   
			$sql="Select * From noticia order by data desc";
			$resultado= pg_query($conecta, $sql);
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
						echo"<a href='cadastrarnoticia.php' class='link-preto'>";
					echo"<div class='thumbnail'>";
						echo"<img src='../img/noticias/plus.png' class='img-rounded'/></img>";
					echo"</div>";
				echo"<div class='post-content'>";
					echo"<div class='dia'> <br></div>";
					echo"<h3 class='title'>INCLUIR NOTÍCIA</h3>
			
				</div>
				
				</a>
				</div>
			</div>
			</div>";
	   }
	   
			
			
			
			
				// seleciona os itens a serem apresentados por página. Uso de LIMIT e OFFSET:
			

			$sql="Select * From noticia order by data desc limit $limite offset $inicio";
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
				echo"<form action='editarnoticia.php' method='post'>";
				echo"<input type='hidden' name='id_noticia' id='id_noticia' value='$id'>";
					echo"<div class='post-module'>";
				echo"<button type='submit' class='button'>";
			
				echo"<div class='thumbnail'>";
				$nome_com_hash= "../img/noticias/".$imagem.".jpg";
				
					if(file_exists($nome_com_hash))
					{
						echo"<img src='".$nome_com_hash."' class='img-rounded'/></img>";
					}
					else
					{
						echo"<img src='../img/noticias/jornal.png' class='img-rounded'/></img>";
					}
					echo"</div>";
				
				echo"<div class='post-content'>";
					echo"<div class='dia'>".date('d/m/Y',  strtotime($linha['data']))."</div>";
					if ($linha['excluido']=='s')
						echo"<h3 class='title' style='color: red;'>".$linha['titulo']."</h3>";
					else
						echo"<h3 class='title'>".$linha['titulo']."</h3>";
			echo"
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
							echo "<li><a href='listanoticias.php?pagina=$antes' aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
						else
							echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
					//numeros 
						for($i = 1; $i <=$tot_paginas ; $i++) {
							if ($i==$pagina)
								echo"<li class='active'><a href='listanoticias.php?pagina=$i'>$i</a></li>";
							else 
								echo "<li><a href='listanoticias.php?pagina=$i'>$i</a></li>";
						}
						
						if($depois<=$tot_paginas)
							echo "<li> <a href='listanoticias.php?pagina=$depois' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
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
