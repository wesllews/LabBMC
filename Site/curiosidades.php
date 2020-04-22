<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="img/logos/sb.ico">

	<title>Softbio - Curiosidades</title>
	
	<link rel="icon" href="./img/iconesub/sb.ico">
	
	<script src="bootstrap/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/noticias.css"/>
	
	<script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  	$("#navbar").load("navbar.php?p=curiosidades");
    });
    </script> 
	
</head>

	<div id="navbar">
	</div>

<body>
<div class="container contentpagina">
	<div class="container">
		<div class="row"><!--Título-->
            <div class="col-lg-12">
                <center><h1 >Curiosidades<br>
                    <small>Atente-se a estes fatos e aprenda mais!</small>
					<hr>
                </h1></center>
            </div>
       </div>
	   <div class="row">
		<center>
	   <?php
	   
	  
			session_start();

			if (!isset($_SESSION["logou"]))
			{
				$_SESSION['pagina_antes_login'] = 'curiosidades.php';
				header("Location: login.php");

			}

			$email=$_SESSION['usuario'];

			include "conecta.php";
			
			
			$sql_contagem="select * from curiosidades where  excluido='n' order by titulo ASC";


$resultado= pg_query($conecta, $sql_contagem);
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


   /* Executa a consulta
				// Verifica se $pagina existe, senão deixa na primeira página como padrão
				$pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
				// Defina aqui a quantidade máxima de registros por página.
				if($pagina==1){
					$limite = 6;
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
				$tot_paginas = ceil($total / 6);*/
?>	
			
			
			
			<div id="paginacao">
			
			<?php
			
			
			
			$sql="Select * from curiosidades where excluido='n' order by titulo asc limit $limite offset $inicio";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
			if ($qtde > 0)
			{
			
			for ($cont=0; $cont < $qtde; $cont++)
			{
				$linha=pg_fetch_array($resultado);
				
				
					
					echo "<div class='column'>";
				echo"<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
			
				
				
			$id=$linha['id_curiosidades'];
			$imagem=$linha['imagem'];
			echo"<form action='lermais.php' method='post'>";
			
			echo"<input type='hidden' name='id_curiosidades' id='id_curiosidades' value='$id'>";
					echo"<div class='post-module'>";
					
					echo"<button type='submit' name='submit' class='button'>";
			
				echo"<div class='thumbnail'>";
					$nome_final= "img/curiosidades/".$imagem.".jpg";
					if(file_exists($nome_final))
					{
						echo"<img src='".$nome_final."' class='img-rounded'/></img>";
					}
					else
					{
						echo"<img src='img/curiosidades/homem.png' class='img-rounded'/></img>";
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
							echo "<li><a href='curiosidades.php?pagina=$antes' aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
						else
							echo" <li class='disabled'><a aria-label='Previous'> <span aria-hidden='true'>&laquo;
							</span> </a>  </li>";
					//numeros 
						for($i = 1; $i <=$tot_paginas ; $i++) {
							if ($i==$pagina)
								echo"<li class='active'><a href='curiosidades.php?pagina=$i'>$i</a></li>";
							else 
								echo "<li><a href='curiosidades.php?pagina=$i'>$i</a></li>";
						}
						
						if($depois<=$tot_paginas)
							echo "<li> <a href='curiosidades.php?pagina=$depois' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						else
							echo"<li class='disabled'> <a class='disabled' aria-label='Previous'> <span aria-hidden='true'>&raquo;	</span> </a>  </li>";
						
						echo"</ul></nav>";
					?>
					
						</div>
				</center>
				</div>		
	   </div>
	</div>
	</div>
	
	<footer id="footer" class="footer">
	</footer>
	
</body>


</html>