<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
$action= $_GET["action"];
if ($action == "edit") {
	$identification = $_GET["identification"]; 
	$query= "SELECT * FROM `individual` WHERE identification='$identification';";
	$result = $mysqli->query($query);
	if ($result->num_rows==1) {
		$row_individual = $result->fetch_array();
	} else{
		include 'notfound.php';
	}
} elseif($action == "edit" && isset($_GET["id"])) {
	$id = $_GET["id"]; 
	$query= "SELECT * FROM `individual` WHERE id='$id';";
	$result = $mysqli->query($query);
	if ($result->num_rows==1) {
		$row_individual = $result->fetch_array();
	} else{
		include 'notfound.php';
	}
}
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
				<input type="text" name="identification" class="form-control form-control-sm" placeholder="e.g. 478, TE64, MAM-0001" value="<?php echo $action=="edit" && !isset($_GET["identification"])?$row_individual["identification"]:$_GET['identification'];?>">
				<input type="hidden" name="id" value="<?php echo $row_individual['id'];?>">
			</div>
			<div class="form-group col">
				<label>Sex:</label>
				<select name="sex" class="form-control form-control-sm">
					<option selected hidden>Choose...</option>
					<?php foreach (array("Female","Male","Unknown") as $value): ?>
						<option value="<?php echo $value; ?>" <?php echo $action=="edit" && !isset($_GET["sex"])? ($value==$row_individual["sex"]?"selected":""):($value==$_GET['sex']?"selected":"");?>>
							<?php echo $value; ?>
							</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group col">
				<label>Name:</label>
				<input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. ROXXANE" value="<?php echo $action=="edit" && !isset($_GET["name"])?$row_individual["name"]:$_GET['name'];?>">
			</div>
			<div class="form-group col">
				<label>Status:</label>
				<?php 
				$query= "SELECT * FROM `status` WHERE id_individual='$row_individual[id]';";
				$result = $mysqli->query($query);
				$row_status = $result->fetch_array(); ?>
				<select name="status" class="form-control form-control-sm">
					<option selected hidden>Choose...</option>
					<?php foreach (array(1 =>"Alive",0 => "Death","" =>"Unknown") as $key => $value): ?>
						<option value="<?php echo $key; ?>" <?php echo $action=="edit" && !isset($_GET["status"])?($key==$row_status["alive"]?"selected":""):($key==$_GET['status'] && isset($_GET['status'])?"selected":"");?>>
							<?php echo $value; ?>
							</option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

	<!-- Parentesco sobre o indivíduo-->
		<div class="font-weight-bold">Kinship<hr class="mt-0 mb-2"></div>
		<?php 
		$query= "SELECT * FROM `kinship` WHERE id_individual='$row_individual[id]';";
		$result = $mysqli->query($query);
		$row_kinship = $result->fetch_array();

		$query= "SELECT * FROM `individual` WHERE id='$row_kinship[sire]';";
		$result = $mysqli->query($query);
		$row_sire = $result->fetch_array();

		$query= "SELECT * FROM `individual` WHERE id='$row_kinship[dam]';";
		$result = $mysqli->query($query);
		$row_dam = $result->fetch_array();
		?>
		<div class="row">
			<div class="form-group col">
				<label>Sire identification:</label>
				<input type="text" name="sire" list="datalistSire" class="form-control form-control-sm" placeholder="e.g. 478, TE64, MAM-0001" value="<?php echo $action=="edit" && !isset($_GET["sire"]) ? $row_sire["identification"]:$_GET['sire'];?>">
				<?php 
				$query= "SELECT * FROM `individual` WHERE sex='Male';";
				$result = $mysqli->query($query);?>
				<datalist id="datalistSire">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['identification'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>
			<div class="form-group col">
				<label>Dam identification:</label>
				<input type="text" name="dam" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. 478, TE64, MAM-0001" value="<?php echo $action=="edit" && !isset($_GET["dam"]) ? $row_dam["identification"]:$_GET['dam'];?>">
				<?php 
				$query= "SELECT * FROM `individual` WHERE sex='Female';";
				$result = $mysqli->query($query);?>
				<datalist id="datalistDam">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['identification'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>
		</div>

	<!-- Informações de histórico-->
		<div class="historic">
			<div class="font-weight-bold">Historic<hr class="mt-0 mb-2"></div>		

			<?php if ($action=="edit"): ?>
				<?php
				$sql = "SELECT * , historic.id AS id_historic FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$row_individual[id]' ORDER BY date ASC;";
				$result = $mysqli->query($sql);
				$flag=0;
				while ($row_historic = $result->fetch_array()): ?>
					<div class="row" id="historic<?php echo $row_historic[id_historic]?>">

						<div class="form-group col">
							<label>Event:</label>
							<select name="event<?php echo $row_historic[id_historic]?>" class="form-control form-control-sm">
								<?php 
								$sql = "SELECT * FROM events";
								$query = $mysqli->query($sql);
								$events="";
								$id_event="";				
								while ($row_events = $query->fetch_array()):?>
								  <option value="<?php echo $row_events["id"]; ?>" <?php echo $row_events["events"]==$row_historic["events"]?"class='text-success' selected":"";?>><?php echo $row_events["events"]; ?></option>
									<?php
									$events.=$row_events["events"].",";
									$id_event.=$row_events["id"].",";
									?>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group col">
							<label>Date:</label>
							<input type="date" name="date<?php echo $row_historic[id_historic]?>" class="form-control form-control-sm" value="<?php echo $row_historic["date"]; ?>">
						</div>

						<div class="form-group col">
							<label>Population:</label>
							<select name="institute<?php echo $row_historic[id_historic]?>" class="form-control form-control-sm">
								<?php 
								$sql_institute = "SELECT * FROM institute";
								$query = $mysqli->query($sql_institute);
								$institute="";
								$id_institute="";				
								while ($row_institute = $query->fetch_array()):?>
								  <option value="<?php echo $row_institute["id"]; ?>" <?php echo $row_institute["id"]==$row_historic["id_institute"]?"class='text-success' selected":"";?>> <?php echo $row_institute["abbreviation"]," - ",$row_institute["name"]; ?></option>
									<?php
									$institute.=$row_institute["abbreviation"]." - ".$row_institute["name"].",";
									$id_institute.=$row_institute["id"].",";
									?>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group col">
							<label style="white-space: nowrap;">ID local:</label>
							<input type="text" name="local_id<?php echo $row_historic[id_historic]?>" class="form-control form-control-sm" placeholder="Identifier at the specific institution" value="<?php echo $row_historic["local_id"]; ?>">
						</div>

						<div class="form-group col">
							<label style="white-space: nowrap;">Observation:</label>
							<input type="text" name="observation<?php echo $row_historic[id_historic]?>" class="form-control form-control-sm" placeholder="Autopsy or extra information" value="<?php echo $row_historic["observation"]; ?>">
						</div>

						<div class="form-group col-lg-1 mt-auto px-1">
							<?php if ($flag==0):
							$flag+=1;?>
								<span class="btn btn-sm btn-block btn-success add_historic" style="white-space: nowrap;">Add more</span>
							<?php else: ?>
								<span class="btn btn-sm btn-block btn-danger float-center" onclick="deleteHistoric('<?php echo $row_historic[id_historic]?>');" style="white-space: nowrap;">Remove</span>						
							<?php endif ?>						
						</div>
					</div>
				<?php endwhile; ?>
				<input type="hidden" id="hidden_events" value="<?php echo $events;?>">
				<input type="hidden" id="hidden_id_events" value="<?php echo $id_event;?>">
				<input type="hidden" id="hidden_institute" value="<?php echo $institute;?>">
				<input type="hidden" id="hidden_id_institute" value="<?php echo $id_institute;?>">
			
			<?php else: ?>
				<div class="row">
					<div class="form-group col">
						<label>Event:</label>
						<select name="event[]" class="form-control form-control-sm">
							<option selected hidden>Choose...</option>
							<?php 
							$sql = "SELECT * FROM events";
							$query = $mysqli->query($sql);
							$events="";
							$id="";				
							while ($row = $query->fetch_array()):?>
							  <option value="<?php echo $row["id"]; ?>"><?php echo $row["events"]; ?></option>
								<?php
								$events.=$row["events"].",";
								$id.=$row["id"].",";
								?>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group col">
						<label>Date:</label>
						<input type="date" name="date[]" class="form-control form-control-sm">
					</div>
					<div class="form-group col">
						<label>Population:</label>
						<select name="institute[]" class="form-control form-control-sm">
							<option selected hidden>Choose...</option>
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
						</select>
					</div>
					<div class="form-group col">
						<label style="white-space: nowrap;">ID local:</label>
						<input type="text" name="local_id[]" class="form-control form-control-sm" placeholder="Identifier at the specific institution">
					</div>
					<div class="form-group col">
						<label style="white-space: nowrap;">Observation:</label>
						<input type="text" name="observation[]" class="form-control form-control-sm" placeholder="Autopsy or extra information">
					</div>
					<div class="form-group col-lg-1 mt-auto px-1">
						<span class="btn btn-sm btn-block btn-success add_historic" style="white-space: nowrap;">Add more</span>
					</div>
				</div>

				<input type="hidden" id="hidden_events" value="<?php echo $events;?>">
				<input type="hidden" id="hidden_id_events" value="<?php echo $id;?>">
				<input type="hidden" id="hidden_institute" value="<?php echo $institute;?>">
				<input type="hidden" id="hidden_id_institute" value="<?php echo $id;?>">
			<?php endif ?>
		</div>

	<!-- Form submit -->
		<input type="hidden" id="action" name="action" value="<?php echo $_GET["action"];?>">
		<div class="row mt-5">
			<div class="col">
				<button type ="submit" class="btn btn-success  btn-block" style="white-space: nowrap;" onclick="changeValue('action','<?php echo $action=="edit"?"edited":"insert"?>')">Submit</button>
			</div>
			<div class="col">
				<button onclick="<?php echo $action=="edit"?"window.close(); return false;":"window.history.back(); return false;"?>" class="btn btn-danger btn-block" autofocus>Cancel</button>
			</div>
		</div>		
</form>
<?php if(isset($_GET['action']) && $_GET['action']=="insert"):
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
		$sql ="INSERT INTO `historic` (`id`, `id_individual`, `id_event`, `id_institute`, `local_id`, `date`, `observation`) VALUES (NULL, (SELECT id FROM individual WHERE identification='$identification'), '$event[$key]', '$institute[$key]', $this_local_id, '$date[$key]', $this_observation);";
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
	$sql = "INSERT INTO `status` (`id_individual`, `id_institute`, `id_fragment`, `alive`) VALUES ((SELECT id FROM individual WHERE identification='$identification'),'$institute[$mostRecent_id]', NULL, $status);";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nStatus";
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserted");</script>';
		echo "<script>window.location.replace('captivity_insert.php')</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong with: '.$problem.'");</script>';
	}
elseif (isset($_GET['action']) && $_GET['action']=="edited"):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	//Update individuo
	$identification = $_GET['identification'];
	$id = $_GET['id'];
	$id_category = 1;
	$sex = $_GET['sex'];
	$name = $_GET["name"]!=""?"'$_GET[name]'":"NULL";
	$sql = "UPDATE `individual` SET identification='$identification', id_category='$id_category', sex='$sex', name=".$name." WHERE id='$id';";
	$result = $mysqli->query($sql);
	if ($result==FALSE){
		$problem="\\nIndividual";
	}

	// Inserir Kinship
	$sire = $_GET['sire'];
	$dam = $_GET['dam'];
	$sql= "UPDATE`kinship` SET sire=(SELECT id FROM individual WHERE identification='$sire'), dam=(SELECT id FROM individual WHERE identification='$dam')  WHERE id_individual='$id';";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nKinship";
	}

	//Delete Historic
	if (isset($_GET["remove_historic"])) {
		$remove_historic = $_GET["remove_historic"];
		$flag=FALSE;
		foreach ($remove_historic as $value) {
			$sql = "DELETE FROM historic WHERE id='$value';";
			$result = $mysqli->query($sql);
			if ($result==FALSE) {
				$flag="ERROR";
			}
		}
		if ($flag=="ERROR") {
				$problem.="\\nRemove Historic";
			}
	}

	$sql = "SELECT * , historic.id AS id_historic FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$id' ORDER BY date ASC;";
	$result = $mysqli->query($sql);
	while ($row_historic = $result->fetch_array()){
		$id_historic = $row_historic['id_historic'];
		$event = $_GET['event'.$id_historic];
		$date = $_GET['date'.$id_historic];
		$institute = $_GET['institute'.$id_historic];
		$local_id = $_GET['local_id'.$id_historic];
		$observation = $_GET['observation'.$id_historic];

		$sql_update = "UPDATE `historic` SET id_event='$event', date='$date', id_institute='$institute', local_id='$local_id', observation='$observation' WHERE id='$id_historic';";
		$result_update = $mysqli->query($sql_update);
		if ($result_update==FALSE) {
			$problem.="\\nUpdate Historic";
		}

	}
		
	if (isset($_GET['event'])) {
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
	}

	//Insert Status
	$sql = "SELECT * , historic.id AS id_historic FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$id' ORDER BY date DESC;";
		$result = $mysqli->query($sql);
		$row_historic = $result->fetch_array();

		$id_institute = $row_historic["id_institute"];	
		$status =$_GET["status"]!=""?"'$_GET[status]'":"NULL";
		$sql= "UPDATE `status` SET `id_institute`='$id_institute', `alive`= $status WHERE id_individual='$id';";
		$result = $mysqli->query($sql);
		if ($result==FALSE) {
			$problem.="\\nStatus";
		}

		//Commit ou Rollback
		if ($problem==FALSE) {
			$mysqli->commit();
			echo '<script>alert("Edited");</script>';
			echo "<script>window.close();</script>";
		} else{
			$mysqli->rollback();
			echo '<script>alert("There is something wrong with: '.$problem.'");</script>';
		}
endif; ?>

<?php include 'footer.php'; ?>