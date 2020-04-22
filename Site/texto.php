<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Softbio - Notícias</title>
	<link rel="icon" href="./img/iconesub/sb.ico">
	<link rel="icon" href="img/logos/sb.ico">
	<script src="bootstrap/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/texto.css" rel="stylesheet">
	
	
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
	
	<div class="contentpagina">

		<?php
		session_start();
		include "conecta.php";
		include "./administrador/substituir.php";
		
		$sql="Select * From noticia where id_noticia=".$_POST['id_noticia'];
		$resultado= pg_query($conecta, $sql);
		$qtde=pg_num_rows($resultado);
		if ($qtde > 0)
		{
			$linha=pg_fetch_array($resultado);
			$id = $linha['id_noticia'];
			$titulo = textohtml("noticia", "id_noticia", "titulo", $id);
			$texto = textohtml("noticia", "id_noticia", "texto", $id);
			$fonte = textohtml("noticia", "id_noticia", "fonte", $id);
			
			echo "<br><br><br>";

			echo 
			
			"
			<div class='col-lg-12'>
				
				<center><div class='titlenoticia'>".$titulo."
					<hr>
				</div>
				<br>
				<div style='margin-bottom: 10px;'>";
				$data=$linha['data'];
				echo "Data de publicação: ".date('d/m/Y',  strtotime($data));
			echo "</center></div></div>";
			
			?>
			<div class="container">
				<div id="textoeimagem">
					
					<?php 
					$imagem=$linha['imagem'];
					$nome_final= "img/noticias/".$imagem.".jpg";
					if(file_exists($nome_final))
					{
						echo "<br><img src='img/noticias/".$imagem.".jpg' class='imagem_noticia img-rounded' align='left'></img>";
					}
					else
					{
						echo"<br><img src='img/noticias/jornal.png' class='img-rounded' align='left' style='margin-right: 12px; height: 334px;'></img>";
					}
					
					echo "<p>".$texto."</p>";
					
					?>
					
					
				</div>
			</div>
			
			<br>
			<div class="container fonte">
				
				<?php
				echo "Fonte: <a target='_blank' href='".$fonte."' class='link'>".$fonte."</a><br><br><br><br><br>";
				?>
				
			</div> 
			
			
			<?php
		}
		
		else
			echo "Erro na busca!!!<br><br>";
		// Fecha a conexão com o PostgreSQL
		
		pg_close($conecta); 
		?>
		
		<center>
			<a href="noticias.php" class="btn btn-primary" style="margin-bottom: 10px;">Voltar</a>
		</center>	
		
	</div>
	<footer id="footer" class="footer">
	</footer>
</body>


</html>