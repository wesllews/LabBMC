<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Softbio - Página de estudo</title>


    <link rel="icon" href="img/logos/sb.ico">

	<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="css/formatacaoestudo.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

	<style>

	/* Style for our header texts
	* --------------------------------------- */
	h1{
		font-size: 5em;
		font-family: arial,helvetica;
		color: #fff;
		margin:0;
	}
	.intro p{
		color: #fff;
	}

	/* Centered texts in each section
	* --------------------------------------- */
	.section{
		text-align:center;
	}

	/* Bottom menu
	* --------------------------------------- */
	#infoMenu li a {
		color: #fff;
	}
	</style>

	<!--[if IE]>
		<script type="text/javascript">
			 var console = { log: function() {} };
		</script>
	<![endif]-->

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>

	<script type="text/javascript" src="js/scrolloverflow.js"></script>

	<script type="text/javascript" src="js/jquery.fullPage.js"></script>
	<script type="text/javascript" src="js/examples.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				anchors: ['1page', '2page', '3page', '4page', '5page', '6page', '7page', '8page', '9page', '10page', '11page', '12page', '13page', '14page', '15page', '16page', '17page', '18page', '19page', '20page'],
				sectionsColor: ['#0E7AE8', '#02C39A', 
				'#FFA54B', '#EB5E86', '#43CCFE', '#763D6A',
				'#A68F72', '#9A635D','#3E5867', '#5DA8DD',
				'#1F62A6', '#E74F61','#0E7AE8', '#02C39A', 
				'#FFA54B', '#EB5E86', '#43CCFE', '#763D6A',
				'#A68F72', '#9A635D'
				],
				responsiveHeight: 600,
				afterResponsive: function(isResponsive){
				
				}
			});
		});
	</script>

</head>
<body>


<div id="fullpage">
<?php
	session_start();	

	include "conecta.php";

	if (!isset($_SESSION["logou"]))
	{
		header("Location: login.php");
	}

	$email=$_SESSION['usuario'];

	function textohtml2($texto,$idslides){
		if($idslides==1)
			$texto2=str_replace("###","</p><p class='firsttext'>" ,$texto);
		else
			$texto2=str_replace("###","</p><p class='text'>" ,$texto);

		return $texto2;
	}

	
	$idsubunidade = $_POST['idsubunidade'];
	//$idsubunidade=2;
	$i = 5;

	$sql="SELECT id_conteudo, texto, id_slide, imagem, titulo, layout  FROM conteudo WHERE id_subunidade=$idsubunidade and excluido = 'n' ORDER BY id_slide ASC";
	//echo $sql."sub".$subunidadefinal;

	$resultado= pg_query($conecta, $sql);
	$total=pg_num_rows($resultado);
	
	if($total>0){
		while($linha = pg_fetch_array($resultado)){
			$idconteudo=$linha['id_conteudo'];
			$texto=$linha['texto'];
			$idslide=$linha['id_slide'];
			$texto=textohtml2($texto,$idslide);
			$idslide++;
			$imagem=$linha['imagem'];

			$size = getimagesize($imagem);

			$tamanhoimg=strlen($imagem);

				if($imagem!=null){
					//$imagem = sub_str($imagem1, 3);
					$imagem = substr($imagem, 3, $tamanhoimg);
				}

			$titulo=$linha['titulo'];
			$layout=$linha['layout'];
			$idslideres=$idslide--;
			
			if($layout==1){
				?>
			<div class="section ">
				<div class="intro" <?php if($idslide==1) echo 'id="first"'?>>
					<h1 class="titulo"><?php echo $titulo;?></h1>
					<p <?php if($idslide==1) {echo 'class="firsttext"';} else {echo 'class="text"';}?>><?php echo $texto;?></p>
					<center><img src="<?php echo $imagem;?>" class="img-responsive imagem"></center>
				</div>
			</div>
	<?php
			}
			else if($layout==2){
				?>
			<div class="section">
				<div class="intro" <?php if($idslide==1) echo 'id="first"'?>>
					<h1 class="titulo"><?php echo $titulo;?></h1>
					<?php if ($imagem!=null){?>
					<div class="col col-md-8 col-xs-8">
					<p <?php if($idslide==1) {echo 'class="firsttext"';} else {echo 'class="text"';}?> ><?php echo $texto;?></p>
					</div>
					<div class="col col-md-4  col-xs-4" >
					<center><img src="<?php echo $imagem;?>" class="img-responsive imagem2"></center>
					</div>
					<?php
					}
					else{ 
					?>
					<div class="col col-md-12 col-xs-12">
					<p <?php if($idslide==1) {echo 'class="firsttext"';} else {echo 'class="text"';}?> ><?php echo $texto;?></p>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		<?php	
			}
			else if($layout==3){
			?>
			<div class="section">
				<div class="intro" <?php if($idslide==1) echo 'id="first"'?>>
					<h1 class="titulo"><?php echo $titulo;?></h1>
					<?php if ($imagem!=null){?>
					<div class="col col-md-4 col-xs-4 ">
					<center><img src="<?php echo $imagem;?>" class="img-responsive imagem2"></center>
					</div>

					<div class="col col-md-8  col-xs-8 ">
					<p <?php if($idslide==1) {echo 'class="firsttext"';} else {echo 'class="text"';}?> ><?php echo $texto;?></p>
					</div>

					<?php
					}
					else{ 
					?>
					<div class="col col-md-12 col-xs-12">
					<p <?php if($idslide==1) {echo 'class="firsttext"';} else {echo 'class="text"';}?> ><?php echo $texto;?></p>
					</div>
					<?php
					}
					?>

				</div>
			</div>

			<?php
			}
			else if($layout==4){
			?>

			<div class="section ">
				<div class="intro" <?php if($idslide==1) echo 'id="first"'?>>
					<h1 class="titulo"><?php echo $titulo;?></h1>
					<p <?php if($idslide==1) {echo 'class="firsttext"';} else {echo 'class="text"';}?>><?php echo $texto;?></p>
					<center><img src="<?php echo $imagem;?>" class="img-responsive imagem"></center>
				</div>
			</div>

			<?php
			}
?>


	
<?php
	}
?>
<!-- div final-->
<div class="section">
	<?php 

	$sqlsub="SELECT subunidade FROM subunidade WHERE id_subunidade=$idsubunidade and excluido = 'n'";
	//echo $sql."sub".$subunidadefinal;

	$resultadosub= pg_query($conecta, $sqlsub);
	$totalsub=pg_num_rows($resultadosub);
	$linhasub = pg_fetch_array($resultadosub);

	if($totalsub>0){
		$subunidade=$linhasub['subunidade'];
		$idsubunidadeprox=$idsubunidade++;
	}
	$idsubunidadeprox=$idsubunidade++;

	?>
		<h1 style="text-align:center;margin-bottom:20px;" class="titulo">Você concluiu <?php echo $subunidade;?>!</h1>
		<div class="col-md-12 col-xs-12 sctfinal">
		<center>
			<div class="col-md-4 col-xs-4" style="display:inline-block;cursor:pointer">
			<form action="paginaestudo.php" method="post" id="formprosseguir">
			<input type="hidden" name="idsubunidade" value="<?php echo $idsubunidadeprox;?>">
			<?php
				$variavel="document.getElementById('formprosseguir').submit();";
			?>
			</form>
			<a onClick="<?php echo $variavel;?>"><img src="img/estudo/11092017120014323050.png" width="200" style="border-radius:300px;" alt="prosseguir"></a>
				
			<p style="text-align:center;">Prosseguir com os estudos</p>
			</div>

			<div class="col-md-4  col-xs-4" style="display:inline-block;cursor:pointer">
			<form action="questoes.php" method="post" id="formquestoes">
			<?php $idsubunidade=$idsubunidade-2;?>
			<input type="hidden" name="subunidade" value="<?php echo $idsubunidade;?>">
			<?php
				$variavel="document.getElementById('formquestoes').submit();";
			?>
			</form>
				<center><a onClick="<?php echo $variavel;?>"><img src="img/estudo/11092017120014323054.png" width="200" style="border-radius:300px;" alt="prosseguir"></a></center>
				<p style="text-align:center;">Exercitar o conhecimento</p>
			</div>

			<div class="col-md-4  col-xs-4" style="display:inline-block;cursor:pointer">
			<form action="pdfconteudo.php" method="post" id="formpdf">
			<input type="hidden" name="idsubunidadepdf" value="<?php echo $idsubunidade;?>">
			<?php
				$variavel="document.getElementById('formpdf').submit();";
			?>
			</form>
				<center><a onClick="<?php echo $variavel;?>"><img src="img/estudo/11092017120014323053.png" width="200" style="border-radius:300px;" alt="prosseguir"></a></center>
				<p style="text-align:center;">Baixar PDF da aula</p>
			</div>
			<?php
				//insert tabela cronograma se já não tiver 
				
				$sqlsubunidade="SELECT id_subunidade FROM cronograma WHERE email='$email' and id_subunidade=$idsubunidade";

				$resultadosubunidade= pg_query($conecta, $sqlsubunidade);
				$totalsubunidade=pg_num_rows($resultadosubunidade);
				
				if($totalsubunidade<=0){
					$sqlcronograma="insert into cronograma(email,id_subunidade) values('$email',$idsubunidade)";
					$resultadocronograma=pg_query($conecta,$sqlcronograma);
					$linhascronograma=pg_affected_rows($resultadocronograma);
				}
				
			?>
			</center>
  <div class="col-md-12 " style="margin-top:50px;">
				<a href="paggeralcont.php"><img src="img/logos/softbio.png" width="160" alt="prosseguir"></a>
		<br><br>

	   </div>

</div>

		</div>

<?php
}

?>
</div>


</body>
</html>