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


<!-- NavBar-Filter -->
<nav class="navbar navbar-expand-lg text-white bg-warning px-5 py-1 ">
  <ul class="navbar-nav">
    <li class="nav-item">
      <i class="fas fa-filter"></i> <b>Filter</b>
    </li>
  </ul>
</nav>



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