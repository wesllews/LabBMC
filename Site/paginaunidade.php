<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/logos/sb.ico">


    <title>Softbio - Unidade</title>

<script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php");
    });
</script>
	<style>
	a{
		cursor:pointer;
	}
	</style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <link href="css/formatacaobibi.css" rel="stylesheet">

  </head>
  <div id="navbar">
	
</div>
  <body>
  <div class="contentpagina">
  	<?php
	
	session_start();

			if (!isset($_SESSION["logou"]))
			{
				$_SESSION['pagina_antes_login'] = 'paggeralcont.php';
				header("Location: login.php");

			}

			$email=$_SESSION['usuario'];
			//echo $_SESSION['email'];
		
			
	include "conecta.php";

	//verificar tipo de curso
	$sql_us="select * from cadastro where email='$email'";
	$resultado_us= pg_query($conecta, $sql_us);
	$qtde_us=pg_num_rows($resultado_us);
	
	if($qtde_us>0){
		$usuariol = pg_fetch_array($resultado_us);
		$dificuldade=$usuariol['dificuldade'];
		$dificuldade=strtolower($dificuldade);
	}
	$frente=$_POST['frentebio'];
	
	$sql_tot="select * from frente where id_frente=$frente ";
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

  <!--identificação de página-->
<div class="container">
	
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
				
                <center><h1><?php echo $frentenome;?><br>
                    <small>Selecione uma subunidade</small>
					<hr>
                </h1></center>
            </div>
        </div>
        <!-- /.row -->
	</div>	
	<!--Fim do nome da frente-->
	

     <!--todos conteudos-->
    <div class="container">

	 
	  <?php
	  if($dificuldade=='intensivo'){
   		$sql_tot="select id_unidade,unidade,imagem from unidade where id_frente=$frente and excluido='n' order by id_unidade ASC";
	  }
	  else{
		$sql_tot="select id_unidade,unidade,imagem from unidade where id_frente=$frente and dificuldade='básico' and excluido='n' order by id_unidade ASC";
	  }

	$resultado_tot= pg_query($conecta, $sql_tot);
	$qtde_tot=pg_num_rows($resultado_tot);
			
	if ($qtde_tot > 0)
	{
		while($unidadelinha = pg_fetch_array($resultado_tot))
		{
			$idunidade=$unidadelinha[0];
			$nomeunidade=$unidadelinha[1];
			$imagem=$unidadelinha[2];

			?>
		<div class="row"  id="conteudos">

			 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="linhazinha" style="display: block; border-radius:10px 0 10px 10px;">
		<center>
		 <a href="#conceitos<?php echo $idunidade;?>" class="click-linhazinha visible-xs" data-toggle="collapse">
		<div class="bolinha">
		 
		 <img src="img/unidade/<?php echo $imagem;?>">
		
		 </div></a>

		<div class="bolinha hidden-xs">
		 
		 <img src="img/unidade/<?php echo $imagem;?>">
		
		 </div>


		 <font face="brandonreg" class="nomeconteudo visible-xs-inline">
		 <br>
		 	<a href="#conceitos<?php echo $idunidade;?>" class="click-linhazinha" data-toggle="collapse" style="font-size:large; margin-left: 0px; 	letter-spacing:1px; 
" id="seta"><?php echo $nomeunidade;?></a>
		 	
			</font>
			<br>
			 <font face="brandonreg" class="nomeconteudo hidden-xs" style="font-size:x-large; margin-left:20px; letter-spacing:5px;
">
		 	<?php echo $nomeunidade;?>
		 		
			 </font>
			 </center>

			 <div id="conceitos<?php echo $idunidade;?>" class="collapse">

     <div class="linhazinhaconteudo col-lg-8 col-md-8 col-sm-8 col-xs-12 visible-xs"> 
			<?php
			 if($dificuldade=='intensivo'){
			$sql_subunidade="select id_subunidade, subunidade from subunidade where id_unidade=$idunidade and excluido='n' order by id_subunidade ASC";
			}
			else{
					$sql_subunidade="select id_subunidade, subunidade from subunidade where id_unidade=$idunidade and dificuldade='básico' and excluido='n' order by id_subunidade ASC";
			}

			$resultado_subunidade= pg_query($conecta, $sql_subunidade);
			$qtde_subunidade=pg_num_rows($resultado_subunidade);

			if ($qtde_subunidade > 0)
			{
				while($subunidadelinha = pg_fetch_array($resultado_subunidade)){
					
						$idsubunidade=$subunidadelinha[0];
						$nomesubunidade=$subunidadelinha[1];
						$nameid1="formsubunidade".$idsubunidade;
						
						
						$sql_cronograma2 ="select * from cronograma where id_subunidade=$idsubunidade and email='$email'";
						$resultado_cronograma2= pg_query($conecta, $sql_cronograma2);
						$qtde_cronograma2=pg_num_rows($resultado_cronograma2);
						if ($qtde_cronograma2 > 0)
						{
						?>
						<form action="paginaestudo.php" method="post" id="<?php echo $nameid1;?>">
							<input type="hidden" name="idsubunidade" value="<?php echo $idsubunidade;?>">
							<?php
							$variavel1="document.getElementById('".$nameid1."').submit();";
							?>
						</form>
						 <a onClick="<?php echo $variavel1;?>" target="_blank" style="margin:5px;text-decoration: none;">

		<i class="glyphicon glyphicon-grain" style="color:#004d00;">
			<font face="brandonreg" class="diversosconteudos" style="color:#004d00;" >

				<?php echo $nomesubunidade;?>

		   	</font>
			   	   
		</i>
	</a>
	<br>
	<?php
						}

						
						
			else
					{
						?>
						<form action="paginaestudo.php" method="post" id="<?php echo $nameid1;?>">
							<input type="hidden" name="idsubunidade" value="<?php echo $idsubunidade;?>">
							<?php
							$variavel1="document.getElementById('".$nameid1."').submit();";
							?>
						</form>
						 <a onClick="<?php echo $variavel1;?>" target="_blank" style="margin:5px;text-decoration: none;">

		<i class="glyphicon glyphicon-grain" >
			<font face="brandonreg" class="diversosconteudos"  >

				<?php echo $nomesubunidade;?>

		   	</font>
			   	   
		</i>
	</a>
	<br>
	<?php
			}//else
						
						
						
				}

				?>
				</div><br>
  </div>	 
	 
	 </div>
	<?php
			}
			else{
					echo "Erro na tabela subunidade";
			}
?>
<!--outras divs-->

<div class="linhazinhaconteudo col-lg-8 col-md-8 col-sm-8 col-xs-12 hidden-xs" style="height:100%;float:left; border-radius:0 10px 10px 0"> 


			<?php
			
			 if($dificuldade=='intensivo'){
			$sql_subunidadefofa="select id_subunidade, subunidade from subunidade where id_unidade=$idunidade and excluido='n' order by id_subunidade ASC";
			}
			else{
			$sql_subunidadefofa="select id_subunidade, subunidade from subunidade where id_unidade=$idunidade and dificuldade='básico' and excluido='n' order by id_subunidade ASC";
			}

			$resultado_subunidadefofa= pg_query($conecta, $sql_subunidadefofa);
			$qtde_subunidadefofa=pg_num_rows($resultado_subunidadefofa);

	

			if ($qtde_subunidadefofa > 0)
			{
				
				while($subunidadelinhafofa = pg_fetch_array($resultado_subunidadefofa)){
					
						$idsubunidadefofa=$subunidadelinhafofa[0];
						$nomesubunidadefofa=$subunidadelinhafofa[1];
						$nameid="formsub".$idsubunidadefofa;
						
					
						$sql_cronograma ="select * from cronograma where id_subunidade=$idsubunidadefofa and email='$email'";
						$resultado_cronograma= pg_query($conecta, $sql_cronograma);
						$qtde_cronograma=pg_num_rows($resultado_cronograma);
				if ($qtde_cronograma > 0)	
				{
					
						?>
						<form action="paginaestudo.php" method="post" id="<?php echo $nameid;?>">
							<input type="hidden" name="idsubunidade" value="<?php echo $idsubunidadefofa;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
						</form>

					

						 <a onClick="<?php echo $variavel;?>" target="_blank" style="margin:5px;text-decoration: none; color:red;">
		<i class="glyphicon glyphicon-grain" style="color:#004d00;">
			<font face="brandonreg" class="diversosconteudos" style="color:#004d00;">

				<?php echo $nomesubunidadefofa;?>

		   	</font>
			   	   
		</i>
	</a>
	<br>

	<?php
			}//if
			
			
			
			else	
			{
					?>
				<form action="paginaestudo.php" method="post" id="<?php echo $nameid;?>">
					<input type="hidden" name="idsubunidade" value="<?php echo $idsubunidadefofa;?>">
						<?php
						$variavel="document.getElementById('".$nameid."').submit();";
						?>
					</form>

					

		 <a onClick="<?php echo $variavel;?>" target="_blank" style="margin:5px;text-decoration: none; ">
		<i class="glyphicon glyphicon-grain">
			<font face="brandonreg" class="diversosconteudos" >

				<?php echo $nomesubunidadefofa;?>

		   	</font>
			   	   
		</i>
	</a>
	<br>

	<?php
			}//else
			
			
			
				}

				?>
				</div>
				  </div>	 

			
	 
	<?php
			}
			else{
					echo "Erro na tabela subunidade";
			}



		}//while
	}//ifmaior
	else{
		echo "Erro no banco de dados!";
	}
	?>


	
	

	</div>
	 
			 <center>
    <div class="container-fluid" >
<div class="row" >
  <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-1 hidden-xs" style="margin-top: 20px;">
  
  
   <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4" id="simuladoborda">
<font size="5x" face="brandonreg" style="color:black;">MATERIAIS</font>
      </div>  
	  
	  
   <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4" id="simuladoconteudo">
   
   <?php
   	 if($dificuldade=='intensivo'){
   $sql_tot="select id_unidade from unidade where id_frente=$frente and excluido='n' order by id_unidade ASC";
	  }
	  else{
   $sql_tot="select id_unidade from unidade where id_frente=$frente and dificuldade='básico' and excluido='n' order by id_unidade ASC";
	  }

	$resultado_tot= pg_query($conecta, $sql_tot);
	$qtde_tot=pg_num_rows($resultado_tot);
			
	if ($qtde_tot > 0)
	{
		while($unidadel = pg_fetch_array($resultado_tot))
		{
			$unidade=$unidadel['id_unidade'];
			
			 	 if($dificuldade=='intensivo'){
			$sql_subunidade="select id_subunidade, subunidade from subunidade where id_unidade=$unidade and excluido='n' order by id_subunidade ASC";
	  }
	  else{
			$sql_subunidade="select id_subunidade, subunidade from subunidade where id_unidade=$unidade and dificuldade='básico' and excluido='n' order by id_subunidade ASC";
	  }

			$resultado_subunidade= pg_query($conecta, $sql_subunidade);
			$qtde_subunidade=pg_num_rows($resultado_subunidade);

			if ($qtde_subunidade > 0)
			{
				while($subunidadel = pg_fetch_array($resultado_subunidade)){
						$nameid2="formpdfsub".$subunidadel['id_subunidade'];

					?>

						<form action="pdfconteudo.php" method="post" id="<?php echo $nameid2;?>">
						<input type="hidden" name="idsubunidadepdf" value="<?php echo $subunidadel['id_subunidade'];?>">
							<?php
							$variavel3="document.getElementById('".$nameid2."').submit();";
							?>
						</form>
						 <a onClick="<?php echo $variavel3;?>" style="color:black;font-size:16px;letter-spacing:0px;"><i class="glyphicon glyphicon-grain"></i><?php echo $subunidadel['subunidade'];?></a><br>
					<?php
				}

			}
			else{
					echo "Erro na tabela subunidade";
			}
		}
	}
	else{
		echo "Erro no banco de dados!";
	}
	?>


   </div>  
	  
    
    

  
</div>
    <div class="clearfix visible-xs-block"></div>

  <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-2 hidden-xs" style=" margin-top: 20px; ">
  
   <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4" id="simuladoborda">
<font size="5x" face="brandonreg" style="color:black;">SIMULADOS</font>
      </div>   
  

   <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4" id="simuladoconteudo">
   
   <?php
   	 if($dificuldade=='intensivo'){
    $sql_unidade="select id_unidade, unidade from unidade where id_frente=$frente and excluido='n' order by id_unidade ASC";
	  }
	  else{
    $sql_unidade="select id_unidade, unidade from unidade where id_frente=$frente and dificuldade='básico' and excluido='n' order by id_unidade ASC";
	  }
	$resultado_unidade= pg_query($conecta, $sql_unidade);
	$qtde_unidade=pg_num_rows($resultado_unidade);
			
	if ($qtde_unidade > 0)
	{
		while($unidadel = pg_fetch_array($resultado_unidade))
		{
			$unidade=$unidadel['unidade'];
			$idunidade=$unidadel['id_unidade'];

			?>
			<form action="questoes.php" method="post" id="formpdf">
			<input type="hidden" name="frente" value="<?php echo $frente;?>">
			<?php
				$variavel="document.getElementById('formpdf').submit();";
			?>
			</form>
			 <a onClick="<?php echo $variavel;?>" style="color:black;font-size:16px;letter-spacing:0px;"><i class="glyphicon glyphicon-grain"></i><?php echo $unidade;?></a><br>
			<?php
			
		}
	}
	else{
		echo "Erro no banco de dados";
	}
			
	?>

	  
	  </div>  
	  
    
	
  </div>
  
  
  
  
</div>
   <div class="row">
		<center><a href="paggeralcont.php" class="btn btn-primary">Voltar</a></center>
		<br><br>

	   </div>

</div>





</center>   


    <script src="js/ie10-viewport-bug-workaround.js"></script>
	</div>
  	<footer id="footer" class="footer">
	</footer>

 </body>
</html>


