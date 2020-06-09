<?php 
session_start();
$_SESSION['pagina']='captivity';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['historic','population','sex','sire','dam','name','alive','genetics'];

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

	// Sort and Order Table
	$column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
	$sort_order = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) == 'desc' ? 'DESC' : 'ASC';


/* Filtros GET*/
	
	// Pagination
	$limit = 20; // Default limit
	$pag = isset($_GET['pag']) ? $_GET['pag']:1;
	$limit = isset($_GET['limit'])? $_GET['limit']:$limit;
	$offset = $limit!="All" ? ($pag-1) * $limit : "";

	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

	// Captivity filters
	$sexFilter = isset($_GET['sexFilter'])? $_GET['sexFilter'] : "";
	$filterpopulation = isset($_GET['filterpopulation'])? $_GET['filterpopulation'] : "";
	$status = isset($_GET['status'])? $_GET['status'] : "";

	// Preview page
	$fulldata= isset($_GET['fulldata'])? $_GET['fulldata'] : "s";


/* Forms */
	$array =  array(
		    "column" => $column,
		    "sort_order" => $sort_order,
		    "pag" => $pag,
		    "limit" => $limit,
		    "sexFilter" => $sexFilter,
		    "status" => $status,
		    "filterpopulation" => $filterpopulation,
		    "fulldata" => $fulldata
		);


/* SQL Filtros */

	// Table order
	switch ($column) {
		case 'identification':
		case 'sire':
		case 'dam':
			$order = " ORDER BY CAST($column AS INT) $sort_order, individual.id $sort_order";
			break;

		case 'population':
			$order = " ORDER BY abbreviation $sort_order";
			break;

		case 'name':
			$order = " ORDER BY ISNULL(individual.name),individual.name $sort_order";
			break;
		
		default:
			$order = " ORDER BY $column $sort_order";
			break;
	}
	$limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";

	// Captivity filters
	$sexFilter = $sexFilter!=""? " AND sex='$_GET[sexFilter]'" : "";
	$status = $status!=""? " AND alive='$_GET[status]'" : "";
	$filterpopulation = $filterpopulation!=""? " AND id_institute=$_GET[filterpopulation]" : "";



$sql = "SELECT *,individual.id as id FROM `individual` LEFT JOIN status ON individual.id=status.id_individual LEFT JOIN kinship ON kinship.id_individual=individual.id LEFT JOIN institute ON institute.id=status.id_institute WHERE id_category=1";
$sql_pagination = $sql.$sexFilter.$status.$filterpopulation;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter); 
?>

<div class="text-warning m-4" style="white-space: nowrap;"><h1 class="ml-5">Captivity</h1><hr></div>

<!-- Filtro -->
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-warning filter px-3" data-toggle="modal" data-target="#filtro">
	  <i class="fas fa-filter"></i>
	</button>

	<!-- Modal -->
	<div class="modal fade" id="filtro" tabindex="-1" role="dialog" aria-labelledby="filtro" aria-hidden="true">
		<div class="modal-dialog modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Filter</h5>
					<button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<!-- FORM -->
				<div class="modal-body">
					<form id="formFiltro" action="captivity.php" method="get">

						<!--Iems per page-->
						<div class="form-group">
							<label>Items per page</label>

							<select name="limit" class=" form-control form-control-sm">
								<?php for ($i=20; $i <= 100; $i+=20):?>
									<option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php endfor; ?>
								<option <?php echo isset($_GET['limit']) && $_GET['limit']=="All" ? "selected":""; ?> value="All">All results</option>
							</select>
						</div>

						<!--Sex-->
						<div class="form-group">
							<label>Sex</label>

							<select name="sexFilter" class="form-control form-control-sm">
								<option <?php echo !isset($_GET['sexFilter']) ? "selected":"";?> value="" >Select...</option>
								<option <?php echo isset($_GET['sexFilter']) && $_GET['sexFilter']=="Female" ? "selected":""; ?> value="Female">Female</option>
								<option <?php echo isset($_GET['sexFilter']) && $_GET['sexFilter']=="Male" ? "selected":""; ?> value="Male">Male</option>
								<option <?php echo isset($_GET['sexFilter']) && $_GET['sexFilter']=="Unknown" ? "selected":""; ?> value="Unknown">Unknown</option>
							</select>
						</div>

						<!--Life Status-->
						<div class="form-group">
							<label>Life Status</label>

							<div class="form-check">
							  <input class="form-check-input" type="radio" name="status" id="statusAlive" value="1"  <?php echo isset($_GET["status"]) && $_GET["status"]=="1" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusAlive"> Alive</label>
							</div>

							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="status" id="statusDeath" value="0"  <?php echo isset($_GET["status"]) && $_GET["status"]=="0" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusDeath"> Death</label>
							</div>

						</div>

						<!--population-->
						<?php if($fulldata=='s'): ?>
							<div class="form-group">
								<label>Population</label>
								<select name="filterpopulation" class="form-control form-control-sm">
								  <option <?php echo !isset($_GET['filterpopulation']) ? "selected":""; ?> value="">Select...</option>
								  <?php 
								  $sql_institute = "SELECT * FROM institute";
								  $query = $mysqli->query($sql_institute);

								  while ($row = $query->fetch_array()):?>
								    <option <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row["id"] ? "selected":""; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["abbreviation"]," - ",$row["name"]; ?></option>
								  <?php endwhile; ?>
								</select>
							</div>
						<?php endif; ?>

						<!--Display informations-->
						<div class="form-group">
							<label>Display informations</label>

					        <div class="overflow-auto" style="max-height: 300px;">
					        	<?php foreach ($headersAdicionais as $value):?>
					        		<div class="custom-control custom-checkbox">
								 		<input type="checkbox" class="custom-control-input" id="<?php echo $value;?>" name="<?php echo $value;?>" value="s"  <?php echo isset($_GET[$value]) || $flag==0 ? "checked":""; ?>>
										<label class="custom-control-label" for="<?php echo $value;?>"><?php echo ucfirst(str_replace('_',' ',$value)); ?></label>
									</div>
						        <?php endforeach;?>
					        </div>
						</div>
					</form>
				</div>
				<!-- FORM -->

				<div class="modal-footer">
					<button type="submit" form="formFiltro" class="btn btn-warning">Submit</button>
					<a class="btn btn-warning" href="captivity.php" role="button">Clear All</a>
				</div>
			</div>
		</div>
	</div>


<!-- Forms Hiddens-->
<form method="get" action="" id="formFiltros">
	<?php foreach($array as $key => $value): ?>
		<?php if($value != ""):?>
		<input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>">
		<?php endif;?>
	<?php endforeach;?>
</form>

<!-- Pagination -->
<div class="container mt-4">
	<?php
	$result = $mysqli->query($sql_pagination);
	$total_rows =$result->num_rows;
	$total_pages = $limit!="All" ? ceil($total_rows / $limit) : 1;
	$NumLinks= 5;

	$start = (($pag-$NumLinks) > 0) ? ($pag - $NumLinks) : 1;
	$end = (($pag+$NumLinks) < $total_pages) ? ($pag + $NumLinks) : $total_pages;
	?>

	
		<ul class="pagination pagination-sm justify-content-center">
	    	<!--First page-->
	    	<li class="page-item <?php if($pag <= 1){ echo 'disabled'; } ?>">
	       		<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '1';" form="formFiltros" >First</button>
	    	</li>
	    	<!--Previous-->
	        <li class="page-item <?php if($pag <= 1){ echo 'disabled'; } ?>">
	       		<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo ($pag-1);?>';" form="formFiltros" >Prev</button> 
	        </li>
	        <!-- Numbers -->
			<?php for ( $i = $start ; $i <= $end; $i++ ): ?>
				<li class="page-item <?php if ($pag == $i){echo "active";} ?>">
					<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo $i;?>';" form="formFiltros" > <?php echo $i;?> </button>
				</li>  		
	  		<?php endfor; ?>
	        <!--Next-->
	        <li class="page-item <?php if($pag >= $total_pages){ echo 'disabled'; } ?>">
	        	<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo ($pag+1);?>';" form="formFiltros" >Next</button>
	        </li>
	        <!--Last-->
	    	<li class="page-item <?php if($pag >= $total_pages){ echo 'disabled'; } ?>">
	    		<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo $total_pages;?>';" form="formFiltros" >Last</button>
	    	</li>
	    </ul></div>

<!--Table-->
<div class="container-fluid">
	<!--Table Responsive-->
	<div class="table-responsive">
		<!--Table-->
    	<table class="table table-sm">

    		<!--Head Table-->
	    	<thead>
	    		<tr class="text-center">
    			<?php foreach ($header as $value): ?>
    				<th scope="col" style="white-space: nowrap;">
						<div class="d-flex justify-content-center align-items-end text-warning">
							<span class="text-warning"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>
							<!--Icon-->
							<?php if($value!='historic' && $value!='genetics'): ?>
								<button class="btn btn-link text-warning" type="submit" form="formFiltros" 
								onclick="document.getElementsByName('pag')[0].value = '1'; document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
									<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
								</button>
							<?php elseif($value=='historic'): ?>
								<i class="btn text-warning fas fa-chevron-up px-3" id="showAll" ></i>
    						<?php endif; ?>

						</div>
					</th>
				<?php endforeach ?>
	    		</tr>
	    	</thead>

	    	<!--Body Table -->
			<tbody>
			<?php while($row = $result_filter->fetch_array()):

				// Seleciona todos os dados dos indivíduos
				$sql = "SELECT * FROM `individual` LEFT JOIN kinship ON kinship.id_individual=individual.id
				WHERE id='$row[id]'";
				$result = $mysqli->query($sql); ?>

						<?php while($row = $result->fetch_array()): ?> 
					    	<tr class="text-center">
					    		<?php foreach ($header as $value): ?>
					    			<?php switch($value):

					    				case 'identification': ?>
    				    				<td scope="row">
    				    					<a class="btn btn-outline-success btn-block border-0" href="individual.php?identification=<?php echo $row[$value];?>"><?php echo $row[$value];?></a>
    				    				</td>
    				    				<?php break;?>

					    				<?php case "historic":
					    					$sql_historic = "SELECT *, institute.name as institute FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$row[id]'";
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
														
							    						<ul class="list-group collapse showAll" id="collapse<?php echo $row['identification'];?>">
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

					    				<?php case 'population': 
					    					$sql_population = "SELECT * FROM `status` 
					    					LEFT JOIN institute ON institute.id = status.id_institute
					    					 WHERE id_individual = '$row[id]'";
					    					$result_population = $mysqli->query($sql_population);

						    					if ($result_population->num_rows > 0): 
						    						$row_population = $result_population->fetch_array();?>
						    						<td scope="row">
						    							<?php echo $row_population['abbreviation']; ?>
						    						</td>
						    					<?php else: ?>
						    						<td scope="row">-</td>
						    					<?php endif; ?>
					    				<?php break;?>

					    				<?php case 'alive': 
					    					$sql_alive = "SELECT * FROM `status` 
					    					WHERE id_individual = '$row[id]'";
					    					$result_alive = $mysqli->query($sql_alive);

						    					if ($result_alive->num_rows > 0): 
						    						$row_alive = $result_alive->fetch_array();?>
						    						<td scope="row">
						    							<?php echo $row_alive['alive']==1 ? '<div class="text-success">True</div>':'<div class="text-danger">False</div>' ;?>
						    						</td>
						    					<?php else: ?>
						    						<td scope="row">-</td>
						    					<?php endif; ?>
					    				<?php break;?>

					    				<?php case 'genetics': 
					    					$sql_genetics = "SELECT * FROM genotype WHERE id_individual = '$row[id]'";
					    					$result_genetics = $mysqli->query($sql_genetics);

						    					if ($result_genetics->num_rows > 0): ?>
						    						<td scope="row">
						    						<button type="button" class="btn btn-success">Genetics</button>
						    						<button type="button" class="btn btn-dark">Genomic</button>
						    						<button type="button" class="btn btn-primary">Statistics</button>
						    						</td>
						    					<?php else: ?>
						    						<td scope="row">
						    						<button type="button" class="btn btn-secondary disabled">Genetics</button>
						    						<button type="button" class="btn btn-secondary disabled">Genomic</button>
						    						<button type="button" class="btn btn-secondary disabled">Statistics</button>
						    						</td>
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