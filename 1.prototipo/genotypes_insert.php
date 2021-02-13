<?php 
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container text-center mt-5">
	<h4 class="text-warning font-weight-bold">Insert Genotypes</h4>
</div>

<div class="container">
	<div class="row">
		<div class="d-none d-lg-block col-lg-2 my-5">
			<!-------null------>
		</div>

		<div class="col-xs-12 col-lg-8 p-5 mt-5 bg-light shadow-sm text-center">
			<form method="post" action="genotypes_import.php" enctype="multipart/form-data" class="was-validated container mb-4">
				<div class="row">					
					<div class="custom-file">
						<input type="file" name="file" class="custom-file-input" id="inputFile" accept=".xls,.xlsx,.csv,.xml,.ods,.slk,.gnumeric" required>
						<label class="custom-file-label text-left" for="inputFile">Choose file...</label>
					</div>
					<script type="text/javascript">
						document.querySelector('.custom-file-input').addEventListener('change',function(e){
						  var fileName = document.getElementById("inputFile").files[0].name;
						  var nextSibling = e.target.nextElementSibling
						  nextSibling.innerText = fileName
						})
					</script>
				</div>
				<div class="row align-item-right">
					<a class="btn float-right btn-sm font-italic text-decoration-none text-secondary" data-toggle="collapse" href="#help" role="button" aria-expanded="false" aria-controls="help">
						Help
					</a>
				</div>
				<div class="collapse text-secondary text-justify m-3" style="font-size: 12px;" id="help">
					<p>
						You can use this <a href="model/genotype.xlsx">example</a> or use a download file from the genetics page as example.
						<br>
						<i>Ps: is just necessary the "Identification" column and the "locus" columns, but doesn't need remove the others.</i>
					</p>
					<b>Especifications:</b>
					<ul>
						<li>First column need to be the column of identification of individual</li>
						<li>If some information in the row couldn't be inserted <b>all the row is not going to be inserted</b></li>
						<li>Is aceppet file on this formats: <b>.xls, .xlsx, .csv, .xml, .ods</b> </li>
						<li>The empty cell is not goin to be inserted</li>
					</ul>
				</div>

			<!-- Form submit -->
				<div class="row mt-5">
		    		<input type="hidden" name="action" value="insert">
					<div class="col">
						<button type ="submit" class="btn btn-success btn-block" style="white-space: nowrap;" >Submit</button>
					</div>
					<div class="col">
						<button onclick="<?php echo $action=="edit"?"window.close(); return false;":"window.history.back();"?>" class="btn btn-danger btn-block" autofocus>Cancel</button>
					</div>
				</div>	
			</form>					
		</div>

		<div class="d-none d-lg-block col-lg-2">
			<!-------null------>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>