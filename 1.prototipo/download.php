<?php 
session_start();
include 'connection.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();

$pagina = $_POST['pagina'];
$limit = $_POST['limit'];
$sex = $_POST['sex'];
$status = $_POST['status'];
$population = $_POST['population'];
$header = unserialize($_POST['header']);

$headerTable=array();
$columnSQL = '';
foreach ($header as $value){
		switch($value){

			case 'identification':
				array_push($headerTable, $value);
				$columnSQL.='identification';
			break; 

			case 'historic':
				array_push($headerTable, 'events','date','institute','local_id');
				$columnSQL.=', events, date, local_id, historic.id_institute, (SELECT name FROM institute WHERE historic.id_institute=institute.id) as institute';
			break;

			case 'population':
				array_push($headerTable, $value);
				$columnSQL.=', status.id_institute, (SELECT name FROM institute WHERE status.id_institute=institute.id) as population';
			break;

			case 'sex':
				array_push($headerTable, $value);
				$columnSQL.=', sex';
			break;

			case 'sire':
				array_push($headerTable, $value);
				$columnSQL.=', kinship.sire as sire_id, (SELECT identification FROM individual WHERE kinship.sire=individual.id) as sire';
			break;

			case 'dam':
				array_push($headerTable, $value);
				$columnSQL.=', kinship.dam as dam_id, (SELECT identification FROM individual WHERE kinship.dam=individual.id) as dam';
			break;

			case 'name':
				array_push($headerTable, $value);
				$columnSQL.=', name';
			break;

			case 'alive':
				array_push($headerTable, $value);
				$columnSQL.=', alive';
			break;
		}
	}

if ($pagina=='captivity'){
	$sql = 'SELECT '.$columnSQL.' 
		FROM `individual`

		LEFT JOIN status ON individual.id=status.id_individual 
		LEFT JOIN kinship ON kinship.id_individual=individual.id 
		LEFT JOIN historic ON historic.id_individual=individual.id 
		LEFT JOIN events ON historic.id_event=events.id

		WHERE id_category=1';
}

$sql.=$limit;

$result = $mysqli->query($sql);
$arrayData=array();
while($row = $result->fetch_array()){

	$data=array();
	foreach ($headerTable as $value) {
		array_push($data,$row[$value]);
	}

	array_push($arrayData,$data);
}

$spreadsheet->getActiveSheet()
    ->fromArray(
        $headerTable,  // The data to set
        NULL,        // Array values with this value will not be set
        'A1'         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );

$spreadsheet->getActiveSheet()
    ->fromArray(
        $arrayData,  // The data to set
        NULL,        // Array values with this value will not be set
        'A2'         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );

// Definindo nomes
$nome = 'BLT_database.xlsx';
$arquivo = getcwd().'/'.$nome;

// Criando o arquivo
$writer = new Xlsx($spreadsheet);
$writer->save($nome);

// output headers so that the file is downloaded rather than displayed
  header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); #https://stackoverflow.com/questions/10198524/php-xlsx-header
  header('Content-disposition: attachment; filename ='.$nome);
  readfile($arquivo);
