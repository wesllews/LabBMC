<?php 
session_start();
include 'connection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//array começa em zero, então é necessário setar a posição
$headerAux=unserialize($_POST['header']);
$header = [1 =>'identification',2=>'category',3=>'sex',4=>'population',5=>'alive'];
foreach ($headerAux as $key => $value) {
	if (!in_array($value,array('identification','category','sex','population','alive','manager'))) {
		array_push($header,$value); 
	}
}

// Imprime cabeçalho
foreach ($header as $key => $value) {
	$sheet->setCellValueByColumnAndRow($key,1, ucfirst($value));
}


// Recebe os ids dos indivíduos
$download_ids = unserialize($_POST['download_ids']);

// Inicia o print das informações a partir da linha 2 da tabela
$rowNum = 2;


foreach ($download_ids as $value) {
	$sql = "SELECT *, individual.id as id,
	CASE
	    WHEN alive = 1 THEN 'True'
	    WHEN alive = 0 THEN 'False'
	    ELSE 'Unknown'
		END AS alive,

	CASE
	    WHEN id_category = 1 THEN institute.abbreviation
	    WHEN id_category = 2 THEN fragment.fragment
		END AS population  
	FROM individual 
	INNER JOIN status ON status.id_individual=individual.id
	LEFT JOIN institute ON status.id_institute=institute.id
	LEFT JOIN category ON individual.id_category=category.id
	LEFT JOIN fragment ON status.id_fragment=fragment.id
	WHERE individual.id='$value';";
	$result = $mysqli->query($sql);

	if($result->num_rows > 0){
		$row = $result->fetch_array();
		foreach ($header as $key => $value) {
			switch ($value) {
				case 'identification':
				case 'category':
				case 'sex':
				case 'population':
				case 'alive':
					$sheet->setCellValueByColumnAndRow($key,$rowNum, $row[$value]);
					break;

				default:
					$sql_locus = "SELECT * FROM haplotype WHERE restricted ='0' AND id_individual='$row[id]' AND id_mitochondrial_locus=(SELECT id FROM mitochondrial_locus WHERE mitochondrial_locus='$value');";
			 		$result_locus = $mysqli->query($sql_locus);
			 		$row_locus = $result_locus->fetch_array();
			 		$sheet->setCellValueByColumnAndRow($key,$rowNum, $row_locus['haplotype']);
					break;
			}
		}
		$rowNum++;
	} else {
		$sheet->setCellValue("A".$rowNum, "Something went wrong!");
		$sheet->setCellValue("B".$rowNum, $mysqli->error);
	}
}

$filename = 'BLT database - '.$_POST['pagina'].'.xlsx';
// Redirect output to a client's web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
 
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');