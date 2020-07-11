<?php 
session_start();
include "connection.php";
/*
// Creates a new csv file and store it in tmp directory
$nome = "BLT_database_dowlnoad.csv";
$arquivo = getcwd().'/'.$nome;
$new_csv = fopen($arquivo, 'w');

// Load the data from database
$sql = $_POST['limitado'];
$result = $mysqli->query($sql);

$finfo = $result->fetch_fields();
$header = array();

//Write de Header of DATABASE columns
foreach ($finfo as $val) {
	array_push($header, $val->name);
}
fputcsv($new_csv,$header,$delimiter=",", $enclosure = '"', $escape_char="\n");

while($row = $result->fetch_array()){
	fputcsv($new_csv,$row,$delimiter=",", $enclosure = '"', $escape_char="\n");
}
fclose($new_csv);


// output headers so that the file is downloaded rather than displayed
  header("Content-type: text/csv");
  header("Content-disposition: attachment; filename =".$nome);
  readfile($arquivo);
  */
 
echo $limit = $_POST['limit'];
echo $sex = $_POST['sex'];
echo $status = $_POST['status'];
echo $population = $_POST['population'];
$header = unserialize($_POST['header']);
foreach ($header as $value){
	echo "<br>";
	echo $value;

}

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');


?>