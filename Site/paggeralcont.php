<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="img/iconesub/sb.ico">

	<title>Softbio - Conteúdos</title>
    	<link rel="icon" href="img/logos/sb.ico">

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/paggeralcont.css"/>
	
	<script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php?p=paggeralcont");
    });
    </script> 

</head>

	<div id="navbar">
	
	</div>
	
<body>	

<?php
include "conecta.php";


  ?>
	<div class="contentpagina">
	<div class="container">
	
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
				
                <center><h1>Conteúdos Gerais<br>
                    <small>Selecione um conteúdo</small>
					<hr>
                </h1></center>
            </div>
        </div>
        <!-- /.row -->
	</div>	
<script>

function sucesso(){
	var elem = document.getElementById("frentebio").value;
alert(elem);
}
</script>
        <!-- Projects Row -->
		<div id="conteudos" class="container">
			<div class="row">
			<?php
			$sql="Select * from frente";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
			
				if ($qtde > 0)
				{
					while($linha=pg_fetch_array($resultado))
					{
							$id=$linha[0];
							$nome=$linha[1];
							$imagem="pgcontgeral".$id.".png";

							$nameid="formfrente".$id;
							?>
							

							<form action="paginaunidade.php" method="POST" id="<?php echo $nameid;?>">
							<!-- ana clara, olha p mim porfa, obrigada-->
		
							<input type="hidden" name="frentebio" id="frentebio" value="<?php echo $id; ?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>">
							<div class="quadradofrente">
							<div class='bolinha hidden-xs'>
							<img src="<?php echo 'img/'.$imagem?>" style='margin-top: 1%; width: 50px;'></div>
							<h2><?php echo $nome;?></h2>
							</div>
							</a>
							
							</form>
							<?php
					
					}
				}
				else{
					echo "Erro na busca!!!<br><br>";
					// Fecha a conexão com o PostgreSQL
					pg_close($conecta); 
				}
				?>
			</div>
		</div>
	<br><br><br>

  	</div>
	 
  <footer id="footer" class="footer">
  </footer>
  </body>
 
  
  </html>