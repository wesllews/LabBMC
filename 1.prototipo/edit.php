<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$identification = $_GET["identification"]; 
$query= "SELECT * FROM `individual` WHERE identification='$identification';";
$result = $mysqli->query($query);
$rows =$result->num_rows;
if ($rows==1) {
	$row_individual = $result->fetch_array();
}

?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Edit Individual</h4>
</div>

<form method="GET" class="container mb-4">
	
	<!-- Informações sobre o indivíduo-->
		<div class="font-weight-bold">Individual<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Identification:</label>
				<input type="text" name="identification" class="form-control form-control-sm" placeholder="e.g. 478, TE64, MAM-0001" value="<?php echo $row_individual['identification'];?>">
				<input type="hidden" name="id" value="<?php echo $row_individual['id'];?>">
			</div>
			<div class="form-group col">
				<label>Sex:</label>
				<select name="sex" class="form-control form-control-sm">
					<?php foreach (array("Female","Male","Unknown") as $value): ?>
						<option value="<?php echo $value; ?>" <?php echo $value==$row_individual["sex"]?"class='text-success' selected":"";?>>
							<?php echo $value; ?>
							</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group col">
				<label>Name:</label>
				<input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. ROXXANE" value="<?php echo $row_individual['name'];?>">
			</div>
			<div class="form-group col">
				<label>Status:</label>
				<?php 
				$query= "SELECT * FROM `status` WHERE id_individual='$row_individual[id]';";
				$result = $mysqli->query($query);
				$row_status = $result->fetch_array(); ?>
				<select name="status" class="form-control form-control-sm">
					<option value="1" <?php echo $row_status["alive"]==1?"class='text-success' selected":"";?> >Alive</option>
					<option value="0" <?php echo $row_status["alive"]==0?"class='text-success' selected":"";?> >Death</option>
					<option value="" <?php echo $row_status["alive"]==""?"class='text-success' selected":"";?> >Unknown</option>
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
		$sire = $row_sire["identification"];

		$query= "SELECT * FROM `individual` WHERE id='$row_kinship[dam]';";
		$result = $mysqli->query($query);
		$row_dam = $result->fetch_array();
		$dam = $row_dam["identification"];

		?>
		<div class="row">
			<div class="form-group col">
				<label>Sire identification:</label>
				<input type="text" name="sire" list="datalistSire" class="form-control form-control-sm" placeholder="e.g. 478, TE064, MAM-0001" value="<?php echo $sire;?>">
				<?php 
				$query= "SELECT * FROM `individual` WHERE sex='Male';";
				$result = $mysqli->query($query);?>
				<datalist id="datalistSire">
					<?php while ($row_sire = $result->fetch_array()):?>
						<option value="<?php echo $row_sire['identification'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>
			<div class="form-group col">
				<label>Dam identification:</label>
				<input type="text" name="dam" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. 478, TE064, MAM-0001" value="<?php echo $dam;?>">
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
							  <option value="<?php echo $row_institute["id"]; ?>" <?php echo $row_institute["id"]==$row_historic["id_institute"]?"class='text-success' selected":"";?> ><?php echo $row_institute["abbreviation"]," - ",$row_insitute["name"]; ?></option>
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
		</div>

	<!-- Form submit -->
	<button type ="submit" class="btn btn-block btn-success mt-5" style="white-space: nowrap;">Edit Data</button>	
</form>
<?php if(isset($_GET['id'])):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Inserir individuo
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
		echo '<script>alert("Alterado");</script>';
		echo "<script>window.close();</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong with: '.$problem.'");</script>';
	}
endif; ?>

<?php include 'footer.php'; ?>