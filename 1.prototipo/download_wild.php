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
$header = ['identification','name','sex','fragment','group','longitude','latitude','longitude_ind','latitude_ind'];

foreach ($header as $key => $value) {
	$sheet->setCellValue($alphabet[$key].'1', ucfirst($value));
}

// Recebe os ids dos indivíduos
$download_ids = unserialize($_POST['download_ids']);

// Inicia o print das informações a partir da linha 2 da tabela
$rowNum = 2;


foreach ($download_ids as $value) {
	$sql = "SELECT *,individual.id as id
	FROM `individual` 
	INNER JOIN status ON individual.id=status.id_individual 
	INNER JOIN fragment ON status.id_fragment=fragment.id
	LEFT JOIN ind_group ON individual.id=ind_group.id_individual
	LEFT JOIN `group` ON `group`.id=ind_group.id_group
	WHERE individual.id='$value';";
	$result = $mysqli->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){

			foreach ($header as $key => $value) {
				$sheet->setCellValue($alphabet[$key].$rowNum, $row[$value]);
			}
			$rowNum++;
		}
	} else {
		$sheet->setCellValue("A".$rowNum, "Something went wrong!");
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