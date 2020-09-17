<?php 
session_start();
$_SESSION['pagina']='wild';
include 'header.php';

$sql = "SELECT DISTINCT(id_fragment) as id_fragment FROM fragment INNER JOIN `status` ON `status`.id_fragment=fragment.id ORDER BY fragment";
$result_filter = $mysqli->query($sql);
?>

<?php if(!isset($_GET['wild'])): ?>
	<div class="container text-center mt-5 p-5">
		<h1 class="text-warning font-weight-bold">Wild</h1>
		<h5 class="text-justify">Take a look into the wild to search information about the life history of wild populations, fragments and groups data.</h5>

	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-6 px-4 pb-5">
				<form method="get" action="" id="pop">
					<input type="hidden" name="wild" value="s">
				</form>
				<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="pop">
					<h2><i class="fas fa-globe-americas"></i></h2>
					<h2>Current Populations</h2>
				</button>
			</div>
			
			<div class="col-lg-6 px-4 pb-5">
				<form action="wild.php" method="get" id="full">
					<input type="hidden" name="fulldata" value="s">
				</form>
				<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="full">
					<h2><i class="fas fa-stream"></i></h2>
					<h2>Full Data</h2>
				</button>
			</div>

			
		</div>
	</div>

<?php else: ?>
	<div class="text-warning m-4" style="white-space: nowrap;">
		<h1 class="ml-5">Current populations</h1>
		<hr>
	</div>

	<div class="mt-3 grid-captivity">
	<?php while($row = $result_filter->fetch_array()):
		$sql = "SELECT * FROM fragment WHERE id='$row[id_fragment]'";
		$result = $mysqli->query($sql);
		$row_fragment = $result->fetch_array(); ?>
			<form action="wild.php" method="get" id="fragment<?php echo $row_fragment['id'];?>" style="display:none;">
				<input type="hidden" name="filterpopulation" value="<?php echo $row_fragment['id'];?>">
				<input type="hidden" name="fulldata" value="n">
			</form>
			<button type="submit" form="fragment<?php echo $row_fragment['id'];?>" class="btn btn-light rounded-0 shadow-sm m-3">
				<h5 class="justify-content-left"><span class="badge badge-warning"><?php echo $row_fragment['abbreviation'];?></span></h5>		
				<h3 class="text-center"><?php echo $row_fragment['fragment'];?></h3>
				<h6><div class="text-right"><?php echo $row_fragment['country'];?></div></h6>
				
			</button>

	<?php endwhile; ?>
	</div>
<?php endif; ?>


<?php include 'footer.php'; ?>