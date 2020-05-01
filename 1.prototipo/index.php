<?php
session_start();
$_SESSION['pagina']='home';
include 'header.php';
?>

<!-- Welcome Picture-->
<div class="d-flex align-items-end pl-5 pb-4 bg-home" >
	<div class="flex-column p-4">
		<div class="text-warning "><h1 class="text-shadow">Welcome to</h1></div>
		<div class="text-light"><h1 class="display-4 text-shadow font-weight-bold">Black Lion Tamarin Database</h1></div>
	</div>
</div>


<!-- Tools Section -->
<div class="container-fluid">

	<!--Row of Title Tools-->
	<div class="row justify-content-center">
		<div class="text-center float-left px-5 pt-4">
			<h3 class="text-dark letra3">Tools</h3>
			<p>The BLT.Database was developed to connect researchers and integrate ecological, genetic and genomic studies, making available data for wild and captive populations of the endangered <i>Leontopithecus chrysopygus</i> species. Here you can find relevant information about  genetic diversity, management,  demography and other life history data for this small primate, which is endemic to the Atlantic Rainforest of São Paulo state.</p>
		</div>
	</div>


	<!--Row of Tools-->
	<div class="row justify-content-center" id="tools">

		<!--Col of Genetics-->
		<div class="col-lg-3 float-left text-justify shadow m-3 p-0 hover-effect">
			<!--Title-icon-->
			<div class="d-flex text-center flex-column py-5 h-25">
				<h5><i class="hover fas fa-dna"></i></h5>
				<h3>Genetics</h3>
			</div>

			<!--Text-->
			<div class="d-flex flex-column p-4 h-50">
			    <p>Here you can have access to statistical parameters; genotypes and alleles for neutral loci; and also DNA sequences and haplotypes from mitochondrial regions obtained for wild and captive populations of BLT. <i class="fas fa-lock rounded-circle bg-light p-1"  tabindex="0"  data-toggle="popover" data-trigger="focus" data-container="body" data-placement="right" data-content="Please, contact the database manager to require login and password for permissions."></i></p> 				    

			</div>


			<!--Button-->
			<div class="d-flex flex-column text-center h-25">
				<a href="#" class="btn btn-warning mx-4 rounded-0 shadow-sm my-2 disabled">See More</a>
			</div>
		</div>

		<!--Col of Life History-->
		<div class="col-lg-3 float-left text-justify shadow m-3 p-0 hover-effect">
			<!--Title-icon-->
			<div class="d-flex text-center flex-column py-5 h-25 icon">
				<h4><i class="hover fab fa-pagelines"></i></h4>
				<h3>Life History</h3>
			</div>

			<!--Text-->
			<div class="d-flex flex-column p-4 h-50">
			    <p>Here you can find information about population occurrence, diet, reproduction, social behavior, genealogy, management, etc. for wild and captive populations of BLT. <i class="fas fa-lock rounded-circle bg-light p-1"  tabindex="0"  data-toggle="popover" data-trigger="focus" data-container="body" data-placement="right" data-content="Please, contact the database manager to require login and password for permissions."></i></p>
			</div>

			<!--Button-->
			<div class="d-flex flex-column text-center h-25">
				<a href="captivity.php" class="btn btn-warning mx-4 rounded-0 shadow-sm my-2">Captivity</a>
				<a href="studbook.php" class="btn btn-warning mx-4 rounded-0 shadow-sm my-2">Wild</a>
		    </div>
		</div>

		<!--Col of Genomics-->
		<div class="col-lg-3 float-left text-justify shadow m-3 p-0 hover-effect">
			<!--Title-icon-->
			<div class="d-flex text-center flex-column py-5 h-25">
				<h4><i class="hover fas fas fa-microscope"></i></h4>
				<h3>Genomics</h3>
			</div>

			<!--Text-->
			<div class="d-flex flex-column p-4 h-50">
			    <p>Here you can have access to the whole genome of the species, their annotated genes, SNPs, karyotype, and other cytomolecular analyses. Please, contact the database manager to require login and password for specific permissions. <i class="fas fa-lock rounded-circle bg-light p-1"  tabindex="0"  data-toggle="popover" data-trigger="focus" data-container="body" data-placement="right" data-content="Please, contact the database manager to require login and password for permissions."></i></p>
			</div>

		    <!--Button-->
			<div class="d-flex flex-column text-center h-25">
				<a href="#" class="btn btn-warning mx-4 rounded-0 shadow-sm my-2 disabled">See More</a>
			</div>
		</div>

	</div>
</div>

<?php include 'footer.php'; ?>