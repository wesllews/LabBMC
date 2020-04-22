<?php

include 'conecta.php';

function textohtml2($texto){
		$texto2=str_replace("###","</p><p style='text-align:justify;'>" ,$texto);
		return $texto2;
	}

	$idsubunidade=$_POST["idsubunidadepdf"];

	$todas = '
	<div class="coisa">
			<img class="cabecalho" src="capas/fundo.png">
	</div>
	<div class="mae">';
	
	$sql="select * From subunidade where id_subunidade=".$idsubunidade;
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	$linha=pg_fetch_array($resultado);
	$titulo=$linha['subunidade'];
	

	

	
	$todas.="<h1  class='tema'>Tema: ".$titulo."</h1>";
	$sql="select * from conteudo where id_subunidade=".$idsubunidade." order by id_slide ASC";
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	 for ($cont=0; $cont < $qtde; $cont++)
 {
	 $n=$cont;
	 $n++;

	$linha=pg_fetch_array($resultado);
	$tamanhoimg=strlen($linha['imagem']);

	if($linha['imagem']!=null)
		{
			//$imagem = sub_str($imagem1, 3);
			$imagem = substr($linha['imagem'], 3, $tamanhoimg);
		}
		$idconteudo=$linha['id_conteudo'];
	$texto=$linha['texto'];
	$texto=textohtml2($texto);
	$todas.="
	<div class='slide'>
		<div class='coisa'>
				<center><h2 class='titulo'>".$linha['titulo']."</h2></center>
			</div>
			<div class='conteudo' style='padding:10px;'>".$texto."</div>";
			if($imagem!=""){

				$todas.="<p class='image'><img src=".$imagem." width=300px;></p>";
				$imagem="";
			}

	$todas.="</div>";
 }
	$todas.="</div>";

//==============================================================
//==============================================================
//==============================================================
include("mpdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',0,0,0,0,0,0); 

$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage','two');

// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstylePaged.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($todas);

$mpdf->Output($titulo.'.pdf', 'D');

exit;
//==============================================================
//==============================================================


?>