<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>

<div class="container text-center mt-3">
	<h4 class="text-warning font-weight-bold">Dashboard</h4>
	<hr>
</div>

<div class="container">
	<div class="row">

		<!---->
		<div class="col-lg-4 p-4">
			<?php 
				$query= "SELECT * FROM `login` WHERE status='requested';";
				$result = $mysqli->query($query);
				$num =$result->num_rows;
			?>
			<a class="col btn btn-light shadow-sm border-0 py-2" href="users.php">
				<h4>Users <span class="badge badge-dark"><?php echo $num; ?></span></h4>
			</a>
		</div>
		<!---->		
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light shadow-sm border-0 py-2" href="#">
				<h4>Populations</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light shadow-sm border-0 py-2" href="#">
				<h4>Captivity</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light shadow-sm border-0 py-2" href="#">
				<h4>Wild</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light shadow-sm border-0 py-2" href="#">
				<h4>Genetics</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light shadow-sm border-0 py-2" href="#">
				<h4>Locus</h4>
			</a>
		</div>
		<!---->
	</div>
</div>

<div class="fixed-bottom">
	<?php include 'footer.php'; ?>
</div>
