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
	
	
		<title>Softbio - Editar curiosidade</title>
		
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
	
	

<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<!--	<script type="text/javascript" src="../js/jquery-1.8.3.min.js" charset="UTF-8"></script>-->
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8" media="screen"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8" media="screen"></script>

	

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
		include "conexao.php";
		include "substituir.php";
		
		session_start();
//if($_SESSION['adm']!='s')
//header("Location: /hope/tcc/login.php");

		

	$correto=$_SESSION['correto'];
	$_SESSION['correto']=null;


		
		if($correto==2)
		{
			$id=$_SESSION['id_cur'];
			$sql="Select * from curiosidades where id_curiosidades='$id'";
		}
		else
		{
			$id= $_POST["id_curiosidades"];
			$sql="Select * from curiosidades where id_curiosidades='$id'";
		}
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);
			if ($qtde > 0)
			{
				$linha=pg_fetch_array($resultado);
			}
			
			$_SESSION["id"]=$id;

			
			//$id=$_SESSION["id"];
			$nome=$tabela.$id;
			
			$_SESSION["type"]=$type;
			$_SESSION["pasta"]=$pasta;
			$_SESSION["tabela"]=$tabela;
			$_SESSION["id"]=$id;
			$_SESSION["nome"]=$nome;
?>
   

	
	  <div class="container-fluid contentpagina">
		<!-- Brand and toggle get grouped for better mobile display -->
	<!-- Navbar -->

		<!-- Collect the nav links, forms, and other content for toggling -->
	<!--Menu-->
	<form  action="verificatituloed.php" onsubmit="tiraVerificacao()" data-toggle="validator"  method="post" name="contact_form" id="contact_form">
		
	<div class="container-fluidinho">	

	<div class="container-fluida">

		     <div class="row text-center" id="colorida">
		  
			<center><h1>Edição de curiosidades<br>
                    <small>É obrigatório o preenchimento de todos os campos.</small>
					    </h1></center>
<hr>
		<br>
		</div>
	</div>


	<div class="container-fluidcad">
	<fieldset>
		<div class="row">

				<aside class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

				<div class="form-group">

				<label for="inputtitulo" class="control-label"><b><h3>Título</b></h3></label>
				<div class="input-group">
					<input id="inputtitulo" class="form-control" placeholder="Digite o título da curiosidade"  type="text" name="titulo" maxlength="150" value="<?php echo $linha[titulo]; ?>" required> 
<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>				</div>
				<?php
				if($correto==2) 
				{
					
					echo "<h6 class='title1'><br>Esta curiosidade já existe. Por favor, indique outro título.</h6>";
				}

				?>
				
				<div class="help-block with-errors"></div>
			   </div>
			</aside>
			<br>
	
				
		
			<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="texto" class="control-label"><b><h3>Texto</b></h3></label>
				<div class="input-group">
				<textarea cols="100" id="texto" rows="10" name="texto" style="resize: none;" class="form-control" required placeholder="Digite a curiosidade"  style="text-align: justify;"><?php echo $linha[texto];  //textoinput("curiosidades","iosidade","texto","$id"); ?></textarea>     
				  
				</div>
				  
			</div>
	</div><!--row-->
	<hr>
	<br>

	 <div class="row">
		<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

			<div class="form-group">
				<label for="fonte" onclick="javascript:habilitar()" class="control-label"><h3><b>Fonte</h3></b></label>
				<div class="input-group">
				<input type="text" class="form-control" id="fonte" placeholder="Digite a fonte da curiosidade"  value="<?php echo $linha[fonte]; ?>" name="fonte" required >

				<span class="input-group-addon"><span class="glyphicon glyphicon-export"></span></span>

			</div>
		
		  </div>
		  
	   </div><br><br>
	   

	<hr>
</div>

<div class="row">

	<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">
                <label for="texto" class="control-label"><b><h3>Data</b></h3></label>

                <div  class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="data" data-link-format="dd-mm-yyyy">
                    <input class="form-control"  type="text" readonly name="data_texto" id="data_texto" value="<?php echo date("d-m-Y", strtotime($linha[data])) ?>" >
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="data" name="data" required>
	</div>
		
	<script>
	$('.form_date').datetimepicker({
language: 'pt-BR',
weekStart: 1,
startDate:'01-01-2005', 
startDate: '01-01-2000',
endDate: '+0d',
format: 'dd-mm-yyyy',
todayBtn: 1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
minView: 2,
forceParse: 0
});
	</script>
	
	</div>

	
	
	



	<!--<div class="row">

		  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
		  
				
				<label for="data" onclick="javascript:habilitar()" class="control-label"><h3><b>Data</h3></b></label>
				<div class="input-group">	
				<input type="date" name="data" class="form-control" id="data"  onBlur="return data();"  value="< ?php echo $linha[data]; ?>"  maxlength="10" required />
				<span class="input-group-addon add-on"></span>
				</div>
  <div class="help-block with-errors"></div>				
		  </div>
	</div>-->

	
	
	
	
	<hr>
		<br>


	<div class="row">
		  <div class='form-group col-md-12'>
		  <center><button type="submit" class="btn btn-primary">Editar</button>
		  
		  <?php 
		  $nome_final= "../img/curiosidades/".$id.".jpg";
			if(file_exists($nome_final))
				{
					?>
		<a href="#modaltirarimagem" data-toggle="modal" class="btn btn-primary" >Editar imagem</a>
			<?php
				} 
			else{
				?>
				<a href="cadastrarimgcuriosidade.php" class="btn btn-primary" >Inserir imagem</a>

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
				<a href="#modalreativar" data-toggle="modal" class="btn btn-primary" >Reativar</a>
				<?php
			}
				?>
				
		<a href="editarcuriosidades.php" class="btn btn-primary" >Voltar</a>

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
              <h3 class="modal-title"><b>Deseja realmente excluir esta curiosidade?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="excluircuriosidade.php" method="post">

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
              <h3 class="modal-title"><b>Deseja realmente reativar esta curiosidade?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="reativarcuriosidade.php" method="post">

		
				<button type="submit" class="btn btn-primary" id="finalizar">Reativar</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
    </div> 
	<!--     modal-->
	
		
	<!-- outro modal -->
	
	 <div  class="modal fade" id="modaltirarimagem" tabindex="-1" role="dialog" aria-labelledby="modaltirarimagemLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente retirar esta imagem?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="retirarimgcuriosidades.php" method="post">
		
		
				<button type="submit" class="btn btn-primary" id="finalizar">Retirar</button>
				<a href="cadastrarimgcuriosidade.php" class="btn btn-primary" >Trocar imagem</a>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
    </div> 
	
	<!--modalllllllll-->
  

		<script src="../js/bootstrap.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 


	
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>