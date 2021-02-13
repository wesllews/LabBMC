<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
require_once 'vendor/autoload.php';
 
if (isset($_POST['action'])) {

  $inputFileName = $_FILES['file']['tmp_name'];

  // Identify the type of $inputFileName
  $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

  // Create a new Reader of the type that has been identified
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

  //Load $inputFileName to a Spreadsheet Object
  $spreadsheet = $reader->load($inputFileName);

  $dataArray = $spreadsheet->getActiveSheet()->toArray();
  foreach ($dataArray as $numRow=> $row) {

    // Evita inserir a linha caso tenham algum erro
    $mysqli->autocommit(FALSE);
    $problem=FALSE;

    foreach ($row as $numCol => $value) {
      
      // Olha se conteudo não é dado indesejado, com base no cabeçalho
      $coluna= trim(strtolower($dataArray[0][$numCol]));
      if ($numRow!=0 && $value!="" && !in_array($coluna,array('identification','category','sex','population','alive'))) {

        // Variáveis utilizadas no insert
        $identification=$dataArray[$numRow][0]; //Primeira coluna de cada linha
        $locus=strtolower($dataArray[0][$numCol]); //Primeira linha sempre, cabeçalho
        $allele=$value; // Valor da célula na linha($numRow) e coluna($numCom) da vez

        $sql="SELECT *, genotype.id as id FROM genotype 
        INNER JOIN individual ON genotype.id_individual = individual.id 
        INNER JOIN locus ON genotype.id_locus = locus.id 
        WHERE identification='$identification' AND locus ='$locus'";
        $result = $mysqli->query($sql);
        $num_rows = $result->num_rows;

        if($num_rows<2){
          $sql = "INSERT INTO `genotype` (`id`, `id_individual`, `id_locus`, `allele`, `restricted`) 
          VALUES (NULL, (SELECT id FROM individual WHERE identification='$identification'), (SELECT id FROM locus WHERE locus='$locus'), '$allele', 0);";
          $result = $mysqli->query($sql);
          if($result==FALSE){
            $problem=TRUE;
            $error =$mysqli->error;?>
            <div class=" container alert alert-danger" role="alert">
              <p><b>Entire row number <?php echo $numRow;?> wansn't inserted!</b></p>
              Something went wrong on locus: <b><?php echo $locus;?></b> and value:<b><?php echo $allele;?>. </b>
              <small>[<b>MySQL Error: </b><?php echo $error; ?>]</small>
            </div>
            <?php
          }
        } else{
            ?>
            <div class=" container alert alert-warning" role="alert">
              <p>Individual <b><?php echo $identification;?></b> on row <?php echo $numRow;?> already has two allele information on on locus: <b><?php echo $locus;?></b> Use Update page for change this values.</p>
            </div>
          <?php
        }// Else- Num Rows

      }// if-Conteudo indesejado
    }// Foreach - Linha -> Coluna -> Valor

    if ($problem==FALSE && $numRow!=0) {
      $mysqli->commit();?>
      <div class=" container alert alert-success alert-dismissible fade show" role="alert">
         Row <b><?php echo $numRow;?></b> with data of individual <b><?php echo $identification;?></b> inserted!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <?php
    }// if-Commit

  }// Row
}
?>
<?php include 'footer.php'; ?>