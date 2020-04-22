<?php

include("conecta.php");

include("../mpdf.php");


$html = '
<h1><a name="top"></a>Questões</h1>';
$sql="select * from questao";
$resultado= pg_query($conecta, $sql);
 $qtde=pg_num_rows($resultado);
for ($cont=0; $cont < $qtde; $cont++)
 {
	 $n=$cont;
	 $n++;
	 
	$linha=pg_fetch_array($resultado);
	$NomeSub= "Softbio-".$linha['unidade'];
	$html.="<b>".$n."</b>-".$linha['pergunta']."<br><br>A)".$linha['a']."<br>B)".$linha['b']."<br>C)".$linha['c']."<br>D)".$linha['d']."<br>E)".$linha['e']."<br><br><hr>";
	

 }



//==============================================================
//==============================================================
//==============================================================



$mpdf=new mPDF('c'); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->SetWatermarkText('DRAFT');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;

$mpdf->WriteHTML($html);
$mpdf->AddPage();

$mpdf->SetWatermarkImage('tiger.wmf', 1, '', array(160,10));
$mpdf->showWatermarkImage = true;

$mpdf->WriteHTML('<h2>Using a Watermark as a Header</h2>');
$mpdf->WriteHTML($html);
$mpdf->AddPage();

$mpdf->SetWatermarkImage('tiger.wmf', 0.15, 'F');

$mpdf->WriteHTML('<h2>Using a Watermark Image as Background</h2>');
$mpdf->WriteHTML($html);


$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>