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
			<p>Counting with a collection of data about the life and genetic of Blacks Lions Tamarins, <i>Leontopithecus chrysopygus</i>. Our database was developed to allow to researchers have acess to this data. The resource are been producing and compiled by the LabBMC in São Carlos.</p>
		</div>
	</div>


	<!--Row of Tools-->
	<div class="row justify-content-center" id="tools">

		<!--Col of Genotypes-->
		<div class="col-lg-3 float-left text-center shadow m-3 p-0 hover-effect">
			<a class="text-decoration-none text-dark" href="#genotype">
				<!--Title-icon-->
				<div class="d-flex flex-column py-5 h-25">
					<i class="fas fa-dna"></i>
					<h3>Genotypes</h3>
				</div>

				<!--Text-->
				<div class="d-flex flex-column p-4 h-50">
				    <p>The genotype is the part of the genetic makeup of a cell, and therefore of any individual, which determines one of its characteristics (phenotype).</p>
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

		<!--Col of Wild-->
		<div class="col-lg-3 float-left text-center shadow m-3 p-0 hover-effect">
			<a class="text-decoration-none text-dark" href="#wild">
				<!--Title-icon-->
				<div class="d-flex flex-column py-5 h-25 icon">
					<i class="fab fa-pagelines"></i>
					<h3>Wild</h3>
				</div>

				<!--Text-->
				<div class="d-flex flex-column p-4 h-50">
				    <p>We are analyzing genetic diversity in captive individuals of the endangered black lion tamarin, Leontopithecus chrysopygus, and also comparing genetic diversity parameters between wild populations.</p>
				</div>

				<!--Button-->
				<div class="d-flex flex-column h-25 ">
					<div class="mt-auto ">
						<a href="#wild" type="button" class="btn btn-dark rounded-0 w-100">
		    			<i class="fas fa-chevron-right"></i></a>
					</div>
			    </div>
			</a>
		</div>

		<!--Col of StudBook-->
		<div class="col-lg-3 float-left text-center shadow m-3 p-0 hover-effect">
			<a class="text-decoration-none text-dark" href="?pagina=studbook">
				<!--Title-icon-->
				<div class="d-flex flex-column py-5 h-25">
					<i class="fas fa-book-open"></i>
					<h3>Stud Book</h3>
				</div>

				<!--Text-->
				<div class="d-flex flex-column p-4 h-50">
				    <p>See the genealogy and historic of the captives individuals over time.</p>
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