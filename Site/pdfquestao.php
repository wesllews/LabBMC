<?php

include 'conecta.php';
session_start();
function textohtml2($texto){
		$texto2=str_replace("###","" ,$texto);
		return $texto2;
	}
$sub=$_POST['subunidade'];

$todas = '<div class="coisa">
			<img class="cabecalho" src="capas/fundo.png">
		</div>
		<div class="mae">';

		$sql=$_SESSION['questao_sql'];
			$resultado= pg_query($conecta, $sql);

				$linha=pg_fetch_array($resultado);

	$titulo=$linha['subunidade'];

	
	$todas.="<h1  class='tema'>Tema: ".$titulo."</h1>";
	
	$sql=$_SESSION['questao_sql'];
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);

	
	for ($cont=0; $cont < $qtde; $cont++)
	{
		$n=$cont;
		$n++;
		 
		$linha=pg_fetch_array($resultado);
		$texto=textohtml2($linha['pergunta']);
				   
  $sql1='select imagem from questao where id_questao='.$linha['id_questao'];
	                $resultado1= pg_query($conecta, $sql1);
					$linha1=pg_fetch_array($resultado1);
	                $qtde1=pg_num_rows($resultado1);
	 	   if($linha1[0]!="")
		{
				$todas.="<div class='xx'>";

			$todas.="<p><b class='questão'>".$n."</b>-".$texto."</p>";

				//$imagem = sub_str($imagem1, 3);
				    $sql1='select * from questao where id_questao='.$linha['id_questao'];
	                $resultado1= pg_query($conecta, $sql1);
					$linha1=pg_fetch_array($resultado1);
	                $qtde1=pg_num_rows($resultado1);
					$todas.="<p class='image'><img src='./img/questao/".$linha1['imagem'].".jpg' alt='questão' width=300px></p>";
					$todas.="<p class='alternativa'>A) ".$linha['a']."</p>".
			"<p class='alternativa'>B) ".$linha['b']."</p>".
			"<p class='alternativa'>C) ".$linha['c']."</p>".
			"<p class='alternativa'>D) ".$linha['d']."</p>";
			
			if($linha['e'] !=""){
				$todas.="<p class='alternativa'>E) ".$linha['e']."</p>";
			}
				$todas.="</div>";

		}
		else{
							$todas.="<div class='xx'>";

				$todas.="<p><b class='questão'>".$n."</b>-".$texto."</p>";

			$todas.="<p class='alternativa'>A) ".$linha['a']."</p>".
			"<p class='alternativa'>B) ".$linha['b']."</p>".
			"<p class='alternativa'>C) ".$linha['c']."</p>".
			"<p class='alternativa'>D) ".$linha['d']."</p>";
			
			if($linha['e'] !=""){
				$todas.="<p class='alternativa'>E) ".$linha['e']."</p>";
			}
				$todas.="</div>";

		}	
		}
	
	$todas.="<div style='height:90%;'>
	<center><h2 class='tema'>GABARITO</h2></center>
	";
	$todas.='<center><table   width=50% height:100% align=center>';

	$sql=$_SESSION['questao_sql'];
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	$NomeSub;
	
  for ($cont=0; $cont < $qtde; $cont++)
 {
	 $n=$cont;
	 $n++;
	 		$linha=pg_fetch_array($resultado);
   
             
			 
                      if($cont % 2 == 0)
						 $todas.="<tr><td colspan='1'><b class='questão'>".$n."</b>-".$linha['resposta']."</td>";
					  else
						 $todas.= "<td colspan='1'><b class='questão'>".$n."</b>-".$linha['resposta']."</td></tr>";
					  

 }
 
$todas.="</table></center></div></body>";

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