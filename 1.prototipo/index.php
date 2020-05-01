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
			<a class="text-decoration-none text-dark" href="#genotype">
				<!--Title-icon-->
				<div class="d-flex text-center flex-column py-5 h-25">
					<i class="fas fa-dna"></i>
					<h3>Genetics</h3>
				</div>

				<!--Text-->
				<div class="d-flex flex-column p-4 h-50">
				    <p>Here you can have access to statistical parameters; genotypes and alleles for neutral loci; and also DNA sequences and haplotypes from mitochondrial regions obtained for wild and captive populations of BLT.</p> 
				    <small>Please, contact the database manager to require login and password for permissions.</small>

				</div>

				<!--Button-->
				<div class="d-flex flex-column h-25 ">
					<div class="mt-auto ">
						<a href="#genotype" type="button" class="btn btn-dark rounded-0 w-100">
		    			<i class="fas fa-chevron-right"></i></a>
					</div>
			    </div>
			</a>
		</div>

		<!--Col of Studbook-->
		<div class="col-lg-3 float-left text-center shadow m-3 p-0">
				<!--Title-icon-->
				<div class="d-flex flex-column py-5 h-25 icon">
					<i class="fab fa-pagelines"></i>
					<h3>Life History</h3>
				</div>

				<!--Text-->
				<div class="d-flex flex-column p-4 h-50">
				    <p>Here you can find information about population occurrence, diet, reproduction, social behavior, genealogy, management, etc. for wild and captive populations of BLT.</p>
				</div>

				<!--Button-->
				<div class="d-flex flex-column text-center h-25">
					<a href="studbook.php" type="button" class="text-decoration-none text-dark hover-effect p-3 ">
	    			<i class="fas fa-chevron-right"></i> Captivity </a>
					<a href="#wild" type="button" class="text-decoration-none text-dark hover-effect p-3">
	    			<i class="fas fa-chevron-right"></i> Wild</a>
			    </div>
		</div>

		<!--Col of Genomics-->
		<div class="col-lg-3 float-left text-center shadow m-3 p-0 hover-effect">
			<a class="text-decoration-none text-dark" >
				<!--Title-icon-->
				<div class="d-flex flex-column py-5 h-25">
					<i class="fas fa-book-open"></i>
					<h3>Genomics</h3>
				</div>

				<!--Text-->
				<div class="d-flex flex-column p-4 h-50">
				    <p>Here you can have access to the whole genome of the species, their annotated genes, SNPs, karyotype, and other cytomolecular analyses. Please, contact the database manager to require login and password for specific permissions.</p>
				</div>

				<!--Button-->
				<div class="d-flex flex-column h-25 ">
					<div class="mt-auto ">
						<a href="?studbook" type="button" class="btn btn-dark rounded-0 w-100">
		    			<i class="fas fa-chevron-right"></i></a>
					</div>
			    </div>
			</a>
		</div>

	</div>
</div>

<?php include 'footer.php'; ?>