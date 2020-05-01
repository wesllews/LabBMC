<?php
session_start();
$_SESSION['pagina']='genotypes';
include 'header.php';
require_once 'db.class.php';

$sql= "SELECT DISTINCT(genotype.id_individual),identification,category,sex FROM genotype
INNER JOIN individual ON individual.identification=genotype.id_individual
INNER JOIN category ON individual.id_category=category.id WHERE 1";

$header = ['identification','category','sex'];

// Seleciona os Locus
$sql_locus = "SELECT DISTINCT(locus) FROM locus";
$query = $mysqli->query($sql_locus);
$locus = [];

// Salva todos eles em um array
while ($row = $query->fetch_array()) {
    array_push($locus, $row["locus"]);
}
// Testa se algum locus foi enviado
$flag = 0;
foreach ($locus as $value) {
	if(isset($_GET[$value])){
	$flag=1;
	}
}
// Se for, adiciona só os enviados
if ($flag ==1):
	foreach ($locus as $value) {
		if(isset($_GET[$value])){
			array_push($header, $value);
		}
	}
	else:
			foreach ($locus as $value) {
				array_push($header, $value);
			}
	endif;


$array = get_all($header);
forms($header);

$sex = $array['sex']!="" ? " AND sex='$array[sex]'":"";
$category = $array['category']!="" ? " AND category='$array[category]'":"";

$sql .= $category.$sex;

?>

<!-- Pagination-->
<?php pagination($sql,$header); ?>


<!--Container-->
<div class="container-fluid">

	<div class="row justify-content-center">

	    <div class="col-12">
	      <button class="btn btn-warning text-white px-4" data-toggle="collapse" data-target="#filtro">
	        <i class="fas fa-filter"></i>
	      </button>
	    </div>

	    <!--Col Form-->
	    <div class="col-md-2 float-left collapse bg-secondary text-white p-3" id="filtro">
	      <form action="genotypes.php" method="get" target="_self" >



		    <div class="form-group">
		    	<label>Items per page</label>

		        <select name="limit" class="form-control form-control-sm">
		            <?php for ($i=20; $i <= 200; $i+=20):?>
		              <option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
		            <?php endfor; ?>
		          </select>
		    </div>



			<div class="form-group">
		        <label>Sex</label>

		        <select name="sex" class="form-control form-control-sm">
				<option <?php echo !isset($_GET['sex']) ? "selected":"";?> value="" >Select...</option>
		          <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Female" ? "selected":""; ?> value="Female">Female</option>
		          <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Male" ? "selected":""; ?> value="Male">Male</option>
		          <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Unknown" ? "selected":""; ?> value="Unknown">Unknown</option>
		        </select>
	      	</div>


	      
		    <div class="form-group">
		        <label>Category</label>

		        <select name="category" class="form-control form-control-sm">
		        <option <?php echo !isset($_GET['category']) ? "selected":"";?> value="" >Select...</option>
		           <option <?php echo isset($_GET['category']) && $_GET["category"]=="1" ? "selected":""; ?> value="1">Captive</option>
		           <option <?php echo isset($_GET['category']) && $_GET["category"]=="2" ? "selected":""; ?> value="2">Wild</option>
		        </select>
		    </div>

	      <div class="form-group">
		        <label>Locus</label>

		        <div class="overflow-auto" style="max-height: 300px;">
		        	<?php foreach ($locus as $value):?>
		        		<div class="custom-control custom-checkbox">
					 		<input type="checkbox" class="custom-control-input" id="<?php echo $value;?>" name="<?php echo $value;?>" value="s"  <?php echo isset($_GET[$value]) ? "checked":""; ?>>
							<label class="custom-control-label" for="<?php echo $value;?>"><?php echo $value;?></label>
						</div>
		        	<?php endforeach;?>
		        </div>
		    </div>

	    <button type="submit" class="btn btn-warning">Submit</button>
    	<a class="btn btn-warning" href="genotypes.php" role="button">Clear All</a>
	      </form>
	    </div>

	     <!--Col Table-->
	    <div class="col-md-10 float-left">
	      	<!--Table Responsive-->
	  		<div class="table-responsive">
			    <?php table_head($header); ?>
			    <?php table_body_genotypes($sql,$header); ?>    
		 	</div>
	    </div>
	</div>
</div>
<!--Container-->


<!-- Pagination-->
<?php pagination($sql,$header); ?>

<?php include 'footer.php'; ?>