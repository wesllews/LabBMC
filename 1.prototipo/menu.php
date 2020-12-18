<?php 
session_start();
$page=$_GET["page"];
$_SESSION['pagina']=$page;
include 'header.php';

switch ($page):
	case 'captivity':
		$sql = "SELECT DISTINCT(id_institute), priority FROM status LEFT JOIN institute ON status.id_institute=institute.id WHERE alive=1 ORDER BY ISNULL(priority),priority";
		$result_filter = $mysqli->query($sql);
		?>

		<?php if(!isset($_GET['captivity'])): ?>
			<div class="container text-center mt-5 p-5">
				<h1 class="text-warning font-weight-bold">Captivity</h1>
				<h5 class="text-justify">Take a look at the captivity section to search information about the life history of captive populations and studbook data.</h5>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-lg-6 px-4 pb-5">
						<form method="get" action="" id="pop">
							<input type="hidden" name="page" value="captivity">
							<input type="hidden" name="captivity" value="s">
						</form>
						<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="pop">
							<h2><i class="fas fa-globe-americas"></i></h2>
							<h2>Populations</h2>
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

		<?php else: ?>
			<div class="text-warning m-4" style="white-space: nowrap;">
				<h1 class="ml-5">Captivity Populations</h1>
				<hr>
			</div>

			<div class="mt-3 grid-captivity">
			<?php while($row = $result_filter->fetch_array()):
				$sql = "SELECT * FROM institute WHERE id='$row[id_institute]'";
				$result = $mysqli->query($sql);
				$row_institute = $result->fetch_array(); ?>
					<form action="captivity.php" method="get" id="institute<?php echo $row_institute['id'];?>" style="display:none;">
						<input type="hidden" name="filterpopulation" value="<?php echo $row_institute['id'];?>">
						<input type="hidden" name="fulldata" value="n">
					</form>
					<button type="submit" form="institute<?php echo $row_institute['id'];?>" class="btn btn-light rounded-0 shadow-sm m-3">
						<h5 class="justify-content-left"><span class="badge badge-warning"><?php echo $row_institute['abbreviation'];?></span></h5>		
						<h3 class="text-center"><?php echo $row_institute['name'];?></h3>
						<h6><div class="text-right"><?php echo $row_institute['country'];?></div></h6>
						
					</button>

			<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php break;?>

	<?php case 'wild':
		$sql = "SELECT DISTINCT(id_fragment) as id_fragment FROM fragment INNER JOIN `status` ON `status`.id_fragment=fragment.id ORDER BY fragment";
		$result_filter = $mysqli->query($sql);
		?>

		<?php if(!isset($_GET['wild'])): ?>
			<div class="container text-center mt-5 p-5">
				<h1 class="text-warning font-weight-bold">Wild</h1>
				<h5 class="text-justify">Take a look at the wild section to search information about the life history of wild populations, fragments and groups data.</h5>

			</div>

			<div class="container">
				<div class="row">
					<div class="col-lg-6 px-4 pb-5">
						<form method="get" action="" id="pop">
							<input type="hidden" name="page" value="wild">
							<input type="hidden" name="wild" value="s">
						</form>
						<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="pop">
							<h2><i class="fas fa-globe-americas"></i></h2>
							<h2>Populations</h2>
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
				<h1 class="ml-5">Wild Populations</h1>
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
		<?php break;?>

	<?php case 'genetics': ?>
		<div class="container text-center mt-5 p-5">
			<h1 class="text-warning font-weight-bold">Genetics</h1>
			<h5 class="text-justify">This section shows alleles and genotypes for microsatellite loci, and haplotypes or FASTA sequences for mitochondrial data.</h5>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-6 px-4 pb-5">
					<a href="genotypes.php" class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;">
						<h2><i class="fas fa-globe-americas"></i></h2>
						<h2>Microsatellites</h2>
					</a>
				</div>
				
				<div class="col-lg-6 px-4 pb-5">
					<form action="" method="get" id="full">
						<input type="hidden" name="fulldata" value="s">
					</form>
					<button class="col btn btn-dark p-5 hover-shadow" style="transition:0.5s;" form="full">
						<h2><i class="fas fa-stream"></i></h2>
						<h2>Mitochondrial</h2>
					</button>
				</div>

				
			</div>
		</div>
		<?php break;?>

	
	<?php default: ?>
		<div class="row bg-light m-5 p-5" role="alert">
			<h1>
				<p class=" display-1 letra2 text-warning"> OOPS!</p>
				<p class="letra1">Page Not Found</p>
			</h1>
		</div>
		<!-- Exit-->
		<?php include 'footer.php';	exit(); ?>
		<?php break;?>

<?php endswitch; ?>
	


<?php include 'footer.php'; ?>