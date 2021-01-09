<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$action= $_GET["action"];
if ($action == "edit" && !isset($_GET["id"])) {
	$identification = $_GET["identification"]; 
	$query= "SELECT * FROM `individual` WHERE identification='$identification';";
	$result = $mysqli->query($query);
	if ($result->num_rows==1) {
		$row_individual = $result->fetch_array();
	} else{
		include 'notfound.php';
	}
} else {
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
	<h4 class="text-warning font-weight-bold">Wild Individuals</h4>
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
					  <option value="<?php echo $row["id"];?>" <?php echo $action=="edit" && !isset($_GET["fragment"])? ($row["id"]==$row_status["id_fragment"]?"selected":""):($row["id"]==$_GET['fragment']?"selected":"");?>>
					  	<?php echo $row["fragment"]; ?>
					  	</option>
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group col">
				<label> Group:</label>
				<?php 
				$query= "SELECT * FROM `ind_group` WHERE id_individual='$row_individual[id]';";
				$result = $mysqli->query($query);
				$row_group = $result->fetch_array(); ?>
				<select name="group" class="form-control form-control-sm">
					<?php
					if(isset($_GET["fragment"]) || $_GET["action"]=="edit"):
						$id_fragment = $action=="edit" && !isset($_GET["fragment"])? $row_status["id_fragment"]:$_GET["fragment"];
						$query= "SELECT * FROM `group` WHERE id_fragment='$id_fragment';";
						$result = $mysqli->query($query);?>
						<option value="" selected hidden>Choose...</option>
						<option value="none" <?php echo $_GET['group']=="none"?"selected":"";?>>No one group</option>
						<?php while ($row = $result->fetch_array()):?>
							<option value="<?php echo $row['id'];?>" <?php echo $action=="edit" && !isset($_GET["group"])? ($row["id"]==$row_group["id_group"]?"selected":""):($row["id"]==$_GET['group']?"selected":"");?>>
								<?php echo $row['group'];?>
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
				<input type="text" name="latitude" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. -22,425176" value="<?php echo $action=="edit" && !isset($_GET["latitude"]) ? $row_group["latitude_ind"]:$_GET['latitude'];?>">
			</div>
			<div class="form-group col">
				<label> Longitude individual:</label>
				<input type="text" name="longitude" list="datalistDam" class="form-control form-control-sm" placeholder="e.g. -52,508509" value="<?php echo $action=="edit" && !isset($_GET["longitude"]) ? $row_group["longitude_ind"]:$_GET['longitude'];?>">
			</div>
		</div>

	<!-- Form submit -->
	<input type="hidden" id="action" name="action" value="<?php echo $_GET["action"];?>">
	<button type ="submit" class="btn btn-block btn-success mt-5" style="white-space: nowrap;" onclick="changeValue('action','<?php echo $action=="edit"?"edited":"insert"?>')">Submit</button>	
</form>
<?php if(isset($_GET['action']) && $_GET['action']=="insert"):
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
		echo '<script>alert("Inserted");</script>';
		echo "<script>window.close();</script>";
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
	$id_category = 2;
	$sex = $_GET['sex'];
	$name = $_GET["name"]!=""?"'$_GET[name]'":"NULL";
	$sql = "UPDATE `individual` SET identification='$identification', id_category='$id_category', sex='$sex', name=".$name." WHERE id='$id';";
	$result = $mysqli->query($sql);
	if ($result==FALSE){
		$problem="\\nIndividual";
	}

	// Update Population/Status
	$fragment = $_GET['fragment'];
	$status =$_GET["status"]!=""?"'$_GET[status]'":"NULL";
	$sql = "UPDATE `status` SET `id_fragment`='$fragment', `alive`= $status WHERE id_individual='$id';";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nStatus";
	}

	// Update Ind_Group
	$group = $_GET['group'];
	$latitude =$_GET["latitude"]!=""?"'$_GET[latitude]'":"NULL";
	$longitude =$_GET["longitude"]!=""?"'$_GET[longitude]'":"NULL";
	$sql = "UPDATE `ind_group` SET id_group='$group',longitude_ind=$longitude,latitude_ind=$latitude WHERE id_individual='$id';";
	$result = $mysqli->query($sql);
	if ($result==FALSE) {
		$problem.="\\nGroup ou Global position";
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

endif;?>

<?php include 'footer.php'; ?>