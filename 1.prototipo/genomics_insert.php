<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
$action= $_GET["action"];
if ($action == "edit" || $action == "reload") {
	$identification = $_GET["identification"];
	echo $query= "SELECT *,individual.id as id FROM `individual` 
	INNER JOIN category ON category.id=individual.id_category
	LEFT JOIN genomic ON genomic.id_individual=individual.id 
	WHERE identification='$identification';";
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
				<input type="text" name="identification" list="datalistIndividual" class="form-control form-control-sm" placeholder="e.g. 478, TE64, MAM-0001" value="<?php echo $row_individual["identification"];?>" <?php echo $action=="edit"?"readonly":"required";?> onblur="changeValue('action','reload'); this.form.submit();">
				<?php 
				$query= "SELECT * FROM `individual`;";
				$result = $mysqli->query($query);?>
				<datalist id="datalistIndividual">
					<?php while ($row_datalist = $result->fetch_array()):?>
						<option value="<?php echo $row_datalist['identification'];?>">
					<?php endwhile; ?>
				</datalist>
				<input type="hidden" name="id" value="<?php echo $row_individual['id'];?>">
			</div>
			<div class="form-group col">
				<label>Sex:</label>
				<input class="form-control form-control-sm" type="text" placeholder="Choose individual…" value="<?php echo $row_individual["sex"]; ?>"readonly>
			</div>
			<div class="form-group col">
				<label>Category:</label>
				<input class="form-control form-control-sm" type="text" placeholder="Choose individual…" value="<?php echo ucfirst($row_individual["category"]); ?>"readonly>
			</div>
			<div class="form-group col">
				<label>Population:</label>
				<?php 
				$query= "SELECT * FROM(
							  SELECT individual.id as id,
							  		CASE
							  		WHEN id_category = 1 THEN institute.abbreviation
							  		WHEN id_category = 2 THEN fragment.fragment
							  		END AS population 
							  	FROM individual
							  	INNER JOIN status ON status.id_individual=individual.id
							  	LEFT JOIN institute ON status.id_institute=institute.id
							  	LEFT JOIN fragment ON status.id_fragment=fragment.id)genomic2 where id=$row_individual[id];";
				$result = $mysqli->query($query);
				if ($result->num_rows>0) {
					$row = $result->fetch_array();
				}?>
				<input class="form-control form-control-sm" type="text" placeholder="Choose individual…" value="<?php echo $row["population"]; ?>"readonly>
			</div>
		</div>

		<!-- Global Position -->
			<div class="font-weight-bold">Genomic information:<hr class="mt-0 mb-2"></div>
			<div class="row">
				<div class="form-group col">
					<label> Platform:</label>
					<input type="text" name="platform" list="datalistPlatform" class="form-control form-control-sm" placeholder="e.g. NCBI, PUBMED, etc" value="<?php echo $action=="edit" && !isset($_GET["platform"]) ? $row_individual["platform"]:$_GET['platform'];?>" required>
					<?php 
					$query= "SELECT DISTINCT(platform) as platform FROM `genomic`;";
					$result = $mysqli->query($query);?>
					<datalist id="datalistPlatform">
						<?php while ($row_datalist = $result->fetch_array()):?>
							<option value="<?php echo $row_datalist['platform'];?>">
						<?php endwhile; ?>
					</datalist>
				</div>
				<div class="form-group col">
					<label> Link:</label>
					<input type="text" name="link" class="form-control form-control-sm" placeholder="Acess on..." value="<?php echo $action=="edit" && !isset($_GET["link"]) ? $row_individual["link"]:$_GET['link'];?>" required>
				</div>
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

	// Inserir Genomic information
	$identification = $_GET['identification'];
	$platform = $_GET['platform'];
	$link = $_GET['link'];
	$sql = "INSERT INTO `genomic` (`id`, `id_individual`, `platform`, `link`) VALUES (NULL, (SELECT id FROM individual WHERE identification='$identification'), '$platform', '$link');";
	$result = $mysqli->query($sql);
	if ($result==FALSE){
		$error= $mysqli->error;
		$problem="\\nMySQL Error:".$error;
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Inserted");</script>';
		echo "<script>window.location.replace('genomics_insert.php')</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong!'.$problem.'");</script>';
	}
elseif (isset($_GET['action']) && $_GET['action']=="edited"):
	$mysqli->autocommit(FALSE);
	$problem=FALSE;

	//Update Genomic information
	$id = $_GET['id'];
	$platform = $_GET['platform'];
	$link = $_GET['link'];
	$sql = "UPDATE `genomic` SET platform='$platform', link='$link' WHERE id_individual='$id';";
	$result = $mysqli->query($sql);
	if ($result==FALSE){
		$error= $mysqli->error;
		$problem="\\nMySQL Error:".$error;
	}

	//Commit ou Rollback
	if ($problem==FALSE) {
		$mysqli->commit();
		echo '<script>alert("Edited");</script>';
		echo "<script>window.close();</script>";
	} else{
		$mysqli->rollback();
		echo '<script>alert("There is something wrong with!'.$problem.'");</script>';
	}
endif; ?>

<?php include 'footer.php'; ?>