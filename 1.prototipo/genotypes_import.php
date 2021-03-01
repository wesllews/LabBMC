<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
require_once 'vendor/autoload.php';
 

  $inputFileName = $_FILES['file']['tmp_name'];

  // Identify the type of $inputFileName
  $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

  // Create a new Reader of the type that has been identified
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

  //Load $inputFileName to a Spreadsheet Object
  $spreadsheet = $reader->load($inputFileName);

  // Identifica todos os Locus cadastrados
  $arrayLocus=[];
  $sql_locus = "SELECT * FROM locus";
  $query = $mysqli->query($sql_locus);
  while ($row = $query->fetch_array()) {
      array_push($arrayLocus, strtolower($row["locus"]));
  }

// INSERT
if ($_POST['action'] == "insert") {
  $dataArray = $spreadsheet->getActiveSheet()->toArray();
  foreach ($dataArray as $numRow=> $row) {

    // Evita inserir a linha caso tenham algum erro
    $mysqli->autocommit(FALSE);
    $problem=FALSE;
    $flag=FALSE;
    $AuxRowEdit=0;
    $AuxRowInsert=0;

    foreach ($row as $numCol => $value) {
      
      // Olha se conteudo não é dado indesejado, com base no cabeçalho
      $coluna= trim(strtolower($dataArray[0][$numCol]));
      if ($numRow!=0 && $value!="" && in_array(strtolower($coluna),$arrayLocus)) {
        // Variáveis utilizadas no insert
        $identification=$dataArray[$numRow][0]; //Primeira coluna de cada linha
        $locus=strtolower($dataArray[0][$numCol]); //Primeira linha sempre, cabeçalho
        $allele=$value; // Valor da célula na linha($numRow) e coluna($numCom) da vez

        $sql="SELECT * FROM genotype 
        INNER JOIN individual ON genotype.id_individual = individual.id 
        INNER JOIN locus ON genotype.id_locus = locus.id 
        WHERE identification='$identification' AND locus ='$locus';";
        $result = $mysqli->query($sql);
        $num_rows = $result->num_rows;

        //Insert
        if($num_rows<2){

          $sql = "INSERT INTO `genotype` (`id`, `id_individual`, `id_locus`, `allele`, `restricted`) 
          VALUES (NULL, (SELECT id FROM individual WHERE identification='$identification'), (SELECT id FROM locus WHERE locus='$locus'), '$allele', 0);";
          $result = $mysqli->query($sql);

          // Testa se houve erro com o insert
          if($result==FALSE){
            $error =$mysqli->error;?>
            <div class=" container alert alert-danger" role="alert">
              Something went wrong on row number <b><?php echo $numRow;?></b> with locus: <b><?php echo $locus;?></b> and value: <b><?php echo $allele;?>.</b>
              <small>[<b>MySQL Error: </b><?php echo $error; ?>]</small>
            </div>
            <?php 
          } else{

            // Testa se o primeiro anúncio de dado inserido já foi feito
            if($AuxRowInsert!=$numRow){
              $flag=$locus;
              $AuxRowInsert=$numRow;
              ?>
                <div class=" container alert alert-success" role="alert">
                  Row <?php echo $numRow;?>: <b class="text-capitalize" id="insertedLocus<?php echo $numRow;?>"><?php echo $locus;?></b> was inserted.
                </div>
              <?php 
            } else{
              // Verifica se o locus já foi incluido no alerta de inserido
              if($flag!=$locus) {
                $flag=$locus;
                ?>
                <script type="text/javascript">
                  document.getElementById("insertedLocus<?php echo $numRow;?>").append(", <?php echo $locus?>");
                </script>
                <?php
              }
            }
          } // IF Insert

        } else{    
            if ($AuxRowEdit!=$numRow) {
              $flag=$locus;
              $AuxRowEdit=$numRow;
              ?>
                <div class=" container alert alert-warning" role="alert">
                  Row <?php echo $numRow;?>: Individual <b><?php echo $identification;?></b> already has two alleles informations on locus <b class="text-capitalize" id="editLocus<?php echo $numRow;?>"><?php echo $locus;?></b>. Use edit page to change this values.
                </div>
              <?php
            } else{

              // Verifica se é o primeiro aviso do locus
              if ($flag!=$locus) {
                $flag=$locus;
                ?>
                <script type="text/javascript">
                  document.getElementById("editLocus<?php echo $numRow;?>").append(", <?php echo $locus?>");
                </script>
                <?php
              }
            }
        }// Else- Num Rows
      }// if-Conteudo indesejado
    }// Foreach - Linha -> Coluna -> Valor

    $mysqli->commit();
  }// Row
}

// EDIT
if ($_POST['action']=="edit"){
  
  $dataArray = $spreadsheet->getActiveSheet()->toArray();
  foreach ($dataArray as $numRow=> $row) {

    // Evita inserir a linha caso tenham algum erro
    $mysqli->autocommit(FALSE);
    $problem=FALSE;
    $flag=FALSE;

    foreach ($row as $numCol => $value) {
      
      // Olha se conteudo não é dado indesejado, com base no cabeçalho
      $coluna= trim(strtolower($dataArray[0][$numCol]));
      if ($numRow!=0 && $value!="" && in_array(strtolower($coluna),$arrayLocus)) {
        // Variáveis utilizadas no insert
        $identification=$dataArray[$numRow][0]; //Primeira coluna de cada linha
        $locus=strtolower($dataArray[0][$numCol]); //Primeira linha sempre, cabeçalho

        $sql="SELECT *, genotype.id as id FROM genotype 
        INNER JOIN individual ON genotype.id_individual = individual.id 
        INNER JOIN locus ON genotype.id_locus = locus.id 
        WHERE identification='$identification' AND locus ='$locus';";
        $result = $mysqli->query($sql);
        $num_rows = $result->num_rows;

        if($num_rows==1){

          $row = $result->fetch_array();
          $allele = $dataArray[$numRow][$numCol];
          $id=$row['id'];

          // Verifica se é o primeiro aviso do locus
          if ($flag!=$locus) {
            $flag=$locus;

            $sql_update = "UPDATE `genotype` SET `allele` = '$allele' where id ='$id'; ";
            $result_update = $mysqli->query($sql_update);
            if($result_update==FALSE){
                $problem=TRUE;
              }
          } else{
            $sql = "INSERT INTO `genotype` (`id`, `id_individual`, `id_locus`, `allele`, `restricted`) 
            VALUES (NULL, (SELECT id FROM individual WHERE identification='$identification'), (SELECT id FROM locus WHERE locus='$locus'), '$allele', 0);";
            $result_insert = $mysqli->query($sql);
            if($result_update==FALSE){
                $problem=TRUE;
              }
          }
        }//num==1

        if($num_rows==2 && $flag!=$locus){
          $flag=$locus;
          $count=0;
          while ($row = $result->fetch_array()) {
            $allele = $dataArray[$numRow][$numCol+$count];
            $id=$row['id'];

            $sql_update = "UPDATE `genotype` SET `allele` = '$allele' where id ='$id'; ";
            $result_update = $mysqli->query($sql_update);
            if($result_update==FALSE){
                $problem=TRUE;
              }

            $count+=1;
          } 
        }//num==2

        if($num_rows>2 && $flag!=$locus){
          $flag=$locus;
          $count=0;
          while ($row = $result->fetch_array()) {
            $allele = $dataArray[$numRow][$numCol+$count];
            $id=$row['id'];

            if ($count<2) {
              $sql_update = "UPDATE `genotype` SET `allele` = '$allele' where id ='$id'; ";
              $result_update = $mysqli->query($sql_update);
              if($result_update==FALSE){
                $problem=TRUE;
              }
            } else{
              $sql_delete="DELETE FROM genotype WHERE id='$id';";
              $result_delete = $mysqli->query($sql_delete);
              if($result_delete==FALSE){
                $problem=TRUE;
              } 
            }

            $count+=1;
          }//While 
        }//num>2
      }// if-Conteudo indesejado

      // Testa se houve erro com o update
      if($problem==TRUE){
        $error =$mysqli->error;?>
        <div class=" container alert alert-danger" role="alert">
          Something went wrong on row number <b><?php echo $numRow;?></b> with locus: <b><?php echo $locus;?></b> and value: <b><?php echo $allele;?>.</b>
          <small>[<b>MySQL Error: </b><?php echo $error; ?>]</small>
        </div>
        <?php
      }
    }// Foreach - Linha -> Coluna -> Valor
    
    if($problem==FALSE && $numRow!=0){
      ?>
        <div class=" container alert alert-success alert-dismissible fade show" role="alert">
          Row <?php echo $numRow;?>: <b class="text-capitalize"><?php echo $identification; ?></b> values was edited. <small>[Repeated or wrong data may have been deleted]</small>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php 
    }
    $mysqli->commit();
  }// Row
}
?>
<?php include 'footer.php'; ?>