<?php
session_start();
$_SESSION['pagina']='studbook';
include 'header.php';

// Select individual
$identification = $_GET['identification'];
$sql= "SELECT *, 
individual.id as id, 
individual.name as name, 
institute.name as institute,
institute.abbreviation as Abbreviation,
institute.country as Country,
institute.state as State,
institute.city as City,
latitude_ind as `latitude individual`,
longitude_ind as `longitude individual`,
CASE
    WHEN alive = 1 THEN 'True'
    WHEN alive = 0 THEN 'False'
    ELSE 'Unknown'
	END AS alive
FROM `individual`
INNER JOIN category ON individual.id_category=category.id
INNER JOIN status ON individual.id=status.id_individual
LEFT JOIN institute ON status.id_institute=institute.id
LEFT JOIN fragment ON status.id_fragment=fragment.id
LEFT JOIN ind_group ON individual.id=ind_group.id_individual
LEFT JOIN `group` ON `group`.id=ind_group.id_group
WHERE identification='$identification'";
$query = $mysqli->query($sql);
$row_individual = $query->fetch_array();
$id_individual = $row_individual['id'];
?>
<!-- ERROR 404 -->
<?php if(($query->num_rows)==0): ?>
	<div class="row bg-light m-5 p-5" role="alert">
		<h1>
			<p class=" display-1 letra2 text-warning"> OOPS!</p>
			<p class="letra1">Page Not Found</p>
		</h1>
	</div>
	<!-- Exit-->
	<?php include 'footer.php';	exit(); ?>
<?php endif; ?>

<div class="container-fluid px-5 pt-5">
	<h1>Identification: <?php echo $row_individual['identification']; ?></h1>
	<div class="pt-1 bg-warning"></div>
</div>

<!-- Basic Information -->
<div class="container mb-5">
	<h5 class="text-secondary mb-2 mt-4"> Basic Information</h5>
	
	<?php $column=['alive','category','sex','name','population','group']; ?>

	<?php foreach ($column as $value): ?>
		<?php switch ($value): 

			case 'alive': ?>
				<div class="row text-capitalize">
					<div class="col-3 mb-1"> <?php echo $value; ?></div>
					<div class="col-9">
						<?php if($row_individual['alive']=="True"):?>
	    					<div class="text-success">True</div>
	    				<?php elseif($row_individual['alive']=="False"): ?>
	    					<div class="text-danger">False</div>
	    				<?php else: ?>
	    					<div >Unknown</div>
	    				<?php endif; ?>
	    			</div>
				</div>
			<?php break;?>

			<?php case 'population': ?>
				<div class="row text-capitalize text-secondary mt-3">
				 	<div class="col"> <?php echo $value; ?></div>
				</div>
				<?php if($row_individual['id_category']==1): ?>
					<?php foreach (['Abbreviation','institute','Country','State','City'] as $value): ?>
						<div class="row text-capitalize">
							<div class="col-3 mb-1"><?php echo $value; ?></div>
							<div class="col-9"><?php echo $row_individual[$value]!="" ?$row_individual[$value]:"<div class='text-muted'>Not informed</div>"; ?></div>
						</div>	
					<?php endforeach; ?>
				<?php else: ?>
					<?php foreach (['abbreviation','fragment','country','state','city'] as $value): ?>
						<div class="row text-capitalize">
							<div class="col-3 mb-1"><?php echo $value; ?></div>
							<div class="col-9"><?php echo $row_individual[$value]!="" ?$row_individual[$value]:"<div class='text-muted'>Not informed</div>"; ?></div>
						</div>	
					<?php endforeach; ?>
				<?php endif; ?>
			<?php break; ?>

			<?php case 'group': ?>
				<?php if($row_individual['id_category']==2): ?>
					<div class="row text-capitalize text-secondary mt-3">
					 	<div class="col"> <?php echo $value; ?></div>
					</div>
					<?php foreach (['group', 'latitude', 'longitude', 'latitude individual', 'longitude individual'] as $value): ?>
						<div class="row text-capitalize">
							<div class="col-3 mb-1"><?php echo $value; ?></div>
							<div class="col-9"><?php echo $row_individual[$value]!="" ?$row_individual[$value]:"<div class='text-muted'>Not informed</div>"; ?></div>
						</div>	
					<?php endforeach; ?>
				<?php endif; ?>
			<?php break; ?>

			<?php default: ?>
				<div class="row text-capitalize">
					<div class="col-3 mb-1"> <?php echo $value; ?></div>
					<div class="col-9"><?php echo $row_individual[$value]!="" ?$row_individual[$value]:"<div class='text-muted'>Not informed</div>"; ?></div>
				</div>
		<?php endswitch; ?>
	<?php endforeach; ?>
</div>


<!-- Historic -->
<div class="container">
	<?php $sql= "SELECT * FROM historic 
	INNER JOIN institute ON institute.id=historic.id_institute
	INNER JOIN events ON historic.id_event=events.id
	WHERE id_individual='$id_individual';";
	$query = $mysqli->query($sql); ?>
	<?php if(($query->num_rows)>0): ?>
		<h5 class="text-secondary mb-2 mt-4"> Historic</h5>
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
	<?php endif; ?>
</div>


<!-- Genetics -->
<?php $sql_genetics= "SELECT distinct(id_locus) as id_locus FROM genotype WHERE id_individual='$id_individual';";
$query_genetics = $mysqli->query($sql_genetics);
$num_rows =$query_genetics->num_rows;?>
<?php if($num_rows>0): ?>
	<div class="container mb-5">

		<h5 class="text-secondary mb-2 mt-4"> Genotypes and Alleles</h5>

		<div class="mt-3 grid-genetics">
			<?php while($row_locus = $query_genetics->fetch_array()):
				$sql_allele= "SELECT * FROM genotype INNER JOIN locus ON locus.id=genotype.id_locus WHERE id_individual='$id_individual' AND id_locus='$row_locus[id_locus]';";
				$query_allele = $mysqli->query($sql_allele);
				$num_rows =$query_allele->num_rows;

				if($num_rows==2):
					$row_allele = $query_allele->fetch_array();
					$flag=0?>

					<div class="m-3 border-bottom">
						<span class="float-left font-weight-bold"><?php echo $row_allele['locus']; ?></span>
						<span class="float-right text-secondary"><?php while ($flag<2) { echo $row_allele['allele']." "; $flag+=1;} ?></span>			
					</div>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<?php include 'footer.php'; ?>