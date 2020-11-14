<?php 
session_start();
include 'connection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$header = ['identification','category','historic','population','sex','sire','dam','name','alive','informations'];
$header = ['identification','category','sex','events','institute','local_id','date','observation','name','sire','dam', 'alive'];
$alphabet = range('A', 'Z');

foreach ($header as $key => $value) {
	$sheet->setCellValue($alphabet[$key].'1', ucfirst($value));
}

$colunas = ", institute.name as institute, individual.name as name";
$sql = "select *".$colunas." from individual
INNER JOIN category ON category.id=individual.id_category
INNER JOIN historic ON individual.id=historic.id_individual
INNER JOIN institute ON institute.id=historic.id_institute
INNER JOIN kinship ON kinship.id_individual=individual.id
INNER JOIN status ON status.id_individual=individual.id
LEFT JOIN events ON events.id=historic.id_event WHERE id_category=1";
$result = $mysqli->query($sql.$_POST['sql_filter']);
if($result->num_rows > 0){
	$rowNum = 2;
	while($row = $result->fetch_assoc()){

		foreach ($header as $key => $value) {

			$sheet->setCellValue($alphabet[$key].$rowNum, $row[$value]);
		}
		$rowNum++;
	}
} else {
	$sheet->setCellValue("A2", $sql.$_POST['sql_filter']);
		}


$filename = 'database-'.time().'.xlsx';
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