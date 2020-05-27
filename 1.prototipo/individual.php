<?php
session_start();
$_SESSION['pagina']='studbook';
include 'header.php';

// Select individual
$identification = $_GET['identification'];
$sql= "SELECT * FROM individual  INNER JOIN category ON category.id=individual.id_category WHERE individual.identification='$identification';";
$query = $mysqli->query($sql);
$row_individual = $query->fetch_array();

$column=[];
if ($row_individual['id_category']==1) {
	$column=['alive','category','sex','name','population','institute','location','country','state','city'];
} else {
	$column=['alive','category','sex','name','population','institute','country','state','city'];
}


?>
<div class="container-fluid px-5 pt-5">
	<h1>Identification: <?php echo $identification; ?></h1>
	<div class="pt-1 bg-warning"></div>
</div>

<!-- Basic Information -->
<div class="container">
	<?php $sql= "SELECT * FROM status INNER JOIN institute ON institute.id=status.id_institute WHERE id_individual='$identification';";
	$query = $mysqli->query($sql);
	$row_status = $query->fetch_array(); ?>
	<div class="text-secondary font-weight-bolder mb-2 mt-4"> Basic Information</div>
	<table class="table table-sm table-borderless text-capitalize">
		<?php foreach ($column as $value): ?>
			<tr>
			<?php switch ($value): 

				case 'sex': ?>
				<?php case 'category': ?>
				<?php case 'name': ?>
					<th><?php echo $value; ?></th>
					<td><?php echo $row_individual[$value]!="" ?$row_individual[$value]:"<div class='text-muted'>No one</div>"; ?></td>
				<?php break; ?>

				<?php case 'alive': ?>
						<th><?php echo $value; ?></th>
						<td><?php echo $row_status[$value]==1 ? "<div class='text-success'>True</div>": "<div class='text-danger'>False</div>"; ?></td>
				<?php break;?>

				<?php case 'population': ?>
						<th><?php echo $value; ?></th>
						<td><?php echo $row_status['abbreviation']; ?></td>
				<?php break;?>

				<?php case 'institute': ?>
						<th><?php echo $value; ?></th>
						<td><?php echo $row_status['name']; ?></td>
				<?php break;?>

				<?php case 'location': ?>
						<th><?php echo $value; ?></th>
						<td>
							<?php echo $row_status['country']!="" ? $row_status['country']:""; ?>
							<?php echo $row_status['state']!="" ? ", state of ".$row_status['state']:""; ?>
							<?php echo $row_status['city']!="" ? ", city of ".$row_status['city']:""; ?>
						</td>
				<?php break;?>
			<?php endswitch; ?>
			</tr>
		<?php endforeach; ?>
	</table>
</div>


<!-- Historic -->
<div class="container">
	<?php $sql= "SELECT * FROM historic 
	INNER JOIN institute ON institute.id=historic.id_institute
	INNER JOIN events ON historic.id_event=events.id
	WHERE id_individual='$identification';";
	$query = $mysqli->query($sql); ?>
	<div class="text-secondary font-weight-bolder mb-2 mt-4"> Historic</div>
	<ul class="list-group list-group-flush ">
		<?php while($row_historic = $query->fetch_array()): ?>
			<li class="list-group-item pb-1">
				<div class="d-flex flex-wrap">
					<?php switch ($row_historic['id_event']):
						case 1:
						case 2: ?>
							<i class="fas fa-square text-success mr-3 my-auto"></i>
						<?php break; ?>

						<?php case 3: ?>
							<i class="fas fa-square text-warning mr-3 my-auto"></i>
						<?php break; ?>

						<?php case 4: ?>
							<i class="fas fa-square text-secondary mr-3 my-auto"></i>
						<?php break; ?>

						<?php case 5: ?>
							<i class="fas fa-square text-danger mr-3 my-auto"></i>
						<?php break; ?>

						<?php case 6: ?>
							<i class="fas fa-square text-primary mr-3 my-auto"></i>
						<?php break; ?><?php endswitch; ?>
					<h5 class="my-0"><?php echo $row_historic['events'];?></h5>
					<p class="ml-auto my-0"><?php echo date_format(date_create($row_historic['date']), 'F j, Y');?></p> 
				</div>
				<p class="my-1 font-italic"><?php echo $row_historic['observation']!="" ? "Observation: ".$row_historic['observation']:"";?></p> 
				<p class="my-1"><?php echo $row_historic['name'];?></p> 
				<p class="my-1">Local ID: <?php echo $row_historic['local_id']!="" ? $row_historic['local_id']:"<span class='text-muted'>No one</span>";?></p> 
				
			</li>
		<?php endwhile; ?>
		<li class="list-group-item"></li>
	</ul>
</div>


<!-- Genetics -->
<?php $sql= "SELECT distinct(id_locus) as id_locus FROM genotype WHERE id_individual='$identification';";
	$query = $mysqli->query($sql);
	$num_rows =$query->num_rows;?>
	<?php if($num_rows>0): ?>
		<div class="container">

			<div class="text-secondary font-weight-bolder mb-2 mt-4"> Genotypes and Alleles</div>
			<table class="table table-sm text-center text-capitalize">
				<thead class="thead-dark">
					<tr>
						<th class="px-5">Locus</th>
						<th class="px-5">Alleles</th>
					</tr>
				</thead>

				<?php while($row_locus = $query->fetch_array()):
					$sql_allele= "SELECT * FROM genotype WHERE id_individual='$identification' AND id_locus='$row_locus[id_locus]';";
					$query_allele = $mysqli->query($sql_allele);
					$num_rows =$query_allele->num_rows;

					if($num_rows==2):?>
						<tr>
							<th class="px-5"><?php echo $row_locus['id_locus']; ?></th>
							<td class="px-5"> <?php while ($row_allele = $query_allele->fetch_array()) { echo $row_allele['allele']." ";} ?></td>
						</tr>
					<?php endif; ?>
				<?php endwhile; ?>
			</table>
		</div>
	<?php endif; ?>





<?php include 'footer.php'; ?>