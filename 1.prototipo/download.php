<?php 
session_start();
include 'connection.php';

$header = unserialize($_POST['header']);
if (!isset($_REQUEST['condicao'])) {
	$sql = $_REQUEST['sql'].$_REQUEST['limit'];
}
$query = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Download</title>
	<head>
	<body>

	<!-- Captivity -->
	<?php if ($_REQUEST['page']=='captivity'):?>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'captivity.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table>';
		
		//<!-- Table Head -->
		$html.='<tr>';
			foreach ($header as $value):
				switch($value):
					case 'informations': break;

					default:
					$html.='<th>'.ucfirst($value).'</th>';
				endswitch;
			endforeach;
		$html.='</tr>';

		//<!--Body Table -->
		while($row = $query->fetch_array()):
	    	$html.='<tr>';
	    		foreach ($header as $value):
	    			switch($value):

	    				case 'identification':
		    				$html.='<td scope="row">'.$row[$value].'</td>';
	    				break;

	    				case "historic":
	    					$sql_historic = "SELECT *, institute.name as institute FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$row[id]'";
	    					$result_historic = $mysqli->query($sql_historic);
	    					$num = $result_historic->num_rows;
	    					if ($num>=1):
	    						$html.='<td scope="row">';
	    							while ($row_historic = $result_historic->fetch_array()):
	    								//$html.='<li>';
	    									$html.= $row_historic['events']." on ";
	    									$html.= $row_historic['date'];
	    									$html.=' at the '.$row_historic['institute'].'.';
	    									$html.= $row_historic['observation'];
	    								$html.='<br>';
	    							endwhile;	
    							$html.='</td>';	    						
	    					else:
	    						$html.='<td scope="row">-</td>';
	    					endif;
	    				break;

	    				case 'population':					
	    					$sql_population = "SELECT * FROM institute WHERE id = '$row[id_institute]';";
	    					$result_population = $mysqli->query($sql_population);

	    					if ($result_population->num_rows > 0): 
	    						$row_population = $result_population->fetch_array();
	    						$html.='<td scope="row">'.$row_population['abbreviation'].'</td>';
	    					else:
	    						$html.='<td scope="row">-</td>';
	    					endif;
	    				break;

	    				case "sire":
	    				case "dam": 
	    					$sql_kinship = "SELECT * FROM `individual` WHERE id='$row[$value]'";
		    				$result_kinship = $mysqli->query($sql_kinship);
		    				$row_kinship = $result_kinship->fetch_array();
		    				
		    				$html.='<td scope="row">'.$row_kinship['identification'].'</td>';
	    				break;

	    				case 'alive':

							switch($row[$value]):
								case '1':
									$html.='<td scope="row">True</td>';
								break;

								case '0':
									$html.='<td scope="row">False</td>';
								break;

								default: 	
									$html.='<td scope="row">Unknown</td>';
								break;
							endswitch;
	    				break;

	    				case 'informations':
	    				break;

	    				default:
	    					$html.='<td scope="row">'.$row[$value].'</td>';
	    			endswitch;
	    		endforeach;
	    	$html.='</tr>';
		endwhile;

		$html .= '</table>';
	
	endif;

	// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>