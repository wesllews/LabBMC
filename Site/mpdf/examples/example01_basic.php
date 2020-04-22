<?php
include("conecta.php");

include("mpdf/mpdf.php");


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

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>