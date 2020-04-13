<?php
session_start();
$_SESSION['pagina']='genotypes';
include 'header.php';

require_once 'db.class.php';

$sql= "SELECT identification,category,id_locus,alelo FROM individual
INNER JOIN genotype ON individual.identification=genotype.id_individual
INNER JOIN category ON individual.id_category=category.id";
#ORDER BY CAST(identification AS int) ASC

$header = ['identification','category','id_locus','alelo'];
forms($header);
?>

<!-- Pagination-->
<?php pagination($sql,$header); ?>


<!--Container-->
<div class="container">
  
  <!--Table Responsive-->
  <div class="table-responsive-lg">

    <?php table_head($header); ?>
    <?php table_body($sql,$header); ?>    
  </div>
  <!--Table Responsive-->
</div>
<!--Container-->


<!-- Pagination-->
<?php pagination($sql,$header); ?>

<?php include 'footer.php'; ?>