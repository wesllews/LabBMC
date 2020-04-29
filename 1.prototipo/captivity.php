<?php 
session_start();
$_SESSION['pagina']='captivity';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['genetics','historic','sex','sire','dam','name'];

	// Testa se algum 'Display informations' foi enviado
	$flag = 0;
	foreach ($headersAdicionais as $value) {
		if(isset($_GET[$value])){
		$flag=1;
		}
	}
	// Se for, adiciona só os enviados
	if ($flag ==1):
		foreach ($headersAdicionais as $value) {
			if(isset($_GET[$value])){
				array_push($header, $value);
			}
		}
		else:
			foreach ($headersAdicionais as $value) {
				array_push($header, $value);
			}
		endif;


/* Filtros GET*/
	
	// Table_Head
	$column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
	$sort_order = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) == 'desc' ? 'DESC' : 'ASC';

	// Pagination
	$limit = 20; // Default limit
	$pag = isset($_GET['pag']) ? $_GET['pag']:1;
	$limit = isset($_GET['limit'])? $_GET['limit']:$limit;
	$offset = ($pag-1) * $limit;

	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';



/* SQL Filtros */

	// Table order
	$limit_sql = " LIMIT $offset,$limit";
	$order = " ORDER BY $column $sort_order"; #ORDER BY CAST(identification AS INT)

/* Forms */
	$array =  array(
		    "column" => $column,
		    "sort_order" => $sort_order,
		    "pag" => $pag,
		    "limit" => $limit,
		    "offset" => $offset
		);

$sql_filter = "SELECT DISTINCT(identification),individual.name as name FROM `individual` INNER JOIN historic ON individual.identification=historic.id_individual INNER JOIN events ON historic.id_event=events.id INNER JOIN institute ON historic.id_institute=institute.id INNER JOIN kinship ON kinship.id_individual=individual.identification WHERE id_category=1";
$sql_filter = $sql_filter.$order.$limit_sql;

$result_filter = $mysqli->query($sql_filter);
?>
<!--Button-->
<div class="container-fluid">
  <div class="col-1 bg-warning text-white  text-center p-3 girar" data-toggle="collapse" data-target="#filtro">
    <i class="fas fa-filter"></i><i class="fas fa-chevron-up " id="girar"></i>
  </div>
</div>

<!--Filtro Form-->
<div class="container-fluid collapse mb-1" id="filtro">
	
	<form class="bg-light rounded-bottom p-3" action="captivity.php" method="get" target="_top">

		<!--Iems per page-->
		<div class="form-group">
			<label>Items per page</label>

			<select name="limit" class=" form-control form-control-sm">
				<?php for ($i=20; $i <= 200; $i+=20):?>
					<option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor; ?>
				<option <?php echo isset($_GET['limit']) && $_GET['limit']=="All" ? "selected":""; ?> value="All">All results</option>
			</select>
		</div>

		<!--Birth in -->
		<div class="form-group">
			Birth in:
			<div class="row">
				<div class="col">
					<small>Date Start</small>
					<input class="datapicker form-control form-control-sm" type="date" name="startBirth" value="<?php echo $array['startDate']; ?>">
				</div>

				<div class="col">
					<small>Date End</small>
					<input class="datapicker form-control form-control-sm" type="date" name="endBirth" value="<?php echo $array['endDate']; ?>" >
				</div>
			</div>
		</div>

		<!--Death in -->
		<div class="form-group">
			Death in:
			<div class="row">
				<div class="col">
					<small>Date Start</small>
					<input class="datapicker form-control form-control-sm" type="date" name="startDeath" value="<?php echo $array['startDate']; ?>">
				</div>

				<div class="col">
					<small>Date End</small>
					<input class="datapicker form-control form-control-sm" type="date" name="endDeath" value="<?php echo $array['endDate']; ?>" >
				</div>
			</div>
		</div>

		<!--Sex-->
		<div class="form-group">
			<label>Sex</label>

			<select name="sex" class="form-control form-control-sm">
				<option <?php echo !isset($_GET['sex']) ? "selected":"";?> value="" >Select...</option>
				<option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Female" ? "selected":""; ?> value="Female">Female</option>
				<option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Male" ? "selected":""; ?> value="Male">Male</option>
				<option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Unknown" ? "selected":""; ?> value="Unknown">Unknown</option>
			</select>
		</div>

		<!--Institute-->
		<div class="form-group">
	        <label>Institutes</label>

	        <select name="idInstitute" class="form-control form-control-sm">
	          <option <?php echo !isset($_GET['institute']) ? "selected":""; ?> value="">Select...</option>
	          <?php 
	          $sql_institute = "SELECT * FROM institute";
	          $query = $mysqli->query($sql_institute);

	          while ($row = $query->fetch_array()):?>
	            <option <?php echo isset($_GET['institute']) && $_GET['institute']==$row["id"] ? "selected":""; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
	          <?php endwhile; ?>
	        </select>
		</div>

		<div class="form-group">
			<label>Display informations</label>

	        <div class="overflow-auto" style="max-height: 300px;">
	        	<?php foreach ($headersAdicionais as $value):?>
	        		<div class="custom-control custom-checkbox">
				 		<input type="checkbox" class="custom-control-input" id="<?php echo $value;?>" name="<?php echo $value;?>" value="s"  <?php echo isset($_GET[$value]) ? "checked":""; ?>>
						<label class="custom-control-label" for="<?php echo $value;?>"><?php echo ucfirst(str_replace('_',' ',$value)); ?></label>
					</div>
		        <?php endforeach;?>
	        </div>
		</div>



		<button type="submit" class="btn btn-warning">Submit</button>

		<a class="btn btn-warning" href="captivity.php" role="button">Clear All</a>

	</form>
</div>

<!-- Forms Hiddens-->
<form method="get" action="" id="formFiltros">
	<?php foreach($array as $key => $value): ?>
		<?php if($value != ""):?>
		<input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>">
		<?php endif;?>
	<?php endforeach;?>
</form>


<!--Table-->
<div class="container-fluid">
	<!--Table Responsive-->
	<div class="table-responsive">
		<!--Table-->
    	<table class="table ">

    		<!--Head Table-->
	    	<thead>
	    		<tr class="text-center">
	    			<?php foreach ($header as $value): ?>
	    				<th scope="col">
							<div class="d-flex justify-content-center text-warning">
								<span class="text-warning mt-auto"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>
								<?php if($value!='historic' && $value!='genetics'): ?>
									<button class="btn btn-link text-warning" type="submit" form="formFiltros" 
									onclick="document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
										<i class="fas fa-sort<?php echo $array['column'] == $value ? '-'.$up_or_down : ''; ?>"></i>
									</button>
	    						<?php endif; ?>
								
							</div>
						</th>
					<?php endforeach ?>
	    		</tr>
	    	</thead>

	    	<!--Body Table -->
			<tbody>
			<?php while($row = $result_filter->fetch_array()):

				// Seleciona todos os Headers dos indivíduos
				$sql = "SELECT identification, sex, sire, dam, individual.name as name 
				FROM `individual` INNER JOIN kinship ON kinship.id_individual=individual.identification 
				WHERE identification='$row[identification]'";
				$sql = $sql.$order.$limit_sql;
				$result = $mysqli->query($sql); ?>

						<?php while($row = $result->fetch_array()): ?> 
					    	<tr class="text-center">
					    		<?php foreach ($header as $value): ?>
					    			<?php switch($value):

					    				case "historic":
					    					$sql_historic = "SELECT *, institute.name as institute FROM historic INNER JOIN events ON historic.id_event=events.id INNER JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$row[identification]'";
					    					$result_historic = $mysqli->query($sql_historic);
					    					$num = $result_historic->num_rows ?>

					    					<td scope="row">
						    					<?php if ($num>=1): ?>
						    						<div class="card">
														<div class="btn btn-light" onclick="girar('girar<?php echo $row['identification'];?>')" data-toggle="collapse" data-target="#collapse<?php echo $row['identification'];?>">
															Historic
															<div class="badge badge-dark"><?php echo $num;?></div>
															<i class="fas fa-chevron-up ml-3" id="girar<?php echo $row['identification'];?>"></i>
														</div>
														
							    						<ul class="list-group collapse" id="collapse<?php echo $row['identification'];?>">
							    							<?php while ($row_historic = $result_historic->fetch_array()): ?>
							    								<li class="list-group-item">
							    									<?php echo $row_historic['events'],":" ?>
							    									<div class="text-warning"><?php echo $row_historic['date'] ?></div>
							    									<?php echo $row_historic['institute']?>
							    									<div class="text-secondary"><?php echo $row_historic['observation']?></div>
							    									
							    								</li>
							    							<?php endwhile; ?>
							    						</ul>
						    						</div>				    						
						    					<?php else: ?>
						    						-
						    					<?php endif; ?>
						    				</td>
					    				<?php break;?>


					    				<?php case 'genetics': 
					    					$sql_genetics = "SELECT * FROM genotype WHERE id_individual = '$row[identification]'";
					    					$result_genetics = $mysqli->query($sql_genetics);

						    					if ($result_genetics->num_rows > 0): ?>
						    						<td scope="row">Genotypes</td>
						    					<?php else: ?>
						    						<td scope="row">-</td>
						    					<?php endif; ?>
					    				<?php break;?>
					    				

					    				<?php default: ?>
					    				<td scope="row"> <?php echo $row[$value];?> </td>
					    				
					    			<?php endswitch; ?>


					    			
					    		<?php endforeach; ?>
					    	</tr>
				    	<?php endwhile; ?>

			<?php endwhile; ?>


			</tbody>
			
    	</table>
	</div>
</div>

<?php include 'footer.php'; ?>