<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags          -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../img/logo.png">
	
	
		<title>Softbio - Editar subunidade</title>
		
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
      $("#footer").load("../footer.html"); 
	  $("#navbar").load("../navbar.php?p=cadastrounidadeadm");
    });


</script>
	
 </head>
<div id="navbar">
	
</div>

	<body>
	<div class="contentpagina">
	
	     <?php
		include "conexao.php";
		
		session_start();
if($_SESSION['adm']!='s')
	header("Location: /hope/tcc/login.php");

	
		$id= $_GET["id"];
		$_SESSION["id"] =$id;

		
		$id= $_GET["id"];
		
		
		$sql="Select * FROM subunidade where id_subunidade=".$id." order by id_unidade";
		$resultado= pg_query($conecta, $sql);
		$qtde=pg_num_rows($resultado);
		if ($qtde > 0)
		{
			
				$linha=pg_fetch_array($resultado);
		}
			
			
		$sql2="Select * FROM unidade where id_unidade=".$linha[id_unidade];
		$resultado2= pg_query($conecta, $sql2);
		$qtde2=pg_num_rows($resultado2);
		
		if ($qtde2 > 0)
		{
			
			$linha2=pg_fetch_array($resultado2);
		}

		
?>
   

	
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
	<!-- Navbar -->

		<!-- Collect the nav links, forms, and other content for toggling -->
	<!--Menu-->
	<form  action="gravaalteracaosubunidade.php" data-toggle="validator"  method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluidinho">	

	<div class="container-fluida">

		     <div class="row text-center" id="colorida">
		  
			<center><h1>Edição de Subunidade<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					    </h1></center>
<hr>
		<br>
		</div>
	</div>



	<div class="container-fluidcad">
	<fieldset>
		<div class="row">
		
		
		<!--<aside class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>Id Unidade:</b></h3></label>
				
				<div class="input-group">
					<input id="inputEmail" class="form-control"  value="<?php echo $linha[id_unidade]; ?>"   type="number" maxlength="1000"  name="id_unidade"  required> 
					<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>-->
			
			<?php
		

		
		
		$sql_unidade="select  * from frente, unidade where frente.id_frente=unidade.id_frente order by unidade.id_frente";
		

			$resultado= pg_query($conecta, $sql_unidade);
			$qtde=pg_num_rows($resultado);
			
	

			if ($qtde > 0)
			{?>
				<aside class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>ID Unidade:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
				<div class="input-group">
						 <select class="form-control" name="id_unidade" required>
						
		
		
					<optgroup label="Unidade">
				<?php
					
					while ($linhafrente=pg_fetch_array($resultado))
					{
						
						?>
						<option value="<?php echo $linha[id_unidade]; ?>" <?php echo ($linhafrente[id_unidade] == $linha2[id_unidade]) ?  "selected=\"selected\"" : null;?>><?php echo $linhafrente[unidade];?></option>
						<?php
						
					}
					
				?>
					</optgroup>  
						   </select>

				<span class='input-group-addon add-on'></span>
			   </div> 
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

				<label for="inputtitulo" class="control-label"><b><h3>Subunidade:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
					<input id="inputtitulo" class="form-control" onkeypress="return letras();" placeholder="Digite o título da curiosidade"  type="text" name="subunidade" maxlength="150" value="<?php echo $linha[subunidade]; ?>" required> 
	<span class="input-group-addon add-on"></span>
				</div>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
				
				
	<aside class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">

				<div class="form-group">

				<label for="inputEmail" class="control-label"><b><h3>Dificuldade:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
				<div class="input-group">
						   <select class="form-control" name="dificuldade" required>
							  <optgroup label="Dificuldade do curso  ">
							  
								<option value="basico" <?php echo ($linha[dificuldade] == "basico") ?  "selected=\"selected\"" : null;?>>Básico</option>
								<option value="intensivo"   <?php echo ($linha[dificuldade] == "intensivo") ?  "selected=\"selected\"" : null;?>>Intensivo</option>
																
							  </optgroup>
						   </select>

						 <span class='input-group-addon add-on'></span>
			   </div> 
				</div>
				
				<div class='help-block with-errors'></div>
			   </div>
			</aside>
			<br>
			
			
		
			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="texto" class="control-label"><b><h3>Descrição:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
				<textarea cols="100" id="texto" rows="5" name="descricao"  class="form-control" required placeholder="Digite a curiosidade"  style="text-align: justify;"><?php echo $linha[descricao]; ?></textarea>     
				  
				</div>
				  
			</div>
	</div><!--row-->
	<hr>
	<br>





	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Editar</button>
			&emsp;&emsp;&emsp;&emsp;	  
		  <!--janela modal, código adaptado de Maurício 'Maujor' Samy Silva-->
		  <?php if($linha["excluido"]=="n")
				{
					?>
		<a href="#modalexcluir" data-toggle="modal" class="btn btn-primary" >Excluir</a>
			<?php
				} 
			else{
				?>
				<a href="#modalreativar" data-toggle="modal" class="btn btn-primary" >Reativar Subunidade</a>
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
              <h3 class="modal-title"><b>Deseja realmente excluir esta subunidade?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="excluirsubunidade.php" method="post">
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
              <h3 class="modal-title"><b>Deseja realmente reativar esta subunidade?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="reativarsubunidade.php" method="post">
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
	<!--     modal-->
  

		<script src="../js/bootstrap.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 
</div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>