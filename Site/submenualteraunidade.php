<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../img/logo.png">
	
	
		<title>Softbio - Edicao de unidade</title>
		<link rel="stylesheet" type="text/css" href="../css/curiosidades.css"/>
		
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
		<link href="../css/formatacaobibi.css" rel="stylesheet">
		<script src="../js/formulario.js"></script>
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	<script src="../js/codigos.js"></script>

<script src="../bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("../footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");
    });
</script>


	 </head>
<div id="navbar">
	
</div>
	 

	<body>


		<?php
		session_start();
	include "conexao.php";
	$frente=$_POST['id'];
	
	//$frente=$_GET['frente'];//ID
	$_SESSION["id_frente"]=$frente;
	$sql_tot="select * from frente where id_frente=$frente";
	$resultado_tot= pg_query($conecta, $sql_tot);
	$qtde_tot=pg_num_rows($resultado_tot);

			
	if ($qtde_tot > 0)
	{
		while($frentel = pg_fetch_array($resultado_tot))
		{
		
		$frentenome=$frentel['frente'];
		
		}
	}
	else{
		echo "Erro no banco de dados!";
	}
	
	/*Função adaptada de Matheus Cristian*/
	function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

	$frenteaux=strtolower(tirarAcentos($frentenome));


?>
<div class="contentpagina">

  <div class="container" style="background-color:white;">
	
        <!-- Page Heading -->
        <div class="row" >
            <div class="col-lg-12" >
				
                <center><h1><?php echo $frentenome;?><br>
                    <small>Selecione uma unidade</small>
					<hr>
                </h1></center>
            </div>
        </div>
        <!-- /.row -->
	</div>	
	<!--Fim do nome da frente-->

     <!--todos conteudos-->
    <div class="container" style="background-color:white;">

	 
	  <?php
   $sql_tot="select id_unidade,unidade,excluido from unidade where id_frente=$frente";
	$resultado_tot= pg_query($conecta, $sql_tot);
	

	$qtde_tot=pg_num_rows($resultado_tot);
	
			$icont=0;
	if ($qtde_tot > 0)
	{?>
		<div class="row"  id="conteudos" style="background-color:white;">
		<?php
		while($unidadelinha = pg_fetch_array($resultado_tot))
		{
			
			$icont++;
		
			$idunidade=$unidadelinha[0];
			
			$nomeunidade=$unidadelinha[1];
			
			$excluido=$unidadelinha[2];
			
			
			$imagem=$idunidade.".png";
			
			
			//NOME DO FORM	
			$nameid="formfrente".$idunidade;
			ECHO $nomeid."<br>";
		

		if($icont %2==0 )
		{
			?>
		
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="linhazinha" style=" margin-bottom:50px; display: block; margin-rigth:10px;background-color:white;">
		<center>
		 <div class="bolinha">
		 <img src="../img/unidade/<?php echo $imagem;?>">
		
		 </div>
		 <font face="brandonreg" class="nomeconteudo visible-xs-inline">
		 <br>
		 	<a href="#conceitos<?php echo $idunidade;?>" class="click-linhazinha" data-toggle="collapse" style=" background-color:purple; font-size:large; margin-left: 0px; 	letter-spacing:1px; "  id="seta">
		
				<?php
				
				if ($excluido=="n")
				{?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:black; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
				
				}
				else 
				{
				?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							
							<a href="#" onClick="<?php echo $variavel;?>" style="color:red; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
				}
				?>
		 	
			</font>
			<br>
			 <font face="brandonreg" class="nomeconteudo hidden-xs" style="font-size:x-large; margin-left:20px; letter-spacing:5px; ">
				<?php
				
				
				if ($excluido=="n")
				{
					?>
					
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:black; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
				
				<?php
				
					
				
				}
				else 
				{
					?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							
							<a href="#" onClick="<?php echo $variavel;?>" style="color:red; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
				}
				?>
		 		
			 </font>
			 </center>
	</div>
	
	<?php
		}
		

		
		if($icont %2==1 )
		{
			if ($icont < $qtde_tot)
			{?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="linhazinha" style=" margin-bottom:50px; display: block;  background-color:white;">
			<center>
			 <div class="bolinha">
			 <img src="../img/unidade/<?php echo $imagem;?>">
			
			 </div>
			 <font face="brandonreg" class="nomeconteudo visible-xs-inline">
			 <br>
				<a href="#conceitos<?php echo $idunidade;?>" class="click-linhazinha" data-toggle="collapse" style=" background-color:pink;font-size:large; margin-left: 0px; 	letter-spacing:1px;"  id="seta">
					<?php
					if ($excluido=="n")
					{
						?>
				<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							
							<a href="#" onClick="<?php echo $variavel;?>" style="color:black; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
					
					}
					else 
					{
				?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							
							<a href="#" onClick="<?php echo $variavel;?>" style="color:red; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
					<?php
					
					}
					?>
				
				</font>
				<br>
				 <font face="brandonreg" class="nomeconteudo hidden-xs" style="font-size:x-large; margin-left:20px; letter-spacing:5px; 
	">
				<?php
					if ($excluido=="n")
					{
						?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							
							<a href="#" onClick="<?php echo $variavel;?>" style="color:black; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
					
					}
					//VERMELHO
					else 
					{
					?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:red; text-decoration: none;" >
							<div class="teste" style="background-color:purple;" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
						
					}
					?>
					
				 </font>
			 </center>
			</div>
		<?php
			}
			else{
		?>
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="linhazinha" style=" margin-bottom:50px; display: block;  background-color:white;">
		<center>
		 <div class="bolinha">
		 <img src="../img/unidade/<?php echo $imagem;?>">
		
		 </div>
		 <font face="brandonreg" class="nomeconteudo visible-xs-inline">
		 <br>
		 	<a href="#conceitos<?php echo $idunidade;?>" class="click-linhazinha" data-toggle="collapse" style="font-size:large; margin-left: 0px; 	letter-spacing:1px;"  id="seta">
				<?php
				if ($excluido=="n")
				{
					?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:black; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
				
				}
				else 
				{
					?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:red; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
				
				<?php
					
				}
				?>
			
			</font>
			<br>
			 <font face="brandonreg" class="nomeconteudo hidden-xs" style="font-size:x-large; margin-left:20px; letter-spacing:5px; 
">
		 	<?php
				if ($excluido=="n")
				{
					?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:black; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
				
				}
				//VERMELHO
				else 
				{
					?>
					<form action="alterarunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>" style="color:red; text-decoration: none;" >
							<div class="teste" >
							
							<?php echo $nomeunidade;?>
							</div>
							</a>

					</form>
					
				<?php
					
				}
				?>
		 		
			 </font>
			 </center>
	</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
		<?php
			}		
		}//if


		}//while
		?>
		
		<div class="row">
		<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="curiosidades.php" class="btn btn-primary">Voltar</a></center>
		<br><br>

	   </div>
		</div>
	<?php
	}//ifmaior
	
	else{
		echo "Erro no banco de dados!";
	}
	?>


	
	

	</div>
	





</center>   



    <script type="text/javascript">
	function alteraSetaUnidade(){
    valor = document.getElementById('seta').innerHTML;

     if(valor == 'Origem dos seres vivos ↓'){
       document.getElementById('seta').innerHTML = 'Origem dos seres vivos ↑';
   }else{
       document.getElementById('seta').innerHTML = 'Origem dos seres vivos ↓';
   }

     if(valor == 'COMPOSIÇÃO QUÍMICA DOS SERES ↓'){
       document.getElementById('seta').innerHTML = 'COMPOSIÇÃO QUÍMICA DOS SERES ↑';
   }else{
       document.getElementById('seta').innerHTML = 'COMPOSIÇÃO QUÍMICA DOS SERES ↓';
   }

     if(valor == 'BIOLOGIA CELULAR ↓'){
       document.getElementById('seta').innerHTML = 'BIOLOGIA CELULAR ↑';
   }else{
       document.getElementById('seta').innerHTML = 'BIOLOGIA CELULAR ↓';
   }

     if(valor == 'Introdução à genética ↓'){
       document.getElementById('seta').innerHTML = 'Introdução à genética ↑';
   }else{
       document.getElementById('seta').innerHTML = 'Introdução à genética ↓';
   }

     if(valor == 'PRIMEIRA LEI DE MENDEL ↓'){
       document.getElementById('seta').innerHTML = 'PRIMEIRA LEI DE MENDEL ↑';
   }else{
       document.getElementById('seta').innerHTML = 'PRIMEIRA LEI DE MENDEL ↓';
   }

     if(valor == 'ORIGEM DOS SERES VIVOS ↓'){
       document.getElementById('seta').innerHTML = 'ORIGEM DOS SERES VIVOS ↑';
   }else{
       document.getElementById('seta').innerHTML = 'ORIGEM DOS SERES VIVOS ↓';
   }
		
}
		
	</script>
        <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
    <script src="../js/carouselmultiitem.js"></script>

    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	
		<script src="../js/holder.min.js"></script>


	<script src="../js/bootstrapvalidator.min.js"></script> 
	<script src="../js/cadastro.js"></script> 
	 
</div>
</div>


  <footer id="footer" class="footer">
  </footer>
</body>
</html>