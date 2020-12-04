<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container text-center mt-3">
	<h4 class="text-warning font-weight-bold">Add Captivity Individuals</h4>
	<hr>
</div>

<div class="row">
	<!-------null------><div class="d-none d-lg-block col-lg-2 my-5 py-5"></div>
	<div class="col-xs-12 col-lg-8">
		<form>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Identification:</label>
				<div class="col-sm-10">
					<input type="text" name="identification" class="form-control" placeholder="e.g. 478, TE064, MAM-0001">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Category:</label>
				<div class="col-sm-10">
					<select name="category" class="form-control">
						<option selected disabled>Category</option>
						<option value="1">Captivity</option>
						<option value="2">Wild</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Sex:</label>
				<div class="col-sm-10">
					<select name="sex" class="form-control">
						<option selected disabled>Sex</option>
						<option value="Female">Female</option>
						<option value="Male">Male</option>
						<option value="Unknown">Unknown</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Name:</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" placeholder="e.g. ROXXANE">
				</div>
			</div>
		</form>
	</div>
	<!-------null------><div class="d-none d-lg-block col-lg-2 my-5 py-5"></div>
</div>
<?php include 'footer.php'; ?>