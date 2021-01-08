<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Wild Individuals</h4>
</div>

<form method="GET" class="container mb-4">
	
	<!-- Informações sobre o indivíduo-->
		<div class="font-weight-bold">Individual<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Identification:</label>
				<input type="text" name="identification" class="form-control form-control-sm" placeholder="e.g. 478, TE64, MAM-0001" value="<?php echo $_GET['identification'];?>">
				</div>
			<div class="form-group col">
				<label>Sex:</label>
				<select name="sex" class="form-control form-control-sm">
					<option selected hidden>Choose...</option>
					<?php foreach (array("Female","Male","Unknown") as $value): ?>
						<option value="<?php echo $value; ?>" <?php echo $value==$_GET['sex']?"selected":"";?>>
							<?php echo $value; ?>
							</option>
					<?php endforeach ?>
				</select>
				</div>
			<div class="form-group col">
				<label>Name:</label>
				<input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. ROXXANE" value="<?php echo $_GET['name'];?>">
			</div>
			<div class="form-group col">
				<label>Status:</label>
				<select name="status" class="form-control form-control-sm">
					<option selected hidden>Choose...</option>
					<?php foreach (array(1 =>"Alive",0 => "Death","" =>"Unknown") as $key => $value): ?>
						<option value="<?php echo $key; ?>" <?php echo $key==$_GET['status'] && isset($_GET['status'])?"selected":"";?>>
							<?php echo $value; ?>
							</option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

	<!-- Population -->
		<div class="font-weight-bold">Population<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Fragment:</label>
				<select name="fragment" class="form-control form-control-sm"  onchange="this.form.submit()">
					<option selected hidden>Choose...</option>
					<?php 
					$sql = "SELECT * FROM fragment ORDER BY id ASC;";
					$query = $mysqli->query($sql);			
					while ($row = $query->fetch_array()):?>
					  <option value="<?php echo $row["id"];?>" <?php echo $row["id"]==$_GET['fragment']?"selected":"";?>>
					  	<?php echo $row["fragment"]; ?>
					  	</option>
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group col">
				<label> Group:</label>
				<select name="group" class="form-control form-control-sm">
					<?php
					if(isset($_GET["fragment"])):
						$id_fragment = $_GET["fragment"];
						$query= "SELECT * FROM `group` WHERE id_fragment='$id_fragment';";
						$result = $mysqli->query($query);?>
						<option value="" selected hidden>Choose...</option>
						<option value="none" <?php echo $_GET['group']=="none"?"selected":"";?>>No one group</option>
						<?php while ($row_group = $result->fetch_array()):?>
							<option value="<?php echo $row_group['id'];?>"  <?php echo $row_group["id"]==$_GET['group']?"selected":"";?>>
								<?php echo $row_group['group'];?>
							</option>
						<?php endwhile; ?>
					<?php else: ?>
						<option value="" selected hidden>Choose Fragment First</option>
					<?php endif; ?>
				</select>
			</div>
		</div>

	<!-- Global Position -->
		<div class="font-weight-bold">Global Position:<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label> Latitude individual:</label>
				<input type="text" name="latitude" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. -22,425176" value="<?php echo $_GET['latitude'];?>">
			</div>
			<div class="form-group col">
				<label> Longitude individual:</label>
				<input type="text" name="longitude" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. -52,508509" value="<?php echo $_GET['longitude'];?>">
			</div>
		</div>

	<!-- Form submit -->
	<button type ="submit" class="btn btn-block btn-success mt-5" style="white-space: nowrap;">Insert Data</button>	
</form>
<?php if(isset($_GET['group']) && $_GET['group']!=""):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Inserir individuo
	$identification = $_GET['identification'];
	$id_category = 2;
	$sex = $_GET['sex'];
	$name = $_GET["name"]!=""?"'$_GET[name]'":"NULL";
	$sql = "INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`) VALUES (NULL, '$identification', '$id_category', '$sex', ".$name.");";
	$result = $mysqli->query($sql);
	if ($result==FALSE){
		$problem="\\nIndividual";
	}

	// Inserir Population/Status
	$fragment = $_GET['fragment'];
	$status =$_GET["status"]!=""?"'$_GET[status]'":"NULL";
	$sql= "INSERT INTO `status` (`id_individual`, `id_institute`, `id_fragment`, `alive`) VALUES ((SELECT id FROM individual WHERE identification='$identification'), NULL, '$fragment', $status);";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\n Fragment or Status";
	}

	// Inserir Ind_Group
	$group = $_GET['group'];
	$latitude =$_GET["latitude"]!=""?"'$_GET[latitude]'":"NULL";
	$longitude =$_GET["longitude"]!=""?"'$_GET[longitude]'":"NULL";
	$sql= "INSERT INTO `ind_group` (`id_individual`, `id_group`, `longitude_ind`, `latitude_ind`) VALUES ( (SELECT id FROM individual WHERE identification='$identification'), '$group', $longitude, $latitude);";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nGroup ou Global position";
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserido");</script>';
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong with: '.$problem.'");</script>';
	}
endif;?>

<?php include 'footer.php'; ?>