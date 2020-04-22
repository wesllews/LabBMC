<?php

include 'conecta.php';
include 'substituir.php';

$todas = '<body>	
	<div class="cabecalho">
		<div class="logo">
		<img  src="./img/cabecalho_questao.png"  alt="Logo">
		</div>
		<div class="coisa">
		<center><h2></h2></center>
		</div>
	</div><br><br><br>';

	$idsubunidade=2;

	$sql="select * From subunidade where id_subunidade=".$idsubunidade;
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	$linha=pg_fetch_array($resultado);
	$titulo=$linha['subunidade'];

	
	$todas.="<br><br><h1><center>Tema: ".$titulo."<center></h1>";
	$sql="select * from conteudo where id_subunidade=".$idsubunidade;
$resultado= pg_query($conecta, $sql);
 $qtde=pg_num_rows($resultado);
	$NomeSub= "Softbio-".$linha['unidade'];
	 for ($cont=0; $cont < $qtde; $cont++)
 {
	 $n=$cont;
	 $n++;

	 
	$linha=pg_fetch_array($resultado);
	$tamanhoimg=strlen($linha['imagem']);

	if($linha['imagem']!=null){
				//$imagem = sub_str($imagem1, 3);
				$imagem = substr($linha['imagem'], 3, $tamanhoimg);
			}
		$texto=$linha['texto'];
//$texto=textohtml("conteudo","id_conteudo","texto",$idconteudo);

	$todas.="<div class='coisa'>
			<center><h2>".$linha['titulo']."</h2></center>
			</div>
			<div class='conteudo' style='text-align:justify'>".$texto."</div>";
			if($imagem!=""){

				$todas.="<center><img src=".$imagem." width=300px;></center>";

			}

 
 }

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

$mpdf->Output();
exit;
//==============================================================
//==============================================================


?>