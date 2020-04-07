<?php
session_start();
$_SESSION['pagina']='studbook';
include 'header.php';

require_once 'db.class.php';

$sql= "SELECT identification, individual.name as name, sex, events, date, institute.name as institute, local_id FROM `individual`
                  INNER JOIN historic ON individual.identification=historic.id_individual 
                  INNER JOIN events ON historic.id_event=events.id
                  INNER JOIN institute ON historic.id_institute=institute.id
                  WHERE id_category!=2 and (events.events='Birth' OR events.events='Capture')
                  ";
#ORDER BY CAST(identification AS int) ASC

$header = ['identification','name','sex','events','date','institute','local_id'];

?>




<form action="studbook.php" method="get" target="_self" class="form-inline bg-secondary p-3">

  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">Items per page</div>
    </div>
    <select name="limit" class="custom-select">
      <?php for ($i=20; $i <= 100; $i+=20):?>
        <option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php endfor; ?>
        <option <?php echo isset($_GET['limit']) && $_GET["limit"]=="all" ? "selected":""; ?> value="all">All</option>
      </select>
  </div>

  <button type="submit" class="btn btn-warning ml-auto mr-2">Filter</button>
</form>


<!-- Pagination-->
<?php pagination($sql,$header); ?>


<!--Container-->
<div class="container">
  
  <!--Table Responsive-->
  <div class="table-responsive-lg">

    <!--Table-->
    <table class="table table-hover ">
     
      <?php table_head($sql,$header); ?>    
        
    </table>
    <!--Table-->
  </div>
  <!--Table Responsive-->
</div>
<!--Container-->


<!-- Pagination-->
<?php pagination($sql,$header); ?>

<?php include 'footer.php'; ?>