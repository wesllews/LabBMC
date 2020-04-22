<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
<link rel="icon" href="../img/logos/sb.ico">	
	<title>Softbio - Alteração de conteúdo</title>
		
	<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/apendices.css" rel="stylesheet">
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<script src="../js/ie-emulation-modes-warning.js"></script>
	<link href="../css/carousel.css" rel="stylesheet">
	<script src="../js/formulario.js"></script>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	<script src="../js/cadastro.js"></script>
	<script src="../bootstrap/jquery.js"></script>
<script> 
	$(function(){
	  $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");
	});
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});

	function recarrega()
	{
		document.getElementById("gravado").value="";	
		document.getElementById("excluir").value="";
		document.getElementById("adicionar").value="";
     	}

window.onbeforeunload = function(event) {
	event.returnValue = "asdasdfasdf";
	};

	function tiraVerificacao(){
	window.onbeforeunload = null;
	};

</script> 
<style>	.vermelho{color: red !important;}
textarea{resize:none;}
</style>

</head>
<div id="navbar"></div>

<body>
<div class="contentpagina">
<?php
session_start();
include "conexao.php";
include "substituir.php";
include "hashimagem.php";

//corrige um bug do textarea
$textarea ='required cols="54" rows="8" name="texto" class="form-control" maxlength="450" placeholder="Digite um conteúdo. Ex: Campo da biologia que estuda o reino vegetal."';


//variaveis de validação de click
$id_subunidade=$_POST['id_subunidade'];
if($id_subunidade)
	$_SESSION['id_subunidade'] = $id_subunidade;
else
	$id_subunidade = $_SESSION['id_subunidade'];
$id_slide=$_POST['id_slide'];
$gravado=$_POST['gravado'];
$adicionar=$_POST['adicionar'];
$excluir=$_POST['excluir'];

//Variaveis enviadas pelo form
$layout2 = $_POST['layout'];
$titulo2 = $_POST['titulo'];
$texto2= $_POST['texto'];

//validacao sql-injection
$titulo2 = anti_injection($titulo2);
$texto2= anti_injection($texto2);
$texto2=textobanco($texto2);
$data=date("d/m/Y");

if(!$id_slide && !$gravado && !$adicionar && !$excluido)
	{
		?>
	<script>
		$(document).ready(function(){
		  $("#slideshow").hide();
		  $("#form").hide();
		  $("#slidehide").hide();
		});
	</script>
		<?php
	}
	else
		{
		?>
		<script>
		$(document).ready(function(){
		  $("#slideshow").show();
		  $("#form").show();
		  $("#slidehide").hide();
		   $("#slides").hide(700);

		$("#slidehide").click(function(){
		  $("#slides").hide(600);
		  $("#slidehide").hide();
		  $("#slideshow").show();
			});
		$("#slideshow").click(function(){
		  $("#slides").show(600);
		  $("#slidehide").show();
		  $("#slideshow").hide();
		});
	});
	</script>
		<?php
	}



$sql="SELECT *,subunidade.subunidade FROM conteudo INNER JOIN subunidade ON conteudo.id_subunidade=subunidade.id_subunidade WHERE 
subunidade.excluido ='n' and 
conteudo.id_subunidade=$id_subunidade and 
conteudo.excluido='n' ORDER BY id_slide ASC";
$resultado= pg_query($conecta, $sql);
$qtde=pg_num_rows($resultado);	
if($qtde > 0)
{	?>
	<div class="row" id="slides" style="padding-left: 2%;">
		<center>
		<h3>Escolha qual slide deseja alterar:</h3>
		</center>
		<form id="formplus" action="alterarconteudopagina.php" method="post" >
		<input type="hidden" name="adicionar" value="s">
		<input type="hidden" name="id_subunidade" value="<?php echo $id_subunidade;?>">
		<input type="hidden" name="gravado" value="n">
		<div class="col-sm-4 col-md-3" onclick="tiraVerificacao(); document.getElementById('formplus').submit();" style="cursor:pointer;" >
			<div class="thumbnail" style="height:260px;">
			  <img style="height:260px; padding:40px;" src="../img/estudo/plus.png">
		  </div>
		</div>		  
		  </form>		
	<?php
	while($linha = pg_fetch_array($resultado))
	{
		if($id_slide==$linha['id_slide'])
		{
			$id_conteudo=$linha['id_conteudo'];
			$id_subunidade=$linha['id_subunidade'];
			$texto=$linha['texto'];
			$id_slide=$linha['id_slide'];
			$titulo=$linha['titulo'];
			$layout=$linha['layout'];
			$subunidade=$linha['subunidade'];
			$imagem=$linha['imagem'];
			$excluido='n';
		}	

		$caracteres = strlen($linha['titulo']);
		if($caracteres<=23)
			$caracteres=130;
		else if($caracteres>23 && $caracteres<33)
			$caracteres=80;
		else if($caracteres>=33)
			$caracteres=50;

		?>	
		<form id="form<?php echo $linha['id_slide'];?>" action="alterarconteudopagina.php" method="post">
		<input type="hidden" name="id_slide" value="<?php echo $linha['id_slide'];?>">
		<input type="hidden" name="id_subunidade" value="<?php echo $linha['id_subunidade'];?>">
		<input type="hidden" name="gravado" value="n">
		<div class="col-sm-4 col-md-3" onclick="tiraVerificacao(); document.getElementById('form<?php echo $linha['id_slide'];?>').submit();" style="cursor:pointer;">
			<div class="thumbnail" style="height:260px;">
			  <img style="height:80px;" src="img/style<?php echo $linha['layout'];?>.png">
			  <div class="caption">
				<h3><?php echo $linha['id_slide'].")".$linha['titulo'];?></h3>
				<p><?php echo limitarTexto(textohtml2($linha['texto']),$caracteres);?></p>
			  </div>
			</div>
		  </div>			  
		  </form>	
	<?php
	}
}

$sql="SELECT *,subunidade.subunidade FROM conteudo INNER JOIN subunidade ON conteudo.id_subunidade=subunidade.id_subunidade WHERE subunidade.excluido ='n'
 and conteudo.id_subunidade=$id_subunidade and 
 conteudo.excluido='s' ORDER BY id_slide ASC";
$resultado= pg_query($conecta, $sql);
$qtde=pg_num_rows($resultado);	
if($qtde > 0)
{	
	while($linha = pg_fetch_array($resultado))
	{
		if($id_slide==$linha['id_slide'])
		{
			$id_conteudo=$linha['id_conteudo'];
			$id_subunidade=$linha['id_subunidade'];
			$texto=$linha['texto'];
			$id_slide=$linha['id_slide'];
			$titulo=$linha['titulo'];
			$layout=$linha['layout'];
			$subunidade=$linha['subunidade'];
			$imagem=$linha['imagem'];
			$excluido='s';
		}		

		$caracteres = strlen($linha['titulo']);
		if($caracteres<=23)
			$caracteres=130;
		else if($caracteres>23 && $caracteres<33)
			$caracteres=80;
		else if($caracteres>=33)
			$caracteres=50;
		?>	
		<form id="form<?php echo $linha['id_slide'];?>" action="alterarconteudopagina.php" method="post" >
		<input type="hidden" name="id_slide" value="<?php echo $linha['id_slide'];?>">
		<input type="hidden" name="id_subunidade" value="<?php echo $linha['id_subunidade'];?>">
		<input type="hidden" name="gravado" value="n">
		<div class="col-sm-4 col-md-3" onclick="tiraVerificacao(); document.getElementById('form<?php echo $linha['id_slide'];?>').submit();" style="cursor:pointer;" >
			<div class="thumbnail" style="height:260px;">
			  <img style="height:80px;" src="img/style<?php echo $linha['layout'];?>.png">
			  <div class="caption vermelho">
				<h3><?php echo $linha['id_slide'].")".$linha['titulo'];?></h3>
				<p><?php echo limitarTexto(textohtml2($linha['texto']),$caracteres);?></p>
			  </div>
			</div>
		  </div>			  
		  </form>	
	<?php
	}
}
?>	

</div>

	<div id="slideshow" class="btn btn-success">
		<span class="glyphicon glyphicon-menu-down"></span>
	</div>

	<div id="slidehide" class="btn btn-success">
		<span class="glyphicon glyphicon-menu-up"></span>
	</div>
		
<?php 
if($adicionar=='s' && $gravado=='s'){ //adicionar
	//Maior id_conteudo para inserir imagem
	$sql="SELECT max(id_conteudo) FROM conteudo";
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado); 
	if($qtde > 0)
	{
		$linha = pg_fetch_array($resultado);
		$proximoconteudo=$linha[0] + 1;
	}
	//Maior id_slide da subunidade em questão
	$sql="SELECT max(id_slide) FROM conteudo where conteudo.id_subunidade=$id_subunidade";
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	if($qtde > 0)
	{
		$linha = pg_fetch_array($resultado);
		$proximoslide=$linha[0] + 1;
	}
	$nome=retornaHash();
	$pasta="../img/estudo/";
	$target_file = $pasta . basename($_FILES['arquivo']['name']);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$target_file = $pasta.$nome.".".strtolower($imageFileType);


	$sqlconteudo="insert into conteudo values(nextval('conteudo_id_conteudo_seq'::regclass),$id_subunidade,'$texto2','$data','n',NULL,$proximoslide,'$target_file','$titulo2',$layout2)";

		$resultado= pg_query($conecta, $sqlconteudo);
		$qtde=pg_affected_rows($resultado);	
		if($qtde < 0)
		{ ?>
		<script>alert("OPS! Tivemos um problema para inserir um novo slide. Tente novamente!");
		history.go(0);
		</script>
		<?php
		}
		else
		{				
			// Check if file already exists
			if (file_exists($target_file)) {
				unlink($target_file);
				header($_SERVER['PHP_SELF']);
			}
			// Check file size
			if ($_FILES["arquivo"]["size"] > 500000) {
				echo "<script>alert('A imagem excede o tamanho ideal');</script>";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 1) 
			{
				if (move_uploaded_file($_FILES["arquivo"]["tmp_name"],$target_file)) 
				{ ?>
					<script>alert("Feito! Slide adicionado com sucesso.");
					window.location.href ='alterarconteudopagina.php';
					</script>
				<?php
				} 
				else
				{ ?>
					<script>alert("Feito! Slide adicionado com sucesso, porém houve um possível erro na imagem");
					window.location.href ='alterarconteudopagina.php';
					</script>
				<?php
				}
			} 
			else
			{
				?>
					<script>alert("OPS! Tivemos um problema para salvar a imagem. Tente novamente!");
					window.location.href ='alterarconteudopagina.php';
					</script>
				<?php
			}
		}
}//Adicionar
if($excluir=="s" && $gravado=='s'){
$sql="update conteudo set excluido='s' where id_conteudo=$id_conteudo and id_slide=$id_slide and id_subunidade=$id_subunidade";
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);	
	if($qtde < 0)
	{ ?>
		<script>alert("OPS! Tivemos um problema para excluir slide. Tente novamente!");
		window.location.href ='alterarconteudopagina.php';
				</script>
			<?php
	}
	else
	{ ?>
		<script>alert("Feito! Slide excluido com sucesso");
		window.location.href ='alterarconteudopagina.php';
				</script>
			<?php
		} 	

} 
if($gravado=='s' && $adicionar!="s" && $excluir!="s"){
$nome=retornaHash();
$pasta="../img/estudo/";
$target_file = $pasta . basename($_FILES['arquivo']['name']);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$target_file = $pasta.$nome.".".strtolower($imageFileType);
$imagem2;
if ($_FILES['arquivo']['name']) {
	$imagem2=$target_file;
	$upar='s';
}
else{
	$upar='n';
	$imagem2=$imagem;
}

$sql="update conteudo set titulo='$titulo2',layout =$layout2,texto ='$texto2',imagem='$imagem2', excluido='n' where id_conteudo=$id_conteudo and id_slide=$id_slide and id_subunidade=$id_subunidade";
			$resultado= pg_query($conecta, $sql);
			$qtde=pg_num_rows($resultado);	
			if($qtde < 0)
			{ ?>
				<script>alert("OPS! Tivemos um problema para alterar o slide. Tente novamente!");
				window.location.href ='alterarconteudopagina.php';
				</script>
			<?php
			}
			else
			{			
				// Check if file already exists
				if (file_exists($imagem) && $upar!='n') {
					unlink($imagem);
					echo "<script>alert('unlink - $upar');</script>";
					header($_SERVER['PHP_SELF']);
				}
				// Check file size
				if ($_FILES["arquivo"]["size"] > 500000) {
					echo "<script>alert('A imagem excede o tamanho ideal');</script>";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 1 && $upar!='n') 
				{
					if (move_uploaded_file($_FILES["arquivo"]["tmp_name"],$target_file))
					{ ?>
						<script>alert("Feito! Slide alterado com sucesso");
						window.location.href ='alterarconteudopagina.php';
						</script>
						<?php
					} 
					else
					{?>
						<script>alert("Feito! Slide alterado com sucesso, porém houve um possível erro na imagem");
						window.location.href ='alterarconteudopagina.php';
						</script>
						<?php
					}
						
				} 
				else
					{?>
						<script>alert("Feito! Slide alterado com sucesso, a imagem anterior foi mantida");
						window.location.href ='alterarconteudopagina.php';
						</script>
						<?php
					}
				
			}
}
?>	


<form action="alterarconteudopagina.php" method="post" id="formreload">
<input type="hidden" name="id_subunidade" value="<?php echo $id_subunidade;?>">	
</form>



<form action="alterarconteudopagina.php" data-toggle="validator" method="post" id="form" enctype="multipart/form-data">

	<div class="container-fluid">
		<div class="row text-center" style="height:35%; margin-left:2px;" >
		<h1><b>Alteração de Conteúdo</b> 
			<a href="#" title="Instruções básicas" data-toggle="popover" data-trigger="hover" data-content="O conteúdo do SoftBio é dividido em slides, por favor, escolha as informações básicas e comece já a inserir os conteúdos! :)">            
			<span class="glyphicon glyphicon-question-sign hidden-xs" aria-hidden="true" style="font-size:35px; margin-top:10px;"></span>
			</a>
        </h1>
		</div>
	</div>
	
	<div class="row">
	<div class="has-warning"><!--Mensagem de erro-->
		<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
			<center><label for="warning" class="control-label">É obrigatório o preenchimento dos campos com *</label></center>
		</div>
	</div>
	</div>

	<div class="row text-center" style="height:35%; margin-left:2px;" >
		<h1><b>Slide
		<?php
			echo $id_slide;
			if($id_slide==1){
		?>
			<a href="#" title="Instruções básicas" data-toggle="popover" data-trigger="hover" data-content="O slide 1 é o seu slide inicial, escolha título, um subtítulo e uma imagem (pode ser gif!) para iniciar!">            
			   <span class="glyphicon glyphicon-question-sign hidden-xs" style="font-size:35px; margin-top:10px;"></span>
			</a>
	<?php 
			}
		?>
		</b></h1>
	</div>
          
	<div class="container-fluidcad" >
	<fieldset>

	<div class="form-group col-md-7 col-xs-8 col-md-offset-3 col-xs-offset-1">
		<label  class="control-label"><h3><b>Layout:</b></h3></label>
		<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
	</div>

	<div class="form-group col-md-7 col-xs-8 col-md-offset-3 col-xs-offset-3">
		<div class="input-group">
			<input type="radio" name="layout" id="layout1" value="1" <?php if($layout==1 || $layout=="")echo"checked";?> >
			<label for="layout1" class="radio-inline layout" style="padding:0px;margin-bottom:5px;margin-left:-15px;"><img src="img/style1.png" style="width:140px" ></label>
			<input type="radio" name="layout" id="layout2" <?php if($layout==2)echo"checked";?> value="2" >
			<label for="layout2" class="radio-inline layout" style="padding:0px;margin-bottom:5px;"><img src="img/style2.png" style="width:140px" ></label>
			<input type="radio" name="layout" id="layout3" value="3" <?php if($layout==3)echo"checked";?>>
			<label for="layout3" class="radio-inline layout" style="padding:0px;margin-bottom:5px;"><img src="img/style3.png" style="width:140px" ></label>
			<input type="radio" name="layout" id="layout4" value="4" <?php if($layout==4)echo"checked";?>>
			<label for="layout4" class="radio-inline layout" style="padding:0px;margin-bottom:5px;"><img src="img/style4.png" style="width:140px" ></label>
		</div>
			<div class="help-block with-errors"></div>
	</div>
			
	<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

		<label  class="control-label"><h3><b>Título:</b></h3></label>
		<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
		<div class="input-group">
			<input id="inputEmail" class="form-control" value="<?php echo $titulo;?>" placeholder="Digite um título para o seu slide. Ex: Estrutura dos poríferos." type="text" maxlength="40" name="titulo" required > 
			<span class="input-group-addon add-on"></span>
		</div>	
		<div class="help-block with-errors"></div>
			
	</div>

	<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>
	  
		<label for="descricao" class="control-label"><h3><b>Conteúdo:</b></h3></label>
		<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
		<div class="input-group">
<textarea <?php echo $textarea;?> ><?php if($texto!="") {echo textoinput2($texto);}?></textarea>
			<span class="input-group-addon add-on"></span>
		</div>
		<div class="help-block with-errors"></div>
		
	</div>
	
	<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

		<label for="inputEmail" class="control-label"><h3><b>Imagem:</b></h3></label>
		<div class="input-group">	
		<img style="height:180px; border:5px solid #53c653; border-radius:10px; padding4px;" class="img-responsive" src="<?php echo $imagem;?>">		
		<br>
		<input type="file" name="arquivo" id="fileToUpload" accept="<?php echo $type;?>" class="uploadlogo"> 
		<label for="fileToUpload"><span id="uploadspan"><?php if(!$adicionar) echo"Alterar imagem&hellip;"; else echo"Inserir imagem&hellip;";?></span></label>
		
		<script>
		$('#fileToUpload').change(function(e) {
		var filename = e.target.files[0].name
		console.log(filename);
		$("#uploadspan").text(filename);

		});
		</script>
		<input type="hidden" name="id_slide" value="<?php echo $id_slide;?>">
		<input type="hidden" name="id_subunidade" value="<?php echo $id_subunidade;?>">
		<input type="hidden" name="gravado" value="s">
		<input type="hidden" name="adicionar" value="<?php echo $adicionar;?>">
			<!--quando der submit, mudar o value do input hidden-->
			<br><br>
		</div>

		<div class="help-block with-errors"></div>
			
		</div>
	
	<div class='form-group col-md-12 col-xs-12'>
		<center>
		<input onclick="tiraVerificacao();" type="submit" class="btn btn-primary" style="font-size:18px;margin-left:0;margin-right:25px;" value="<?php if($excluido=='s')echo"Salvar e Recuperar"; else if(!$adicionar) echo"Salvar alteração"; else echo"Inserir slide";?>">
		<?php if(!$adicionar && $excluido!='s'){ ?>
		<input type="hidden" name="excluir" id="excluir" value="n">
		<button type="submit" onclick="tiraVerificacao(); document.getElementById('excluir').value='s'" class="btn btn-primary" style="font-size:18px;margin-left:0;margin-right:25px;"> Excluir slide</button>
		<?php } ?>
		</center>
	</div>

	</fieldset>
	</div>  
</form>

</div>
<div class="row">
<hr>
	<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="tiraVerificacao();" href="http://200.145.153.172/hope/tcc/administrador/alterarconteudo.php" class="btn btn-primary">Voltar</a></center>
	<br>
</div>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/holder.min.js"></script>
	<script src="../js/bootstrapvalidator.min.js"></script> 
	<script src="../js/cadastro.js"></script> 
	 	 
<footer id="footer" class="footer">	</footer>
 </body>
</html>