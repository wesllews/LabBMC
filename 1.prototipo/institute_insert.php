<?php 
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$action= $_GET["action"];
if ($action == "edit") {
	$id = $_GET["id"]; 
	$query= "SELECT * FROM `institute` WHERE id='$id';";
	$result = $mysqli->query($query);
	if ($result->num_rows==1) {
		$row_institute = $result->fetch_array();
	} else{
		include 'notfound.php';
	}
} 
?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Captivity Institute</h4>
</div>

<form method="GET" class="container mb-4">
	
	<!-- Nome do instituto e da população -->
		<div class="font-weight-bold">Identification<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Institute Name:</label>
				<input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Durrell Wildlife Conservation Trust" value="<?php echo $action=="edit" && !isset($_GET["name"])?$row_institute["name"]:$_GET['name'];?>" required>
			</div>
			<div class="form-group col">
				<label>Population Name:</label>
				<input type="text" name="abbreviation" class="form-control form-control-sm" placeholder="e.g. Jersey Zoo" value="<?php echo $action=="edit" && !isset($_GET["abbreviation"])?$row_institute["abbreviation"]:$_GET['abbreviation'];?>" required>
			</div>
		</div>

	<!-- Localização -->
		<div class="font-weight-bold">Location<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Country:</label>
				<input type="text" name="country" list="datalistCountry" class="form-control form-control-sm" placeholder="e.g. AU, BRA, UK" value="<?php echo $action=="edit" && !isset($_GET["country"])?$row_institute["country"]:$_GET['country'];?>" required>
				<?php 
				$query= "SELECT distinct(country) as country FROM `institute`;";
				$result = $mysqli->query($query);?>
				<datalist id="datalistCountry">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['country'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>

			<div class="form-group col">
				<label>State:</label>
				<input type="text" name="state" list="datalistState" class="form-control form-control-sm" placeholder="e.g. South Australia, Distrito Federal" value="<?php echo $action=="edit" && !isset($_GET["state"])?$row_institute["state"]:$_GET['state'];?>">
				<?php 
				$query= "SELECT distinct(state) as state FROM `institute` where state != 'NULL' ORDER BY state ASC;";
				$result = $mysqli->query($query);?>
				<datalist id="datalistState">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['state'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>

			<div class="form-group col">
				<label>City:</label>
				<input type="text" name="city" list="datalistCity" class="form-control form-control-sm" placeholder="e.g. New York, Brasilia" value="<?php echo $action=="edit" && !isset($_GET["city"])?$row_institute["city"]:$_GET['city'];?>">
				<?php 
				$query= "SELECT distinct(city) as city FROM `institute` where city!= 'NULL' ORDER BY city ASC;";
				$result = $mysqli->query($query);?>
				<datalist id="datalistCity">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['city'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>
		</div>

	<!-- Form submit -->
		<input type="hidden" id="action" name="action" value="<?php echo $_GET["action"];?>">
		<input type="hidden" name="id" value="<?php echo $row_institute['id'];?>">
		<div class="row mt-5">
			<div class="col">
				<button type ="submit" class="btn btn-success btn-block" style="white-space: nowrap;" onclick="changeValue('action','<?php echo $action=="edit"?"edited":"insert"?>')">Submit</button>
			</div>
			<div class="col">
				<button onclick="<?php echo $action=="edit"?"window.close(); return false;":"window.history.back();"?>" class="btn btn-danger btn-block" autofocus>Cancel</button>
			</div>
		</div>	
</form>
<?php if(isset($_GET['action']) && $_GET['action']=="insert"):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Inserir individuo
	$name = $_GET['name'];
	$abbreviation = $_GET['abbreviation'];
	$country = $_GET['country'];
	$state = $_GET["state"]!=""?"'$_GET[state]'":"NULL";
	$city = $_GET["city"]!=""?"'$_GET[city]'":"NULL";
	$sql = "INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `priority`) VALUES (NULL, '$name', '$abbreviation', '$country', ".$state.", ".$city.", NULL);";
	$result = $mysqli->query($sql);
	if($result==FALSE){
		$problem=TRUE;
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserted");</script>';
		echo "<script>window.location.replace('institute_insert.php')</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("Something went wrong");</script>';
	}
elseif(isset($_GET['action']) && $_GET['action']=="edited"):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Inserir individuo
	$id = $_GET['id'];
	$name = $_GET['name'];
	$abbreviation = $_GET['abbreviation'];
	$country = $_GET['country'];
	$state = $_GET["state"]!=""?"'$_GET[state]'":"NULL";
	$city = $_GET["city"]!=""?"'$_GET[city]'":"NULL";
	$sql = "UPDATE `institute` SET  `name`='$name', `abbreviation`='$abbreviation', `country`='$country', `state`=$state, `city`=$city WHERE id = '$id';";
	$result = $mysqli->query($sql);
	if($result==FALSE){
		$problem=TRUE;
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Edited");</script>';
		echo "<script>window.close();</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("Something went wrong");</script>';
	}
endif;?>
<?php include 'footer.php'; ?>