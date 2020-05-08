<?php 
session_start();
$_SESSION['pagina']='captivity';
include 'header.php';

$sql = "SELECT DISTINCT(id_institute) FROM status WHERE alive=1";
$result_filter = $mysqli->query($sql);
?>

<?php while($row = $result_filter->fetch_array()):

	// Seleciona todos os dados dos indivíduos
	$sql = "SELECT * FROM institute WHERE id='$row[id_institute]'";
	$result = $mysqli->query($sql); ?>
	<div class="container">
		<?php while($row_institute = $result->fetch_array()): ?>
			<form action="captivity.php" method="get" id="<?php echo $row_institute['id'];?>">
				<input type="hidden" name="filterpopulation" value="<?php echo $row_institute['id'];?>">
				<input type="hidden" name="fulldata" value="n">
			</form>
				<div class="d-flex btn-light flex-column p-4 mb-2 mt-4" style="cursor:pointer;" onclick="document.getElementById('<?php echo $row_institute['id'];?>').submit();">
					<h2 class="float-left"><span class="badge badge-warning"><?php echo $row_institute['abbreviation'];?></span></h2>
					<h2 class="text-center"><?php echo $row_institute['name'];?></h2>
					<h5 class="text-right"> <?php echo $row_institute['country'];?></h5>
					<div class="bg-warning pt-1"></div>
				</div>
			
		<?php endwhile; ?>
	</div>
<?php endwhile; ?>


<?php include 'footer.php'; ?>