<?php 
session_start();
include 'connection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


// Variavel alfabética para utilizar nas colunas da tabela
$alphabet = range('A', 'Z');

// Imprime cabeçalho
$header = ['identification','category','sex','population','platform','link'];

foreach ($header as $key => $value) {
	$sheet->setCellValue($alphabet[$key].'1', ucfirst($value));
}

// Recebe os ids dos indivíduos
$download_ids = unserialize($_POST['download_ids']);

// Inicia o print das informações a partir da linha 2 da tabela
$rowNum = 2;

foreach ($download_ids as $value) {
	$sql = "SELECT * FROM (
	SELECT genomic.id_individual as id_individual, identification, category, sex, platform, link,
		CASE
		WHEN id_category = 1 THEN institute.abbreviation
		WHEN id_category = 2 THEN fragment.fragment
		END AS population 
	FROM genomic
	INNER JOIN individual ON individual.id=genomic.id_individual
	INNER JOIN status ON status.id_individual=genomic.id_individual
	INNER JOIN category ON individual.id_category=category.id
	LEFT JOIN institute ON status.id_institute=institute.id
	LEFT JOIN fragment ON status.id_fragment=fragment.id) genomic2
	WHERE id_individual='$value';";
	$result = $mysqli->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){

			foreach ($header as $key => $value) {
				$sheet->setCellValue($alphabet[$key].$rowNum, $row[$value]);
			}
			$rowNum++;
		}
	} else {
		$error = $mysqli->error;
		$sheet->setCellValue("A".$rowNum, "Something went wrong!");
		$sheet->setCellValue("B".$rowNum, "MySQL error: ".$error);
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