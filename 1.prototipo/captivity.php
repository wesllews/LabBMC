<?php 
session_start();
$_SESSION['pagina']='captivity';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['historic','population','sex','sire','dam','name','alive','informations'];

	// Testa se algum 'Display informations' foi enviado
	$flag = 0;
	foreach ($headersAdicionais as $value) {
		if(isset($_GET[$value])){
		$flag=1;
		}
	}
	// Se pelo menos um for enviado, adiciona só os enviados
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

if(in_array("delete",$_SESSION['permission'])){
	array_push($header, "manager");
}


/* Filtros GET*/
	
	// Pagination
	$limit = 20; // Default limit
	$pag = isset($_GET['pag']) ? $_GET['pag']:1;
	$limit = isset($_GET['limit'])? $_GET['limit']:$limit;
	$offset = $limit!="All" ? ($pag-1) * $limit : "";

	// Sort and Order Table
	$column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
	$sort_order = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) == 'desc' ? 'DESC' : 'ASC';

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


/* SQL Filtros e order*/

	// Table order
	switch ($column) {
		case 'identification':
		case 'sire':
		case 'dam':
			$order = " ORDER BY CONVERT($column, SIGNED) $sort_order, identification $sort_order, individual.id $sort_order";
			break;

		case 'population':
			$order = " ORDER BY abbreviation $sort_order, CONVERT(identification, SIGNED) $sort_order, individual.id $sort_order";
			break;

		case 'name':
			$order = " ORDER BY ISNULL(individual.name),individual.name $sort_order, CONVERT(identification, SIGNED) $sort_order, individual.id $sort_order";
			break;
		
		default:
			$order = " ORDER BY $column $sort_order, CONVERT(identification, SIGNED) $sort_order, individual.id $sort_order";
			break;
	}

	// Captivity filters
	$limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";
	$sexFilter = $sexFilter!=""? " AND sex='$_GET[sexFilter]'" : "";
	$status = $status!=""? " AND alive='$_GET[status]'" : "";
	$filterpopulation = $filterpopulation!=""? " AND id_institute=$_GET[filterpopulation]" : "";

$sql = "SELECT *,individual.id as id, individual.name as name FROM `individual` LEFT JOIN status ON individual.id=status.id_individual LEFT JOIN kinship ON kinship.id_individual=individual.id LEFT JOIN institute ON status.id_institute=institute.id WHERE id_category=1";
$sql_pagination = $sql.$sexFilter.$status.$filterpopulation;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);

/* Evita excesso de modal*/
$institute_population = [];

/* Ids dos individuos para download*/
$download_ids = [];
?>

<!-- Header page -->
<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Captivity</h3><hr></div>

<!-- Filtro -->
	<!-- Button trigger modal -->
	<div class="filter">
		<?php if(in_array("download",$_SESSION['permission'])):?>
			<div class="mb-2"><button type="submit" form="formDownload" class="btn btn-sm btn-success btn-block">Download</button></div>
		<?php endif; ?>
		<div class="mb-2">
			<button type="button" class="btn btn-sm btn-warning text-white px-3" data-toggle="modal" data-target="#filtro">
				Filter <i class="fas fa-filter"></i>
			</button>
		</div>
	</div>
	

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
								<option <?php echo !isset($_GET['sexFilter']) ? "selected":"";?> value="" >All</option>
								<option <?php echo isset($_GET['sexFilter']) && $_GET['sexFilter']=="Female" ? "selected":""; ?> value="Female">Female</option>
								<option <?php echo isset($_GET['sexFilter']) && $_GET['sexFilter']=="Male" ? "selected":""; ?> value="Male">Male</option>
								<option <?php echo isset($_GET['sexFilter']) && $_GET['sexFilter']=="Unknown" ? "selected":""; ?> value="Unknown">Unknown</option>
							</select>
						</div>

						<!--Life Status-->
						<div class="form-group">
							<label>Life Status</label>
							<br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="status" id="statusAlive" value="1"  <?php echo isset($_GET["status"]) && $_GET["status"]=="1" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusAlive"> Alive</label>
							</div>

							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="status" id="statusDeath" value="0"  <?php echo isset($_GET["status"]) && $_GET["status"]=="0" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusDeath"> Death</label>
							</div>
						</div>

						<!--population-->
							<div class="form-group">
								<label>Population</label>
								<select name="filterpopulation" class="form-control form-control-sm" <?php echo $fulldata=='s' ? "":"disabled"; ?>>
								  <option <?php echo !isset($_GET['filterpopulation']) ? "selected":""; ?> value="">All</option>
								  <?php 
								  $sql_institute = "SELECT * FROM institute";
								  $query = $mysqli->query($sql_institute);

								  while ($row = $query->fetch_array()):?>
								    <option <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row["id"] ? "selected":""; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["abbreviation"]," - ",$row["name"]; ?></option>
								  <?php endwhile; ?>
								</select>
							</div>
						
						<!--Display informations-->
						<div class="form-group">
							<label>Display informations</label>
					        <div class="overflow-auto" style="max-height: 150px;">
					        	<?php foreach ($headersAdicionais as $value):?>
					        		<div class="custom-control custom-checkbox">
								 		<input type="checkbox" class="custom-control-input" id="<?php echo $value;?>" name="<?php echo $value;?>" value="s"  <?php echo isset($_GET[$value]) || $flag==0 ? "checked":""; ?>>
										<label class="custom-control-label" for="<?php echo $value;?>"><?php echo ucfirst(str_replace('_',' ',$value)); ?></label>
									</div>
						        <?php endforeach;?>
					        </div>
						</div>

						<!--Hidden informations-->
						<?php if($fulldata!='s'): ?>
							<input type="hidden" name="fulldata" value="n">
							<input type="hidden" name="filterpopulation" value="<?php echo $_GET['filterpopulation'];?>">
						<?php endif; ?>
					</form>
				</div>
				<!-- FORM -->

				<div class="modal-footer">
					<button type="submit" form="formFiltro" class="btn btn-sm btn-warning">Submit</button>

					<form id="formClear" action="captivity.php" method="get">
						<input type="hidden" name="fulldata" value="<?php echo $fulldata;?>">
						<?php if($fulldata!='s'): ?>
							<input type="hidden" name="filterpopulation" value="<?php echo $_GET['filterpopulation'];?>">
						<?php endif; ?>
						<button type="submit" form="formClear" class="btn btn-sm btn-warning">Clear</button>
					</form>
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
		<?php foreach ($header as $value):?>
			<?php if($value != ""):?>
			<input type="hidden" name="<?php echo $value;?>" value="s">
			<?php endif;?>
		<?php endforeach;?>
	</form>

<!-- Pagination -->
<?php include 'pagination.php'; ?>

<!--Table-->
<div class="container-fluid">
	<!--Table Responsive-->
	<div class="table-responsive" style="min-height: 270px;">
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
							<?php if(!in_array($value,["historic","informations","manager"])): ?>
								<button class="btn btn-sm btn-link text-warning" type="submit" form="formFiltros" 
								onclick="document.getElementsByName('pag')[0].value = '1'; document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
									<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
								</button>
							<?php elseif($value=='historic'): ?>
								<i class="btn btn-sm text-warning fas fa-chevron-up px-3" id="showAll" ></i>
    						<?php endif; ?>

						</div>
					</th>
				<?php endforeach ?>
	    		</tr>
	    	</thead>

	    	<!--Body Table -->
			<tbody>
			<?php while($row = $result_filter->fetch_array()): ?>
		    	<tr class="text-center" scope="row">
		    		<?php foreach ($header as $value): ?>
		    			<td scope="col">
		    			<?php switch($value):

		    				case 'identification': ?>
		    					<?php array_push($download_ids,$row["id"]); ?>
			    					<a class="btn btn-sm btn-outline-success btn-block border-0" href="individual.php?identification=<?php echo $row[$value];?>"><?php echo $row[$value];?></a>
		    					<?php break;?>

		    				<?php case "historic":
		    					$sql_historic = "SELECT *, institute.name as institute FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$row[id]' ORDER BY date ASC;";
		    					$result_historic = $mysqli->query($sql_historic);
		    					$num = $result_historic->num_rows ?>

			    					<?php if ($num>=1): ?>
			    						<div class="card">
											<div class="btn btn-sm btn-light" onclick="girar('girar<?php echo $row['identification'];?>')" data-toggle="collapse" data-target="#collapse<?php echo $row['identification'];?>">
												Historic
												<div class="badge badge-dark"><?php echo $num;?></div>
												<i class="fas fa-chevron-up ml-3" id="girar<?php echo $row['identification'];?>"></i>
											</div>
											
				    						<ul class="list-group collapse showAll" id="collapse<?php echo $row['identification'];?>">
				    							<?php while ($row_historic = $result_historic->fetch_array()): ?>
				    								<li class="list-group-item">
				    									<?php echo $row_historic['events'],":" ?>
				    									<div class="text-warning"><?php echo date("d-m-Y", strtotime($row_historic['date'])); ?></div>
				    									<?php echo $row_historic['institute']?>
				    									<div class="text-secondary"><?php echo $row_historic['observation'];?></div>
				    									
				    								</li>
				    							<?php endwhile; ?>
				    						</ul>
			    						</div>				    						
			    					<?php else: ?>
			    						-
			    					<?php endif; ?>
		    					<?php break;?>

		    				<?php case 'population':					
		    					$sql_population = "SELECT * FROM institute WHERE id = '$row[id_institute]';";
		    					$result_population = $mysqli->query($sql_population);

		    					if ($result_population->num_rows > 0): 
		    						$row_population = $result_population->fetch_array();?>
		    							<!-- Trigger Modal -->
		    							<button type="button" class="btn btn-sm btn-outline-primary btn-block border-0" data-toggle="modal" data-target="#institute<?php echo $row['id_institute']; ?>" style="white-space: nowrap;">
		    							  <?php echo $row_population['abbreviation']; ?>
		    							</button>
		    							
		    							<!-- Modal -->
		    							<?php if(!in_array($row['id_institute'], $institute_population)):
		    								array_push($institute_population, $row['id_institute']);?>
		    								
											<div class="modal fade" id="institute<?php echo $row['id_institute']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" >Population</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<table class="table table-sm table-borderless text-left text-capitalize">
																<tbody>
																	<tr>
																		<th>name</th>
																		<td><?php echo $row_population['name']; ?></td>
																	</tr>
																	<tr>
																		<th>Abbreviation</th>
																		<td><?php echo $row_population['abbreviation']; ?></td>
																	</tr>
																	<tr>
																		<th>country</th>
																		<td><?php echo $row_population['country']; ?></td>
																	</tr>
																	<tr>
																		<th>state</th>
																		<td><?php echo $row_population['state']; ?></td>
																	</tr>
																	<tr>
																		<th>city</th>
																		<td><?php echo $row_population['city']; ?></td>
																	</tr>
																	
																	<?php if(in_array("edit",$_SESSION['permission'])):?>
																		<tr>
																			<th></th>
																			<td>
																				<form action="institute_insert.php" method="GET" id="editPopulation<?php echo $row_population['id'];?>" target="_blank">
																					<input type="hidden" name="id" value="<?php echo $row_population['id'];?>">
																					<input type="hidden" name="action" value="edit">

																				</form>
																				<button type="submit" form="editPopulation<?php echo $row_population['id'];?>" class="btn btn-primary float-right"><i class="fas fa-edit"></i></button>
																			</td>
																		</tr>
																	<?php endif; ?>
																</tbody>
															</table>
														</div>
														<div class="modal-footer">
															<form action="captivity.php" method="get">
																<input type="hidden" name="filterpopulation" value="<?php echo $row_population['id'];?>">
																<input type="hidden" name="fulldata" value="s">
																<button type="submit" class="btn btn-sm btn-warning" <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row_population['id'] ? "disabled ":""; ?>>Filter by this population</button>
															</form>
															<button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
		    							<?php endif; ?>
		    					<?php else: ?>
		    						-
		    					<?php endif; ?>
		    				<?php break;?>

		    				<?php case "sire": ?>
		    				<?php case "dam": 
		    					$sql_kinship = "SELECT * FROM `individual` WHERE id='$row[$value]'";
			    				$result_kinship = $mysqli->query($sql_kinship);
			    				$row_kinship = $result_kinship->fetch_array();?>
			    					<a class="btn btn-sm btn-outline-dark btn-block border-0" href="individual.php?identification=<?php echo $row_kinship['identification'];?>"><?php echo $row_kinship['identification'];?></a>
		    					<?php break;?>

		    				<?php case 'alive': ?>
    							<?php switch($row[$value]):
    							case '1': ?>
    								<div class="btn btn-sm text-success" style="cursor:auto;">True</div>
    							<?php break;?>

    							<?php case '0': ?>
    								<div class="btn btn-sm text-danger" style="cursor:auto;" > False</div>
    							<?php break;?>

    							<?php default: ?>
    								<div class="btn btn-sm text-secondary" style="cursor:auto;">Unknown</div>
    							<?php endswitch; ?>
	    					<?php break;?>

		    				<?php case 'informations': 
		    					$sql_informations = "SELECT * FROM genotype WHERE id_individual = '$row[id]'";
		    					$result_informations = $mysqli->query($sql_informations);
		    					$num =$result_informations->num_rows; 
		    					?>
			    				<a href='genetics.php?identification=<?php echo $row['identification'];?>' class="btn btn-sm <?php echo $num > 0? "btn-success":"btn-secondary disabled"; ?>">Genetics</a>
		    					<?php break;?>

		    				<?php case 'manager': ?>
			    				<form action="delete.php" method="GET" id="delete<?php echo $row['identification'];?>" target="_blank">
			    					<input type="hidden" name="id" value='<?php echo $row['id'];?>'>
			    					<input type="hidden" name="delete" value='individual'>
			    				</form>
			    				<form action="captivity_insert.php" method="GET" id="edit<?php echo $row['identification'];?>" target="_blank">
			    					<input type="hidden" name="identification" value="<?php echo $row['identification'];?>">
			    					<input type="hidden" name="action" value="edit">
			    				</form>
		    					<button type="submit" form="delete<?php echo $row['identification'];?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
		    					<button type="submit" form="edit<?php echo $row['identification'];?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
		    					<?php break;?>		

		    				<?php default: ?>
		    					<div class="btn" style="cursor:auto;"><?php echo $row[$value]!=""? $row[$value]:"-";?></div>		    				
		    			<?php endswitch; ?>
		    			</td>   			
		    		<?php endforeach; ?>
		    	</tr>
			<?php endwhile; ?>
			</tbody>
    	</table>
	</div>
</div>

<!-- Download -->
	<form id="formDownload" action="download.php" method="post">
		<input type="hidden" name="pagina" value="captivity">	
		<input type="hidden" name="download_ids" value="<?php echo htmlentities(serialize($download_ids)); ?>">		
	</form>

<?php include 'footer.php'; ?>