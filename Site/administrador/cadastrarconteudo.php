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
	
		<title>Softbio - Cadastro de conteúdo</title>
		
				<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
		
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
   
		<script src="../js/cadastro.js"></script>
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
	<div class="contentpagina">


  <?php
  
  /*Início do php*/
  include "conexao.php";
  session_start();
  if($_SESSION['adm']!='s')
     header("Location: /hope/tcc/login.php");
						
	$_SESSION["usuario"];
	$_SESSION["senha"];  
	
  	$idslide=$_SESSION['idslide'];
	
	$correto=$_SESSION['correto'];
	
	
	
	
	//$_SESSION['subunidadehope']=$_GET['subunidadehope'];
  	$subunidadehope=$_SESSION['subunidadehope'];
	$type="image/png,image/jpeg,image/jpg,image/gif"; 
	$tabela="conteudo";
	$_SESSION["subunidadehope"]=str_replace(chr(32), "_", $_SESSION["subunidadehope"]);
	
	//select para descobrir qual vai ser o próximo id_conteudo
    $sql="SELECT max(id_conteudo) FROM conteudo";

	$resultado= pg_query($conecta, $sql);
	$total=pg_num_rows($resultado);
	
	$linha = pg_fetch_array($resultado);
	
	if($total > 0)
	{
		$idproximoconteudo=$linha[0];
		$idproximoconteudo++;
	}	
	else{
		echo "Erro, por favor tente novamente em outra encarnação.";
	}

	$id=$idproximoconteudo;
	$gif="s";
	$tabela=$tabela.$id;



?>
	<form action="gravaconteudo.php" data-toggle="validator" onsubmit="tiraVerificacao()"  method="post" name="contact_form" id="contact_form" enctype="multipart/form-data">

	<input type="hidden" name="idslide" value=<?php echo $idslide;?>>
	<input type="hidden" name="subunidadehidden" id="subunidadehidden" value=<?php echo $_SESSION["subunidadehope"];?>>

	<div class="container-fluid">	

	<div class="container-fluid">
		  <div class="row text-center" style="padding-top:25px; height:35%; margin-left:2px;" >
		<h1><b>Cadastro de Conteúdo</b>
 
  <a href="#" title="Instruções básicas" data-toggle="popover" data-trigger="hover" data-content="O conteúdo do SoftBio é dividido em slides, por favor, escolha as informações básicas e comece já a inserir os conteúdos! :)">            
   <span class="glyphicon glyphicon-question-sign hidden-xs" aria-hidden="true" style="font-size:35px; margin-top:10px;"></span>
</a>
         </h1>

             
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>

		</div>
	</div>



		<div class="row">
	<div class="has-warning"><!--Mensagem de erro-->
<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
			<center><label for="warning" class="control-label">É obrigatório o preenchimento dos campos com *</label></center>
		</div>
		  </div>
	</div>
	<script>
	 function check(){
		var x=document.getElementById("subunidade");
          // Things to do when the textbox changes
			document.getElementById("subunidadehidden").value = x.value;		
     	}

	</script>
		  <div class="row text-center" style="height:35%; margin-left:2px;" >
		<h1><b>Slide
		<?php
			echo $idslide;
			if($idslide==1){
		?>
		
  <a href="#" title="Instruções básicas" data-toggle="popover" data-trigger="hover" data-content="O slide 1 é o seu slide inicial, escolha título, um subtítulo e uma imagem (pode ser gif!) para iniciar!">            
   <span class="glyphicon glyphicon-question-sign hidden-xs" aria-hidden="true" style="font-size:35px; margin-top:10px;"></span>
</a>
	<?php 
			}
		?>
		<b></h1>
	</div>
          
	<div class="container-fluidcad">
	<fieldset>
		<?php 
			if($idslide==1){
		?>
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">


			<label for="inputEmail" class="control-label"><b><h3>Subunidade:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
					<input id="subunidade" name="subunidade" class="form-control"  
					<?php if($correto == 1){?>
		  data-toggle="popover" data-content="Por favor, verifique o nome da subunidade."  title="Subunidade não existe!" 
		  style="background-color:#F9B1B1;"
		  <?php
		}else if($correto==2){
			?>
			 data-toggle="popover" data-content="Por favor, escolha outra subunidade ou acesse a página de alteração de conteúdo."  title="A subunidade já possui slides cadastrados!" 
		  style="background-color:#F9B1B1"
		  <?php
		}
	  ?>
	  autocomplete='off' onchange="check();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" maxlength="50" placeholder="Digite uma subunidade. Ex: Poríferos" type="text" maxlength="50" onkeypress="return letras();" name="subunidade"  required> 
					
					<span class="input-group-addon add-on"></span>
				</div>
					    <script>
	
	$(document).ready(function(){
    $('[data-toggle="popover"]').popover();  
    $(this).popover('show');
	
});

	</script>
				<div class="help-block with-errors"></div>
			
		</div>
		<?php 
			}
		?>

			<div class="form-group col-md-7 col-xs-8 col-md-offset-3 col-xs-offset-1">

				<label for="inputEmail" class="control-label"><b><h3>Escolha um layout:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				</div>

			<div class="form-group col-md-7 col-xs-8 col-md-offset-3 col-xs-offset-3">

				<div class="input-group">
<input type="radio" name="layout" id="layout1" value="1" checked/>
<label for="layout1" class="radio-inline layout" style="padding:0px;margin-bottom:5px;margin-left:-15px;"><img src="img/style1.png" style="width:140px" alt=""></label>
<input type="radio" name="layout" id="layout2" value="2" />
<label for="layout2" class="radio-inline layout" style="padding:0px;margin-bottom:5px;"><img src="img/style2.png" style="width:140px" alt=""></label>
<input type="radio" name="layout" id="layout3" value="3" />
<label for="layout3" class="radio-inline layout" style="padding:0px;margin-bottom:5px;"><img src="img/style3.png" style="width:140px"  alt=""></label>
<input type="radio" name="layout" id="layout4" value="4" />
<label for="layout4" class="radio-inline layout" style="padding:0px;margin-bottom:5px;"><img src="img/style4.png" style="width:140px"  alt=""></label>
				</div>
				<div class="help-block with-errors"></div>
			   </div>
			
<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

				<label for="inputEmail" class="control-label"><b><h3>Título:</b></h3></label>
				<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
					<input id="inputEmail" class="form-control"  placeholder="Digite um título para o seu slide. Ex: Estrutura dos poríferos." type="text" maxlength="40"  name="titulo"  required> 
					<span class="input-group-addon add-on"></span>
				</div>
					
				<div class="help-block with-errors"></div>
			
		</div>
			<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>
							   
				<label for="descricao" class="control-label"><b><h3>Conteúdo:</b></h3></label>
								<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
				<div class="input-group">
			<textarea cols="54" rows="8" name="conteudo" class="form-control" maxlength="450"   style="resize:none;" placeholder="Digite uma conteúdo. Ex: Campo da biologia que estuda o reino vegetal." required></textarea>
				  <span class="input-group-addon add-on"></span>
				</div>
				  		
				
				<div class="help-block with-errors"></div>

			</div>
<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

				<label for="inputEmail" class="control-label"><b><h3>Imagem:</b></h3></label>
			
							<div class="input-group">				
							<input type="file" name="arquivo" id="fileToUpload" accept="<?php echo $type;?>" class="uploadlogo"> 

							<label for="fileToUpload">
    
    						<span id="uploadspan">Escolha uma imagem&hellip;</span>

							</label>
							
							<script>
							$('#fileToUpload').change(function(e) {
							var filename = e.target.files[0].name
							console.log(filename);
							$("#uploadspan").text(filename);

							});
							</script>
								<input type="hidden" name="pasta" value="../img/estudo/" >
								<input type="hidden" name="tabela" value="<?php echo $tabela; ?>" >
								<input type="hidden" name="id" value="<?php echo $id; ?>" >
								<input type="hidden" name="gif" value="<?php echo $gif; ?>" >
  								<!--quando der submit, mudar o value do input hidden-->
								<br><br>
							</div>

				<div class="help-block with-errors"></div>
			
		</div>

			 <div class='form-group col-md-12 col-xs-12'>
			
		  	<center><input type="submit" class="btn btn-primary" style="font-size:18px;margin-left:0;margin-right:25px;"  onclick="faz(0);" name="proximo" value="Próximo slide"></input></center>

		  </div>

		   <div class='form-group col-md-12 col-xs-12'>
		  </div>

	</div><!--row-->

	

	

	


	
				</div>
				
	<hr>
		  

	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><a href="#modalFinalizar" data-toggle="modal" class="btn btn-primary" style="font-size:22px">Finalizar apresentação</a></center>
		  </div>

	</div>
	
	
	  </fieldset>

  

		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/holder.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 
	 
</div>
<script>
function faz(x) {
    document.getElementById("finalizar").value = x;
    document.getElementById('contact_form').submit();

}
</script>
 <div  class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="modalFinalizarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja salvar o slide atual?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
			
		<center><input type="submit" class="btn btn-default" id="finalizarslides" onclick="faz(1);" name="finalizarsim" value="Sim"></input>
				<input  type="submit" class="btn btn-default" id="finalizarslides"  onclick="faz(2);" name="finalizarnao" value="Não"></input></center>
<input type="hidden" name="botao" id="finalizar" >
              </form>

            </div>
			<!--
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>-->
        </div> 
			</div>  
  
    
    
          </font>

    
    </div> <!-- /.col-* --> 

</div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>