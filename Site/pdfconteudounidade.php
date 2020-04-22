<?php

include 'conecta.php';
include 'substituir.php';


	$idunidade=$_POST["idunidadepdf"];
	$todas = '
	<div class="coisa">
			<img class="cabecalho" src="capas/fundo.png">
	</div>
	<div class="mae">';

	$sql="select * from unidade where id_unidade=".$idunidade;
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	$linha=pg_fetch_array($resultado);
	$titulo=$linha['unidade'];

	$todas.="<h1  class='tema'>Tema: ".$titulo."</h1>";


	$sql="select subunidade.id_subunidade, subunidade.subunidade, conteudo.texto,conteudo.imagem, 
	conteudo.titulo from subunidade INNER JOIN conteudo ON subunidade.id_subunidade=conteudo.id_subunidade
	and subunidade.id_unidade=".$idunidade." order by conteudo.id_slide asc";
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);


	 for ($cont=0; $cont < $qtde; $cont++)
 	{
	 $n=$cont;
	 $n++;

	$linha=pg_fetch_array($resultado);
	$tamanhoimg=strlen($linha[3]);
	$titulo=$linha[4];


	if($linha[3]!=null)
		{
			//$imagem = sub_str($imagem1, 3);
			$imagem = substr($linha[3], 3, $tamanhoimg);
		}
	$texto=$linha[2];
	//$texto=textohtml("conteudo","id_conteudo","texto",'3');
	$todas.="
	<div class='slide'>
		<div class='coisa'>
				<center><h2 class='titulo'>".$linha[4]."</h2></center>
			</div>
			<div class='conteudo' style='padding:5px;'>".$texto."</div>";
			if($imagem!=""){

				$todas.="<p><img src=".$imagem." width=300px;></p>";

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

$mpdf->Output($titulo.'.pdf');
exit;
//==============================================================
//==============================================================


?>