<?php 
session_start();
$_SESSION['pagina']='captivity';
include 'header.php';

$sql = "SELECT DISTINCT(id_institute) FROM status WHERE alive=1";
$result_filter = $mysqli->query($sql);
?>

<?php if(isset($_GET['captivity'])): ?>

	<?php while($row = $result_filter->fetch_array()):
		$sql = "SELECT * FROM institute WHERE id='$row[id_institute]'";
		$result = $mysqli->query($sql); ?>
		<div class="container">
			<?php while($row_institute = $result->fetch_array()): ?>
				<form action="captivity.php" method="get" id="<?php echo $row_institute['id'];?>">
					<input type="hidden" name="filterpopulation" value="<?php echo $row_institute['id'];?>">
					<input type="hidden" name="fulldata" value="n">
				</form>
				<div class="d-flex bg-light border border-light flex-column p-4 mb-2 mt-4 hover-shadow" style="cursor:pointer;transition:0.5s;" onclick="document.getElementById('<?php echo $row_institute['id'];?>').submit();">
					<h2 class="float-left"><span class="badge badge-warning"><?php echo $row_institute['abbreviation'];?></span></h2>
					<h2 class="text-center"><?php echo $row_institute['name'];?></h2>
					<h5 class="text-right"> <?php echo $row_institute['country'];?></h5>
					<div class="bg-warning pt-1"></div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endwhile; ?>

<?php else: ?>
	<div class="container text-center mt-5 p-5">
		<h1 class="text-warning font-weight-bold">Captivity</h1>
		<h5 class="text-justify">Take a look into the captivity to search information about the life history of captive populations and studbook data.</h5>

	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-6 px-4 pb-5">
				<form method="get" action="" id="pop">
					<input type="hidden" name="captivity" value="s">
				</form>
				<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="pop">
					<h2><i class="fas fa-globe-americas"></i></h2>
					<h2>Current Populations</h2>
				</button>
			</div>
			
			<div class="col-lg-6 px-4 pb-5">
				<form action="captivity.php" method="get" id="full">
					<input type="hidden" name="fulldata" value="s">
				</form>
				<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="full">
					<h2><i class="fas fa-stream"></i></h2>
					<h2>Full Data</h2>
				</button>
			</div>

			
		</div>
	</div>
<?php endif; ?>


<?php include 'footer.php'; ?>