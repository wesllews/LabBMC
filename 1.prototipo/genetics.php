<?php
session_start();
$_SESSION['pagina']='studbook';
include 'header.php';

// Select individual
$identification = $_GET['identification'];
$sql= "SELECT * FROM individual WHERE identification='$identification';";
$query = $mysqli->query($sql);
$row_individual = $query->fetch_array();
$id_individual = $row_individual['id'];
?>
<!-- ERROR 404 -->
<?php if(($query->num_rows)==0): ?>
	<?php include 'notfound.php';	exit(); ?>
<?php endif; ?>

<div class="container-fluid px-5 pt-5">
	<h1>Identification: <?php echo $row_individual['identification']; ?></h1>
	<div class="pt-1 bg-warning"></div>
</div>

<!-- Genetics -->
<?php $sql_genetics= "SELECT distinct(id_locus) as id_locus FROM genotype WHERE id_individual='$id_individual';";
$query_genetics = $mysqli->query($sql_genetics);
$num_rows =$query_genetics->num_rows;?>
<?php if($num_rows>0): ?>
	<div class="container mb-5">

		<h5 class="text-secondary mb-2 mt-4"> Genotypes and Alleles</h5>

		<div class="mt-3 grid-genetics">
			<?php while($row_locus = $query_genetics->fetch_array()):
				$sql_allele= "SELECT * FROM genotype INNER JOIN locus ON locus.id=genotype.id_locus WHERE id_individual='$id_individual' AND id_locus='$row_locus[id_locus]';";
				$query_allele = $mysqli->query($sql_allele);
				$num_rows =$query_allele->num_rows;

				if($num_rows>=2):
					$row_allele = $query_allele->fetch_array();
					$flag=0?>

					<div class="m-3 border-bottom">
						<span class="float-left font-weight-bold"><?php echo $row_allele['locus']; ?></span>
						<span class="float-right text-secondary"><?php while ($flag<$query_allele->num_rows) { echo $row_allele['allele']." "; $flag+=1;} ?></span>			
					</div>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<?php include 'footer.php'; ?>