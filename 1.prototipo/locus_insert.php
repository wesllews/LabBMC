<?php 
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$action= $_GET["action"];
if ($action == "edit") {
	$id = $_GET["id"]; 
	$query= "SELECT * FROM `locus` WHERE id='$id';";
	$result = $mysqli->query($query);
	if ($result->num_rows==1) {
		$row_locus = $result->fetch_array();
	} else{
		include 'notfound.php';
	}
} 
?>
<div class="container text-center mt-5 mb-5">
	<h4 class="text-warning font-weight-bold">Locus</h4>
</div>

<form method="GET" class="container mb-4">
	
	<!-- Nome do instituto e da população -->
		<div class="font-weight-bold">Identification<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Locus Name:</label>
				<input type="text" name="locus" class="form-control form-control-sm" placeholder="e.g. Lchu1, COI" value="<?php echo $action=="edit" && !isset($_GET["locus"])?$row_locus["locus"]:$_GET['locus'];?>" required>
			</div>
			<div class="form-group col">
				<label>Type:</label>
				<input type="text" name="type" list="datalistType" class="form-control form-control-sm" placeholder="e.g. Microsatellite, Mitochondrial" value="<?php echo $action=="edit" && !isset($_GET["type"])?$row_locus["type"]:$_GET['type'];?>" required>
				<?php 
				$query= "SELECT distinct(type) as type FROM `locus`;";
				$result = $mysqli->query($query);?>
				<datalist id="datalistType">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['type'];?>">
					<?php endwhile; ?>
				</datalist>
			</div>
			<div class="form-group col">
				<label>Reference:</label>
				<input type="text" name="reference" class="form-control form-control-sm" placeholder="e.g. GALBUSERA; GILLEMOT, 2008" value="<?php echo $action=="edit" && !isset($_GET["reference"])?$row_locus["reference"]:$_GET['reference'];?>" required>
			</div>
		</div>

	<!-- Localização -->
		<div class="font-weight-bold">Sequence<hr class="mt-0 mb-2"></div>
		<div class="row">
			<div class="form-group col">
				<label>Motif:</label>
				<input type="text" name="motif" class="form-control form-control-sm" placeholder="e.g. (TTTA)8" value="<?php echo $action=="edit" && !isset($_GET["motif"])?$row_locus["motif"]:$_GET['motif'];?>" required>
			</div>
			<div class="form-group col">
				<label>Primer Forward:</label>
				<input type="text" name="forward" class="form-control form-control-sm" placeholder="e.g. GCTCAGGTGTTATTTATGTCCAAA" value="<?php echo $action=="edit" && !isset($_GET["forward"])?$row_locus["forward"]:$_GET['forward'];?>" required>
			</div>
			<div class="form-group col">
				<label>Primer Reverse:</label>
				<input type="text" name="reverse" class="form-control form-control-sm" placeholder="e.g. GTTTCTTGCAACTATCTTGCATGTTCTGC" value="<?php echo $action=="edit" && !isset($_GET["reverse"])?$row_locus["reverse"]:$_GET['reverse'];?>" required>
			</div>

		</div>

	<!-- Form submit -->
		<input type="hidden" id="action" name="action" value="<?php echo $_GET["action"];?>">
		<input type="hidden" name="id" value="<?php echo $row_locus['id'];?>">
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

	// Inserir locus
	$locus = $_GET['locus'];
	$type = $_GET['type'];
	$motif = $_GET['motif'];
	$reference = $_GET['reference'];
	$forward = $_GET['forward'];
	$reverse = $_GET['reverse'];
	$sql = "INSERT INTO `locus` (`id`, `locus`, `type`, `motif`, `reference`, `forward`, `reverse`) VALUES (NULL, '$locus', '$type', '$motif', '$reference', '$forward', '$reverse');";
	$result = $mysqli->query($sql);
	if($result==FALSE){
		$problem=TRUE;
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserted");</script>';
		echo "<script>window.location.replace('locus_insert.php')</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("Something went wrong");</script>';
	}
elseif(isset($_GET['action']) && $_GET['action']=="edited"):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	// Update locus
	$id = $_GET['id'];
	$locus = $_GET['locus'];
	$type = $_GET['type'];
	$motif = $_GET['motif'];
	$reference = $_GET['reference'];
	$forward = $_GET['forward'];
	$reverse = $_GET['reverse'];
	echo $sql = "UPDATE `locus` SET  `locus`='$locus', `type`='$type', `motif`='$motif', `reference`='$reference', `forward`='$forward', `reverse`='$reverse' WHERE id = '$id';";
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