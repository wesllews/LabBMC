<?php
session_start();
$_SESSION['pagina']='genotypes';
include 'header.php';

require_once 'db.class.php';

$sql= "SELECT DISTINCT(identification),category,sex FROM individual 
INNER JOIN genotype ON individual.identification=genotype.id_individual 
INNER JOIN category ON individual.id_category=category.id";

$header = ['identification','category','sex'];
$sql_locus = "SELECT DISTINCT(locus) FROM locus";
$query = $mysqli->query($sql_locus);
while ($row = $query->fetch_array()) {
    array_push($header, $row["locus"]);
}


forms($header);
?>

<!-- Pagination-->
<?php pagination($sql,$header); ?>


<!--Container-->
<div class="container">
  
  <!--Table Responsive-->
  <div class="table-responsive">

    <?php table_head($header,"table-hover table-bordered"); ?>
    <?php table_body_genotypes($sql,$header); ?>    
  </div>
  <!--Table Responsive-->
</div>
<!--Container-->


<!-- Pagination-->
<?php pagination($sql,$header); ?>

<?php include 'footer.php'; ?>