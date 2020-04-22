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


    <title>Softbio - Subunidade</title>

<script src="../bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");
    });
	
/*window.onbeforeunload = function(event) {
event.returnValue = "asdasdfasdf";
};
function tiraVerificacao(){
window.onbeforeunload = null;
};*/
</script>


		<link href="../css/apendices.css" rel="stylesheet">


    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="../js/ie-emulation-modes-warning.js"></script>
    <link href="../css/formatacaobibi.css" rel="stylesheet">
	<link href="./assets/css/formel.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/normalize.min.css">
      <link rel="stylesheet" href="../less/stylecarouselmulti-item.css">
  </head>
<div id="navbar">
	
</div>
  <body>

	
	<?php
	include "conexao.php";
	session_start();
	
	if($_SESSION['adm']!='s')
		header("Location: /hope/tcc/login.php");
	
	if ($_SESSION["passousub"]==null)
	{
		$frente=$_POST['id'];
		$_SESSION["idfrentepassou"]=$frente;
		$_SESSION["frente"]=$frente;
	}
	if ($_SESSION["passousub"]==1)
	{
		$frente=$_SESSION["frente"];
	}
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
<div class="contentpagina"> <!-- 1-->
   <!--identificação de página-->
<div class="container contentpagina">
	
        <!-- Page Heading -->
        <div class="row" >
            <div class="col-lg-12" >
				
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
    <div class="container"><!-- 2 -->

	 
	  <?php
   $sql_tot="select id_unidade,unidade,excluido,imagem from unidade where id_frente=$frente";
  
	$resultado_tot= pg_query($conecta, $sql_tot);
	
	$qtde_tot=pg_num_rows($resultado_tot);
	
	if ($qtde_tot > 0)
	{
		while($unidadelinha = pg_fetch_array($resultado_tot))
		{
			$idunidade=$unidadelinha[0];
			$nomeunidade=$unidadelinha[1];
			$excluido=$unidadelinha[2];
		
			$imagem=$unidadelinha[3];
			
			
			?>
		<div class="row"  id="conteudos"><!-- 3-->

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="linhazinha" style="display: block;"> <!-- 5-->
		<center>
		 <div class="bolinha">
		 <img src="../img/unidade/<?php echo $imagem;?>">
		
		 </div>
		 <font face="brandonreg" class="nomeconteudo visible-xs-inline">
		 <br>
		 	<a href="#conceitos<?php echo $idunidade;?>" class="click-linhazinha" data-toggle="collapse" style="font-size:large; margin-left: 0px; 	letter-spacing:1px; 
"  id="seta"><?php echo $nomeunidade;?> </a>
		 	
			</font>
			<br>
			 <font face="brandonreg" class="nomeconteudo hidden-xs" style="font-size:x-large; margin-left:20px; letter-spacing:5px; 
">
		 	<?php echo $nomeunidade;?>
		 		
			 </font>
			 </center>


		
			<!--background-color:#F8F8FF;
			-->
			<div class="linhalegal col-lg-8 col-md-8 col-sm-8 col-xs-12 visible-xs" style="margin-top:10px; font-size:16px;background-color:#F8F8FF; " > 
			<!-- 6-->
			
			<?php
			
			$sql_subunidade="select id_subunidade, subunidade,excluido from subunidade where id_unidade=$idunidade";
		
			$resultado_subunidade= pg_query($conecta, $sql_subunidade);
			$qtde_subunidade=pg_num_rows($resultado_subunidade);

			if ($qtde_subunidade >  -1)
			{
				
				while($subunidadelinha = pg_fetch_array($resultado_subunidade)){
					
						$idsubunidade=$subunidadelinha[0];
						$nomesubunidade=$subunidadelinha[1];
						$ex=$subunidadelinha[2];
						
						$nameid="formuni".$idsubunidade;
						?>
						<div class="linhalegal col-lg-6 col-md-6 col-sm-6 col-xs-12 visible-xs" style="margin-top:10px; font-size:16px;background-color:#F8F8FF; " >
						<!-- 7-->
						<?php
						 if ($ex=="n")
						{?>
						 <form action="alterarsubunidade.php"  method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="id" id="id" value="<?php echo $idsubunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
			<i class="glyphicon glyphicon-grain">
			<font face="brandonreg" class="diversosconteudos" >

			<a href="#" onClick="<?php echo $variavel;?>"  style="margin:5px;text-decoration: none; color:black; "><?php echo $nomesubunidade;?></a>
							
							</a>

		   	</font>
			   	   
		</i>
							

						</form>
						 <?php
						}
						if ($ex=="s")
						{?>
						<form action="alterarsubunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="id" id="id" value="<?php echo $idsubunidade;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
					<i class="glyphicon glyphicon-grain" style="color:red; " >
						<font face="brandonreg" class="diversosconteudos" >

						<a href="#" onClick="<?php echo $variavel;?>"  style="margin:5px;text-decoration: none; color:red; "><?php echo $nomesubunidade;?></a>
							
							</a>
		
						</font>
			   	   
				</i>

						</form>
						 <?php
						}
						 ?>
						 </div><!-- #7-->
		<!--<i class="glyphicon glyphicon-grain">
			<font face="brandonreg" class="diversosconteudos" >

				

		   	</font>
			   	   
		</i>-->
	
	<br>
	<?php

				}

				?>
			</div> <!-- #6--><br>
 	 
	 
	 </div> <!-- #5-->
	<?php
			}
			else{
					echo "Erro na tabela subunidade";
					
			}
?>
<!--outras divs-->

<div class="linhazinhaconteudo col-lg-8 col-md-8 col-sm-8 col-xs-12 hidden-xs" style="height:100%;float:left; background-color:white;"> 
 <!-- 4-->

			<?php
			
			
			$sql_subunidadefofa="select id_subunidade, subunidade,excluido from subunidade where id_unidade=$idunidade";
			
			$resultado_subunidadefofa= pg_query($conecta, $sql_subunidadefofa);
			$qtde_subunidadefofa=pg_num_rows($resultado_subunidadefofa);

			
			
			if ($qtde_subunidadefofa > -1 )
			{
				while($subunidadelinhafofa = pg_fetch_array($resultado_subunidadefofa)){
					
						$idsubunidadefofa=$subunidadelinhafofa[0];
						$nomesubunidadefofa=$subunidadelinhafofa[1];
						$excluidosub=$subunidadelinhafofa[2];
						
						//NOME DO FORM	
						$nameid="formuni".$idsubunidadefofa;
						
						?>
						 
		
				<?php if ($excluidosub=="n")
				{			?>
			<i class="glyphicon glyphicon-grain">
			<font face="brandonreg" class="diversosconteudos" >
			<form action="alterarsubunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="id" id="id" value="<?php echo $idsubunidadefofa;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							
							?>
							
							<a href="#" onClick="<?php echo $variavel;?>" style="margin:5px;text-decoration: none; color:black; "><?php echo $nomesubunidadefofa;?></a>
							
							</a>

			</form>
			</font>
			</i>
			

				
		 <?php } 
		 if ($excluidosub=="s")
			{		
			?>
			<i class="glyphicon glyphicon-grain" style="color:red;">
			<font face="brandonreg" class="diversosconteudos" >
				<form action="alterarsubunidade.php" method="POST" id="<?php echo $nameid;?>">
							<input type="hidden" name="idunidade" id="idunidade" value="<?php echo $idsubunidadefofa;?>">
							<?php
							$variavel="document.getElementById('".$nameid."').submit();";
							?>
							<a href="#" onClick="<?php echo $variavel;?>"  style="margin:5px;text-decoration: none; color:red; "><?php echo $nomesubunidadefofa;?></a>
							
							</a>

				</form>
			</font>
			</i>
	<?php } ?>
		   
	
	<br>
       
	<?php

	
	
	
	
				}

				?>
				</div><!--linhazinhaconteudo hidden-xs --> <!-- #4-->
			</div>	<!-- ROW conteudos --> <!-- #3-->

			
	 
	<?php
	
			
			}
			

			else{
					echo "Erro na tabela subunidade";
			}



		}//while
		echo "<center><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php' style='margin-top:10px;' class='btn btn-primary'>Voltar</a></center>";
	}//ifmaior
	else{
		echo "Erro no banco de dados!";
	
	}
	
	?>
		

	
	


	 <br><br> <br><br> <br><br> <br><br>

        <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>')</script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
    <script src="../js/carouselmultiitem.js"></script>

    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	</div>	<!-- #2-->
</div><!--contentpagina--> <!-- #1-->
  </body>
  
	<footer id="footer" class="footer">
	</footer>
</html>


