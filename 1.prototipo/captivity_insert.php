<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Captivity Individuals</h4>
</div>
<?php if(!isset($_GET['identification'])):?>
	<form method="GET" class="container mb-4">
		
		<!-- Informações sobre o indivíduo-->
			<div class="font-weight-bold">Individual<hr class="mt-0 mb-2"></div>
			<div class="row">
				<div class="form-group col">
					<label>Identification:</label>
					<input type="text" name="identification" class="form-control form-control-sm" placeholder="e.g. 478, TE064, MAM-0001">
				</div>
				<div class="form-group col">
					<label>Sex:</label>
					<select name="sex" class="form-control form-control-sm">
						<option selected disabled>Choose...</option>
						<option value="Female">Female</option>
						<option value="Male">Male</option>
						<option value="Unknown">Unknown</option>
					</select>
				</div>
				<div class="form-group col">
					<label>Name:</label>
					<input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. ROXXANE">
				</div>
				<div class="form-group col">
					<label>Status:</label>
					<select name="status" class="form-control form-control-sm">
						<option selected disabled>Choose...</option>
						<option value="1">Alive</option>
						<option value="0">Death</option>
						<option value="">Unkknown</option>
					</select>
				</div>
			</div>

		<!-- Parentesco sobre o indivíduo-->
			<div class="font-weight-bold">Kinship<hr class="mt-0 mb-2"></div>
			<div class="row">
				<div class="form-group col">
					<label>Sire identification:</label>
					<input type="text" name="sire" class="form-control form-control-sm" placeholder="e.g. 478, TE064, MAM-0001">
				</div>
				<div class="form-group col">
					<label>Dam identification:</label>
					<input type="text" name="dam" class="form-control form-control-sm" placeholder="e.g. 478, TE064, MAM-0001">
				</div>
			</div>

		<!-- Informações de histórico-->
			<div class="historic">
				
				<div class="font-weight-bold">Historic<hr class="mt-0 mb-2"></div>		
				<div class="row">
					<div class="form-group col">
						<label>Event:</label>
						<select name="event" class="form-control form-control-sm">
							<option selected disabled>Choose...</option>
							<option value="Birth">Birth</option>
							<option value="Capture">Capture</option>
							<option value="Death">Death</option>
						</select>
					</div>
					<div class="form-group col">
						<label>Date:</label>
						<input type="date" name="date" class="form-control form-control-sm">
					</div>
					<div class="form-group col">
						<label>Population:</label>
						<select name="institution" class="form-control form-control-sm">
							<option selected disabled>Choose...</option>
							<?php 
							$sql_institute = "SELECT * FROM institute";
							$query = $mysqli->query($sql_institute);
							$institute="";
							$id="";				
							while ($row = $query->fetch_array()):?>
							  <option value="<?php echo $row["id"]; ?>"><?php echo $row["abbreviation"]," - ",$row["name"]; ?></option>
								<?php
								$institute.=$row["abbreviation"]." - ".$row["name"].",";
								$id.=$row["id"].",";
								?>
							<?php endwhile; ?>
							<input type="hidden" id="hidden_institute" value="<?php echo $institute;?>">
							<input type="hidden" id="hidden_id" value="<?php echo $id;?>">
						</select>
					</div>
					<div class="form-group col">
						<label style="white-space: nowrap;">ID local:</label>
						<input type="text" name="local_id" class="form-control form-control-sm" placeholder="Identifier at the specific institution">
					</div>
					<div class="form-group col">
						<label style="white-space: nowrap;">Observation:</label>
						<input type="text" name="observation" class="form-control form-control-sm" placeholder="Autopsy or extra information">
					</div>
					<div class="form-group col-lg-1 mt-auto px-1">
						<button class="btn btn-sm btn-block btn-success add_historic" style="white-space: nowrap;">Add more</button>
					</div>
				</div>
				<hr class="mt-0 mb-2">
			</div>

		<!-- Form submit -->
		<button type ="submit" class="btn btn-block btn-success mt-5" style="white-space: nowrap;">Insert Data</button>	
	</form>
<?php else:
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Inserir individuo
	$identification = $_GET['identification'];
	$id_category = 1;
	$sex = $_GET['sex'];
	$name = $_GET["name"]!=""?"'$_GET[name]'":"NULL";
	$sql = "INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`) VALUES (NULL, '$identification', '$id_category', '$sex', ".$name.");";
	$result = $mysqli->query($sql);
	if ($result==FALSE){
		$problem="\\nIndividual";
	}

	// Inserir Kinship
	$sire = $_GET['sire'];
	$dam = $_GET['dam'];
	$sql = "INSERT INTO `kinship` (`id_individual`, `sire`, `dam`) VALUES ((SELECT id FROM individual WHERE identification='$identification'),(SELECT id FROM individual WHERE identification='$sire'), (SELECT id FROM individual WHERE identification='$dam'));";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nKinship";
	}

	

	//Commit ou Rollback
	if ($problem==FALSE) {
		//$mysqli->commit();
		echo '<script>alert("Inserido");</script>';
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong with: '.$problem.'");</script>';
	}

endif;

include 'footer.php';