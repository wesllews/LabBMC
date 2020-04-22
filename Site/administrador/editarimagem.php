<?php
session_start();
include "conexao.php";
clearstatcache();

	if($_SESSION['grava_nome_img_noticia'] == 's')
	{
        $nome_img_noticia = $_SESSION['nome_img_noticia'];
        $id_noticia = $_SESSION['id_noticia'];
		$sql="update noticia set imagem = '$nome_img_noticia' where id_noticia = $id_noticia";
		$resultado=pg_query($conecta,$sql);
	}
	unset($_SESSION['grava_nome_img_noticia']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $targ_w = $_POST['w'];
	$targ_h = $_POST['h'];
    $jpeg_quality = 90;
 
    $src = '../img/noticias/'.$_SESSION['nome_img_noticia'].'.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
 
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h
	,$_POST['w'],$_POST['h']);
 	imagejpeg($dst_r, '../img/noticias/' . basename($src));

 	header('Location: ./listanoticias.php');
    exit;
}
 
?>

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

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/apendices.css" rel="stylesheet">
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<script src="../js/ie-emulation-modes-warning.js"></script>
	<script src="../js/formulario.js"></script>

	<!-- PARA USAR O JCROP -->
	<link href="../css/jquery.Jcrop.css" rel="stylesheet" type="text/css" />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.Jcrop.min.js"></script>

<!--
	<script src="../bootstrap/jquery.js"></script>
-->
<script language="Javascript">

	$(function(){

		$('#cropbox').Jcrop({
			boxHeight: 346,
			aspectRatio: 1.5,
			onSelect: updateCoords
		});

	});

	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};

	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Selecione a região para recortar.');
		return false;
	};

</script>

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
	<center>
		<div id="outer">
			<div class="jcExample">
				<div class="article">
				
					        <h2>Edite a sua imagem</h2>
					  
					        <!-- Imagem que vamos inserir -->
					        <img src="../img/noticias/<?php echo $_SESSION['nome_img_noticia']; ?>.jpg" id="cropbox" />
					 
					        <!-- Formulário para realização do crop-->
					        <form action="editarimagem.php" method="post" onsubmit="return checkCoords(); tiraVerificacao()">
						            <input type="hidden" id="x" name="x" />
						            <input type="hidden" id="y" name="y" />
						            <input type="hidden" id="w" name="w" />
						            <input type="hidden" id="h" name="h" />
						<br><br>
						            <input type="submit" class="btn btn-primary btn-lg" value="Recortar Imagem" />
						<br><br>
					        </form>
				</div>
			</div>
		</div>
	</center>
	</div>
	<footer id="footer" class="footer">
	</footer>
 </body>

</html>