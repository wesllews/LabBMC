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
			<a class="col btn bg-light p-3 shadow" style="transition:0.5s;">
				<h4>Persmissions of Users</h4>
			</a>
		</div>
		<!---->		
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light p-3 shadow" style="transition:0.5s;">
				<h4>Rehgistered Populations</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light p-3 shadow" style="transition:0.5s;">
				<h4>Captivity</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light p-3 shadow" style="transition:0.5s;">
				<h4>Wild</h4>
			</a>
		</div>
		<!---->
		<div class="col-lg-4 p-4">
			<a class="col btn bg-light p-3 shadow" style="transition:0.5s;">
				<h4>Genetics</h4>
			</a>
		</div>
		<!---->
	</div>
</div>
<?php include 'footer.php'; ?>