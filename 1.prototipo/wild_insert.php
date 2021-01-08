<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Captivity Individuals</h4>
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
					<option selected disabled>Choose...</option>
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
					<option selected disabled>Choose...</option>
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
					<option selected disabled>Choose...</option>
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
						$result = $mysqli->query($query);
						if ($result->num_rows > 0):?>
							<?php while ($row_group = $result->fetch_array()):?>
								<option value="<?php echo $row_group['id'];?>">
									<?php echo $row_group['group'];?>
								</option>
							<?php endwhile; ?>
						<?php else: ?>
							<option value="no">No One Group</option>
							<option value="new">Insert New Group</option>
						<?php endif; ?>
					<?php else: ?>
						<option selected disabled>Choose Fragment First</option>
					<?php endif; ?>
				</select>
			</div>
		</div>

	<!-- Global Position -->
		<div class="font-weight-bold">Global Position:<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label> Latitude individual:</label>
				<input type="text" name="dam" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. -22,425176">
			</div>
			<div class="form-group col">
				<label> Longitude individual:</label>
				<input type="text" name="dam" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. -52,508509">
			</div>
		</div>

	<!-- Form submit -->
	<button type ="submit" class="btn btn-block btn-success mt-5" style="white-space: nowrap;">Insert Data</button>	
</form>
<?php /*if(isset($_GET['identification'])):
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
	$sql= "INSERT INTO `kinship` (`id_individual`, `sire`, `dam`) VALUES ((SELECT id FROM individual WHERE identification='$identification'),(SELECT id FROM individual WHERE identification='$sire'), (SELECT id FROM individual WHERE identification='$dam'));";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nKinship";
	}

	//Inserir Historico
	$event = $_GET['event'];
	$date = $_GET['date'];
	$institute = $_GET['institute'];
	$local_id = $_GET['local_id'];
	$observation = $_GET['observation'];
	$flag=FALSE;
	foreach ($event as $key => $value) {
		$this_local_id = $local_id[$key]!=""?"'$local_id[$key]'":"NULL";
		$this_observation = $observation[$key]!=""?"'$observation[$key]'":"NULL";
		$sql="INSERT INTO `historic` (`id`, `id_individual`, `id_event`, `id_institute`, `local_id`, `date`, `observation`) VALUES (NULL, (SELECT id FROM individual WHERE identification='$identification'), '$event[$key]', '$institute[$key]', $this_local_id, '$date[$key]', $this_observation);";
		$result = $mysqli->query($sql);
		if ($result==FALSE) {
			$flag="ERROR";
		}
	}
	if ($flag=="ERROR") {
			$problem.="\\nHistoric";
		}

	//Insert Status
	$mostRecent=0;
	$mostRecent_id=0;
	foreach($date as $key => $value){
	  $curDate = strtotime($value);
	  if ($curDate > $mostRecent) {
	     $mostRecent = $curDate;
	     $mostRecent_id = $key;
	  }
	}
	$status =$_GET["status"]!=""?"'$_GET[status]'":"NULL";
	$sql= "INSERT INTO `status` (`id_individual`, `id_institute`, `id_fragment`, `alive`) VALUES ((SELECT id FROM individual WHERE identification='$identification'),'$institute[$mostRecent_id]', NULL, $status);";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nStatus";
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserido");</script>';
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong with: '.$problem.'");</script>';
	}
endif; */?>

<?php include 'footer.php'; ?>