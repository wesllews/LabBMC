<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$delete = $_GET["delete"];
$identification = "";
$id = $_GET["id"];
switch ($delete) {
 	case 'institute':
	 	$query= "SELECT * FROM `institute` WHERE id='$id';";
	 	$result = $mysqli->query($query);
	 	$rows =$result->num_rows;
	 	if ($rows==1) {
	 		$row = $result->fetch_array();
	 		$identification = $row['name'];
	 		$sql= "DELETE FROM `institute` WHERE id='$id';";
	 	} else{
	 		include "notfound.php";
	 	}
 		break;

 	case 'individual':
	 	$query= "SELECT * FROM `individual` WHERE id='$id';";
	 	$result = $mysqli->query($query);
	 	$rows =$result->num_rows;
	 	if ($rows==1) {
	 		$row = $result->fetch_array();
	 		$identification = $row['identification'];
	 		$sql= "DELETE FROM `individual` WHERE id='$id';";
	 	} else{
	 		include "notfound.php";
	 	}
 		break;

 	case 'fragment':
	 	$query= "SELECT * FROM `fragment` WHERE id='$id';";
	 	$result = $mysqli->query($query);
	 	$rows =$result->num_rows;
	 	if ($rows==1) {
	 		$row = $result->fetch_array();
	 		$identification = $row['fragment'];
	 		$sql= "DELETE FROM `fragment` WHERE id='$id';";
	 	} else{
	 		include "notfound.php";
	 	}
 		break;

 	case 'group':
	 	$query= "SELECT * FROM `group` WHERE id='$id';";
	 	$result = $mysqli->query($query);
	 	$rows =$result->num_rows;
	 	if ($rows==1) {
	 		$row = $result->fetch_array();
	 		$identification = $row['group'];
	 		$sql= "DELETE FROM `group` WHERE id='$id';";
	 	} else{
	 		include "notfound.php";
	 	}
 		break;

 	case 'locus':
	 	$query= "SELECT * FROM `locus` WHERE id='$id';";
	 	$result = $mysqli->query($query);
	 	$rows =$result->num_rows;
	 	if ($rows==1) {
	 		$row = $result->fetch_array();
	 		$identification = $row['locus'];
	 		$sql= "DELETE FROM `locus` WHERE id='$id';";
	 	} else{
	 		include "notfound.php";
	 	}
 		break;

 	case 'genomics':
	 	$query= "SELECT * FROM `genomic` WHERE id='$id';";
	 	$result = $mysqli->query($query);
	 	$rows =$result->num_rows;
	 	if ($rows==1) {
	 		$row = $result->fetch_array();
	 		$identification = "<a href='$row[link]'>$row[platform]</a>";
	 		$sql= "DELETE FROM `genomic` WHERE id='$id';";
	 	} else{
	 		include "notfound.php";
	 	}
 		break;
 }


if(isset($_GET["action"]) && $_GET["action"]=="delete"){
	if($result = $mysqli->query($sql)) {
		echo '<script> alert("Item Deleted!");</script>';
		echo "<script>window.close();</script>";
		exit;
	} else {
		$error =$mysqli->error;
		?>
		<div class=" container alert alert-danger alert-dismissible fade show" role="alert">
			Something went wrong! Check that this information is not being used! <br><br>
			<small><b>MySQL Error: </b><?php echo $error; ?></small>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
	}
}
?>
<div class="container">
	<div class="row py-5">
		<div class="d-none d-lg-block col-lg-2 my-5">
			<!-------null------>
		</div>

		<div class="col-xs-12 col-lg-8 p-5 mt-5 bg-light shadow-sm text-center">	
			<h4>Are you sure about delete <b><?php echo $identification ?></b> from <?php echo $delete ?>?</h4>
			<form action="delete.php" method="GET" id="delete">
				<input type="hidden" name="id" value="<?php echo $row['id'];?>">
				<input type="hidden" name="delete" value="<?php echo $_GET['delete'];?>">
				<input type="hidden" id="action" name="action" value="">
			</form>
			<div class="form-group row mt-5">
				<div class="col">
					<button type="submit" form="delete" class="btn btn-success btn-block" onclick="changeValue('action','delete')">Yes</button>
				</div>		
				<div class="col">
					<button onclick="window.close(); return false;" class="btn btn-danger btn-block" autofocus>No</button>
				</div>	
			</div>					
		</div>

		<div class="d-none d-lg-block col-lg-2">
			<!-------null------>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>