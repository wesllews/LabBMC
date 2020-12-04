<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container text-center mt-3">
	<h4 class="text-warning font-weight-bold">Add Captivity Individuals</h4>
	<hr>
</div>
<div class="container">
	<div class="row">
		<!-- Informações sobre o indivíduo-->
		<div class="col-sm-3">
			<div class="form-group row">
				<label>Identification:</label>
				<input type="text" name="identification" class="form-control" placeholder="e.g. 478, TE064, MAM-0001">
			</div>
			<div class="form-group row">
				<label>Category:</label>
				<select name="category" class="form-control">
					<option selected disabled>Choose...</option>
					<option value="1">Captivity</option>
					<option value="2">Wild</option>
				</select>
			</div>
			<div class="form-group row">
				<label>Sex:</label>
				<select name="sex" class="form-control">
					<option selected disabled>Choose...</option>
					<option value="Female">Female</option>
					<option value="Male">Male</option>
					<option value="Unknown">Unknown</option>
				</select>
			</div>
			<div class="form-group row">
				<label>Name:</label>
				<input type="text" name="name" class="form-control" placeholder="e.g. ROXXANE">
			</div>
		</div>

		<!-- Form de histórico-->
		<div class="offset-sm-1 col-sm-8">
			<div class="form-group row">
				<label>Event:</label>
				<select name="sex" class="form-control">
					<option selected disabled>Choose...</option>
					<option value="Birth">Birth</option>
					<option value="Capture">Capture</option>
					<option value="Death">Death</option>
				</select>
			</div>
			<div class="form-group row">
				<label>Date:</label>
				<input type="date" name="date" class="form-control">
			</div>
			<div class="form-group row">
				<label>Institution:</label>
				<select name="institution" class="form-control">
					<option selected disabled>Choose...</option>
					<option value="1">Dureel</option>
					<option value="2">Zoo Bauru</option>
				</select>
			</div>
			<div class="form-group row">
				<label>ID local:</label>
				<input type="text" name="local_id" class="form-control" placeholder="Identifier at the specific institution">
			</div>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>