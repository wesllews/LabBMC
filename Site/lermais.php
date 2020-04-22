<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Softbio - Curiosidades</title>
	
	    <link rel="icon" href="img/logos/sb.ico">
	
	<script src="bootstrap/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/texto.css"/>
	
	
	
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">

	    <link href="css/format.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	<script src="js/formulario.js"></script>
	<script src="js/codigos.js"></script>

	
	
	<script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  	$("#navbar").load("navbar.php?p=lermais");
    });
    </script> 
	
</head>

	<div id="navbar">
	</div>

<body>

<div class="col-md-12 col-xs-12 contentpagina">

		<div class="row">
   
		
	   <?php
			include "conecta.php";
			include "./administrador/substituir.php";
			
		$id=$_POST['id_curiosidades'];
		
		
		
			session_start();
			
			if (!isset($_SESSION["logou"]))
			{
				header("Location: login.php");

			}

	$email=$_SESSION['usuario'];

			
			
			$sql="Select * from curiosidades where id_curiosidades='$id' and excluido='n'";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
			if ($qtde > 0)
			{
			
				$linha=pg_fetch_array($resultado);
				?>
				 <div class="row">
					  <div class="col-md-8 col-xs-11 col-xs-offset-2">
					 
				
               <center><h1><?php echo $linha['titulo']; ?><br>
				<small>Atente-se a este fato e aprenda mais!</small></center>
    					

                </h1>
					</div>
					</div>
			
				<br>
				
				<div class="col-md-5 col-xs-11 col-md-offset-6 col-xs-offset-1">
				<div class="row">
				<?php 
				$data=$linha['data'];
				echo "Data de publicação: ".date('d/m/Y',  strtotime($data));  ?>.<br>
				Publicado em: <font size="2" > <a href="<?php echo $linha['fonte'];?>" class="link-preto" > <?php echo $linha['fonte'];?></a>  	</font>		
								
				</div>
				<br><br>
				</div>
				
			
			
		 <br>
				
				<div class="container ">
				<div id="textoeimagem">
					
					<?php 
					$imagem=$linha['imagem'];
					
					$nome_final= "img/curiosidades/".$imagem.".jpg";
					if(file_exists($nome_final))
					{
						echo "<img src='img/curiosidades/".$imagem.".jpg' class='imagem_curiosidade img-rounded img-responsive' align='left'></img>";
					}
					else
					{
						echo"<img src='img/curiosidades/homem.png' class='img-rounded img-responsive' align='left' style='margin-right: 12px; height: 334px;'></img>";
					}
					
					 $texto =textohtml("curiosidades","id_curiosidades","texto","$id"); 
				echo"<p>$texto</p>";
					
					
					?>
					
					
				</div>
				</div>
				
			 
				
				
				
				<!--<hr align="center" width="600" size="10" color=red>
				
				 <div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-1">
				<div class="row">
                <center><h3>Talvez você também se interesse por:<br>
                 
					<hr align="center" width="600" size="10" color=red></center>

                </h3>
            </div>
			</div>
		 <center>
			<div class="row">
			< ?php
				
			$sql="Select * from curiosidades where excluido='n' and id_curiosidades!='$id'";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
			if ($qtde > 0)
			{
				
			
			for ($cont=0; $cont < 3; $cont++)
			{
				$linha=pg_fetch_array($resultado);
				
				
					
					echo "<div class='column'>";
				echo"<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
			
			$id=$linha['id_curiosidades'];
					echo"<div class='post-module'>";
				echo"<a href='lermais.php?id=$id' class='link-preto'>";
			
				echo"<div class='thumbnail'>";
				
					$nome_final= "img/curiosidades/".$id.".jpg";
					if(file_exists($nome_final))
					{
						echo"<img src='".$nome_final."' class='img-rounded'/></img>";
					}
					else
					{
						echo"<img src='img/curiosidades/homem.png' class='img-rounded img-responsive'/></img>";
					}
					
				echo"</div>";
				
				echo"<div class='post-content'>";
					echo"<div class='dia'>".date('d/m/Y',  strtotime($linha['data']))."</div>";
					echo"<h3 class='title'>".$linha['titulo']."</h3>
			
				</div>
				
				</a>
				</div>
			</div>
			</div>";
			
				}
			}	</center>	
	   </div>
	   -->
			<?php
					
			}
			else
			echo "Ocorreu um erro!!!<br><br>";
			
			pg_close($conecta); 
			
		
		?>
		<br>
		
		<br>
		<br><br>
		
	   
	   <div class="row">
		<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;<a href="curiosidades.php" class="btn btn-primary">Voltar</a></center>
		<br><br>

	   </div>
	   
	</div>
	</div>

	<footer id="footer" class="footer">
	</footer>
	
</body>
</html>