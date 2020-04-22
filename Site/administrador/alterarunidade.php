<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags          -->
	<meta name="description" content="">
	<meta name="author" content="">
<link rel="icon" href="../img/logos/sb.ico">	
	
		<title>Softbio - Editar unidade</title>
		
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
		<script src="../js/formulario.js"></script>
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	<script src="../js/codigos.js"></script>


<script src="../bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");
    });

window.onbeforeunload = function(event) {
event.returnValue = "asdasdfasdf";
};
function tiraVerificacao(){
window.onbeforeunload = null;
};
</script>
	
 </head>
<div id="navbar">
	
</div>

	<body>

	
	     <?php
		 session_start();
		include "conexao.php";
	//$_SESSION["id_frentepassou"]=$_SESSION["id_frente"];	
		
if($_SESSION['adm']!='s')
 header("Location: /hope/tcc/login.php");

	
		//$id=$_GET['id']; //id - unidade
		
		$_SESSION["imguni"]=1;
		if ($_SESSION["idaqui"]==null)
		{
			$id=$_POST['idunidade'];
		}
		else 
		{
			
			$id=$_SESSION["valorid"];
			//unset ($_SESSION["valorid"]);
		}
		
		// $_SESSION["vez"]=1;
		$_SESSION["passouparaalterar"]=1;
		$_SESSION["id_unidade"]=$id;
	
		
		$id=$_POST['idunidade'];
		$_SESSION['id_unidade']=$id;
		
		$sql="Select * FROM unidade where id_unidade=".$id;
		
		$resultado= pg_query($conecta, $sql);
		$qtde=pg_num_rows($resultado);
		if ($qtde > 0)
		{
			
				$linha=pg_fetch_array($resultado);
		}
			
			//$_SESSION["id"]=$id;

		
?>
   	<div class="contentpagina">

	
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
	<!-- Navbar -->

		<!-- Collect the nav links, forms, and other content for toggling -->
	<!--Menu-->
	<form  action="gravaalteracaounidade.php" data-toggle="validator"  method="post" onsubmit="tiraVerificacao()" name="contact_form" id="contact_form">
		
	<div class="container-fluidinho">	

	<div class="container-fluida">

		     <div class="row text-center" id="colorida">
		  
			<center><h1>Edição de Unidade<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					    </h1></center>
<hr>
		<br>
		</div>
	</div>



	<div class="container-fluidcad">
	<fieldset>
		<div class="row">
		
		
		<?php
		
		
		
		$id_frente=$_SESSION["id_frente"];
		$_SESSION["id_frentealterou"]=$_SESSION["id_frente"];
		//$_SESSION["id_frentepassou"]=$_SESSION["id_frente"];
		
		//echo "id frente: ".$_SESSION["id_frentealterou"];
		//FRENTE ESCOLHIDA
		$sql1="Select * FROM frente where id_frente=".$id_frente;
	
			$resultado1= pg_query($conecta, $sql1);
			$qtde1=pg_num_rows($resultado1);
			
			
		
		$sqlfrente="Select * FROM frente  order by id_frente";
		$resultado_frente= pg_query($conecta, $sqlfrente);
			

			if ($qtde1 > 0)
			{ $linha1=pg_fetch_array($resultado1);
				?>
				<aside class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>Frente:</b></h3></label>
				
			
				<div class="input-group">
						 <select class="form-control" name="id_frente" required>
						
		
		
					<optgroup label="id frente">
				<?php
					
					while ($linhafrente=pg_fetch_array($resultado_frente))
					{
						
						?>
						<option value="<?php echo $linhafrente[id_frente]; ?>" <?php echo ($linhafrente[id_frente] == $id_frente) ?  "selected=\"selected\"" : null;?>><?php echo $linhafrente[id_frente].". ".$linhafrente[frente];?></option>
						<?php
						
					}
					
				?>
					</optgroup>  
						   </select>
				<span class='input-group-addon add-on'></span>
			   </div> 
		
				
		<div class='help-block with-errors'></div>
	</div>
	</aside>
		<br>
		<?php
			}
		?>
		

			

			<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				<div class="form-group">

				<label for="inputtitulo" class="control-label"><b><h3>Unidade:</b></h3></label>
				
				<div class="input-group">
					<input id="inputtitulo" class="form-control" onkeypress="return letras();"  placeholder="Digite o nome da unidade"  type="text" name="unidade" minlength="5" maxlength="50" value="<?php echo $linha[unidade]; ?>" required> 
	<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
				
		
			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="texto" class="control-label"><b><h3>Descrição:</b></h3></label>
				
				<div class="input-group">
				<textarea cols="100" id="texto" rows="5" name="descricao"  class="form-control" required placeholder="Digite a descrição da unidade escolhida"  style="text-align: justify;"><?php echo $linha[descricao]; ?></textarea>     
				  
				</div>
				  
			</div>
	</div><!--row-->
	<hr>
	<br>






	


		<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Editar</button>
		  <a href="submenualteraunidade.php" class="btn btn-primary">Voltar</a>

		  <?php if($linha["imagem"]==null)
				{
					?>
		<a href="cadastrarimagemuni.php" class="btn btn-primary" >Inserir imagem</a>
				
			<?php
				} 
			else{
				?>
				<a href="#modaltirarimagem" data-toggle="modal" class="btn btn-primary" >Retirar imagem</a>
				<?php
			}
				?>
				
		  
		  <!--janela modal, código adaptado de Maurício 'Maujor' Samy Silva-->
		  <?php if($linha["excluido"]=="n")
				{
					?>
		<a href="#modalexcluir" data-toggle="modal" class="btn btn-primary" >Excluir</a>
			<?php
				} 
			else{
				?>
				<a href="#modalreativar" data-toggle="modal" class="btn btn-primary" >Reativar unidade</a>
				<?php
			}
				?>
		</div>

	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>

	
	
	 </form>
	 
	 <!--      modalll    -->
	 

	
	  </fieldset>
	  </div>

	 
</div>

	 <div  class="modal fade" id="modalexcluir" tabindex="-1" role="dialog" aria-labelledby="modalexcluirLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente excluir esta unidade?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="excluirunidade.php" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
				<button type="submit" class="btn btn-primary" id="finalizar">Excluir</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
			<!--
            <div class="modal-footer">
              
            </div>-->
        </div> 
			</div>  
  
    
    
          </font>

    
    </div> <!-- /.col-* --> 
	
	<!-- outro modal -->
	
	 <div  class="modal fade" id="modalreativar" tabindex="-1" role="dialog" aria-labelledby="modalreativarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente reativar esta unidade?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="reativarunidade.php" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
				<button type="submit" class="btn btn-primary" id="finalizar">Reativar</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
    </div> 
	
	
	
		 <div  class="modal fade" id="modaltirarimagem" tabindex="-1" role="dialog" aria-labelledby="modaltirarimagemLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente retirar esta imagem?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="retirarimagemuni.php" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
				<button type="submit" class="btn btn-primary" id="finalizar">Retirar</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
    </div> 
	<!--     modal-->
  

		<script src="../js/bootstrap.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>