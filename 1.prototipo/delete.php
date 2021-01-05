<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

$identification = $_GET["identification"]; 
$id = $_GET["id"]; 
$query= "SELECT * FROM `individual` WHERE identification='$identification';";
$result = $mysqli->query($query);
$rows =$result->num_rows;
if ($rows==1) {
	$row = $result->fetch_array();
}


if(isset($_GET["id"])){
	//$mysqli->autocommit(FALSE);
	$query= "DELETE FROM `individual` WHERE id='$id';";
	$result = $mysqli->query($query);
		echo '<script> alert("Individual Deleted!");</script>';
		echo "<script>window.close();</script>";
		exit;
}

?>
<div class="container">
	<div class="row py-5">
		<div class="d-none d-lg-block col-lg-2 my-5">
			<!-------null------>
		</div>

		<div class="col-xs-12 col-lg-8 p-5 mt-5 bg-light shadow-sm text-center">	
				<h4>Are You sure about delete individuo: <b><?php echo $identification ?></b>?</h4>
				<form action="delete.php" method="GET" id="delete">
					<input type="hidden" name="id" value="<?php echo $row['id'];?>">
				</form>
				<div class="form-group row mt-5">
					<div class="col"><button type="submit" form="delete" class="btn btn-success btn-block">Yes</button></div>		
				<div class="col"><button onclick="window.close(); return false;" class="btn btn-danger btn-block" autofocus>No</button></div>	
				</div>
					
		</div>

		<div class="d-none d-lg-block col-lg-2">
			<!-------null------>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>