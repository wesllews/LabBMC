<?php
session_start();
$_SESSION['pagina']='studbook';
include 'header.php';

// Select individual
$id = "TE73";
$sql= "SELECT identification,sex,individual.name as name,category, sire,dam FROM individual
		INNER JOIN category ON individual.id_category= category.id
		INNER JOIN kinship ON individual.identification=kinship.id_individual
		WHERE individual.identification='$id';";
$query = $mysqli->query($sql);
$row = $query->fetch_array();
?>

<div class="container-fluid  p-5">
	<h1><?php echo $row['identification']; ?></h1>
	<hr class="border border-warning mb-0">

	<?php if ($row['id_category']=='1'): ?>
		<?php $sql=" SELECT * FROM individual
		INNER JOIN category ON individual.id_category= category.id
		INNER JOIN kinship ON individual.identification=kinship.id_individual
		INNER JOIN historic ON individual.identification=historic.id_individual
	INNER JOIN genotype ON individual.identification=genotype.id_individual
    INNER JOIN historic ON individual.identification=historic.id_individual 
    INNER JOIN events ON historic.id_event=events.id
    INNER JOIN institute ON historic.id_institute=institute.id
   
                WHERE individual.identification='$id'"; ?>
		<div class="container-fluid bg-light">
			<table class="table table-bordered success">
				<thead>
					<tr >
						<th >Full Name</th>
						<td>Vikram</td>
					</tr>
				</thead>
			</table>
		</div>

		<dl class="row">
    <dt class="col-sm-3">User Agent</dt>
    <dd class="col-sm-9">An HTML user agent is any device that interprets HTML documents.</dd>
</dl>

	<?php elseif ($row['id_category']=='2'): ?>
		<div class="container-fluid bg-light">
		wild
		</div>
	<?php endif; ?>

</div>











<?php include 'footer.php'; ?>