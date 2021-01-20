<?php 
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$action= $_GET["action"];
if ($action == "edit") {
	$id = $_GET["id"]; 
	$query= "SELECT * FROM `group` WHERE id='$id';";
	$result = $mysqli->query($query);
	if ($result->num_rows==1) {
		$row_group = $result->fetch_array();
	} else{
		include 'notfound.php';
	}
} 
?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Wild Group</h4>
</div>

<form method="GET" class="container mb-4">
	
	<!-- Nome do instituto e da população -->
		<div class="font-weight-bold">Identification<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Fragment:</label>
				<select name="fragment" class="form-control form-control-sm">
					<option selected hidden>Choose...</option>
					<?php 
					$sql = "SELECT * FROM fragment ORDER BY fragment ASC;";
					$query = $mysqli->query($sql);			
					while ($row = $query->fetch_array()):?>
					  <option value="<?php echo $row["id"];?>" <?php echo $action=="edit" && !isset($_GET["fragment"])? ($row["id"]==$row_group["id_fragment"]?"selected":""):($row["id"]==$_GET['fragment']?"selected":"");?>>
					  	<?php echo $row["fragment"]; ?>
					  	</option>
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group col">
				<label>Group Name:</label>
				<input type="text" name="group" class="form-control form-control-sm" placeholder="e.g. Ponte Branca" value="<?php echo $action=="edit" && !isset($_GET["group"])?$row_group["group"]:$_GET['group'];?>" required>
			</div>
		</div>

	<!-- Global Position -->
		<div class="font-weight-bold">Global Position:<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label> Latitude:</label>
				<input type="text" name="latitude" class="form-control form-control-sm" placeholder="e.g. -22,425176" value="<?php echo $action=="edit" && !isset($_GET["latitude"]) ? $row_group["latitude"]:$_GET['latitude'];?>">
			</div>
			<div class="form-group col">
				<label> Longitude:</label>
				<input type="text" name="longitude" class="form-control form-control-sm" placeholder="e.g. -52,508509" value="<?php echo $action=="edit" && !isset($_GET["longitude"]) ? $row_group["longitude"]:$_GET['longitude'];?>">
			</div>
		</div>

	<!-- Form submit -->
		<input type="hidden" id="action" name="action" value="<?php echo $_GET["action"];?>">
		<input type="hidden" name="id" value="<?php echo $row_group['id'];?>">
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

	// Inserir group
	$fragment = $_GET['fragment'];
	$group = $_GET['group'];
	$latitude = $_GET["latitude"]!=""?"'$_GET[latitude]'":"NULL";
	$longitude = $_GET["longitude"]!=""?"'$_GET[longitude]'":"NULL";
	$sql = "INSERT INTO `group` (`id`, `id_fragment`, `group`, `longitude`, `latitude`) VALUES (NULL, '$fragment', '$group',".$longitude.", ".$latitude.");";
	$result = $mysqli->query($sql);
	if($result==FALSE){
		$problem=TRUE;
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserted");</script>';
		echo "<script>window.location.replace('group.php')</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("Something went wrong");</script>';
	}
elseif(isset($_GET['action']) && $_GET['action']=="edited"):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Inserir individuo
	$id = $_GET['id'];
	$fragment = $_GET['fragment'];
	$group = $_GET['group'];
	$latitude = $_GET["latitude"]!=""?"'$_GET[latitude]'":"NULL";
	$longitude = $_GET["longitude"]!=""?"'$_GET[longitude]'":"NULL";
	$sql = "UPDATE `group` SET  `id_fragment`='$fragment', `group`='$group', `latitude`=$latitude, `longitude`=$longitude WHERE id = '$id';";
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