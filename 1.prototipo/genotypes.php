<?php
session_start();
$_SESSION['pagina']='genetics';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['category','sex','population','alive'];

if(in_array("delete",$_SESSION['permission'])){
		array_push($headersAdicionais, "manager");
	}

	// Adiciona os Locus cadastrados aos headers adicionais
	$sql_locus = "SELECT DISTINCT(locus) FROM genotype INNER JOIN locus ON locus.id = genotype.id_locus";
	$query = $mysqli->query($sql_locus);
	while ($row = $query->fetch_array()) {
	    array_push($headersAdicionais, $row["locus"]); //Sunstituindo . por _ para envio de variáveis pro método get
	}

	// Testa se algum locus foi enviado
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

	// Genotype filters
	$sexFilter = isset($_GET['sexFilter'])? $_GET['sexFilter'] : "";
	$filterpopulation = isset($_GET['filterpopulation'])? $_GET['filterpopulation'] : "";
	$status = isset($_GET['status'])? $_GET['status'] : "";
	$category = isset($_GET['filterCategory']) ? $_GET['filterCategory'] : "";

/* Forms */
	$array =  array(
	    "column" => $column,
	    "sort_order" => $sort_order,
	    "pag" => $pag,
	    "limit" => $limit,
	    "sexFilter" => $sexFilter,
	    "status" => $status,
	    "filterpopulation" => $filterpopulation,
	    "filterCategory" => $category
		);

/* SQL Filtros */

	// Table order
	$limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";
	$aux_column = $column=='identification'? 'CAST(identification AS INT),identification':$column;
	$aux_column = $column=='category'? 'category':$column;
	$order = " ORDER BY $aux_column $sort_order"; 

	// Genotype filters
	$sexFilter = $sexFilter!=""? " AND sex='$_GET[sexFilter]'" : "";
	$status = $status!=""? " AND alive='$_GET[status]'" : "";
	$filterpopulation = $filterpopulation!=""? " AND population ='$_GET[filterpopulation]'" : "";
	$category = $category!=""? " AND id_category ='$_GET[filterCategory]'" : "";

$sql= "SELECT * FROM(
SELECT DISTINCT(genotype.id_individual) as id, identification, id_category, category, sex,
CASE
    WHEN alive = 1 THEN 'True'
    WHEN alive = 0 THEN 'False'
    ELSE 'Unknown'
	END AS alive,
CASE
    WHEN id_category = 1 THEN institute.abbreviation
    WHEN id_category = 2 THEN fragment.fragment
	END AS population

FROM genotype

INNER JOIN individual ON individual.id=genotype.id_individual
INNER JOIN status ON status.id_individual=genotype.id_individual
INNER JOIN category ON individual.id_category=category.id
LEFT JOIN institute ON status.id_institute=institute.id
LEFT JOIN fragment ON status.id_fragment=fragment.id)genotype2 WHERE 1=1";

$sql_pagination = $sql.$sexFilter.$status.$filterpopulation.$category;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);

/* Evita excesso de modal*/
$population = []; 

/* Ids dos individuos para download*/
$download_ids = [];
?>

<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Genotypes and Alelles</h3><hr></div>

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
					<form id="formFiltro" action="genotypes.php" method="get">

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

						<!--category-->
						<div class="form-group">
							<label>Category</label>
							<br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="filterCategory" id="captive" value="1"  <?php echo isset($_GET['filterCategory']) && $_GET['filterCategory']=="1" ? "checked":""; ?>>
							  <label class="form-check-label" for="captive"> Captive</label>
							</div>

							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="filterCategory" id="wild" value="2"  <?php echo isset($_GET['filterCategory']) && $_GET['filterCategory']=="2" ? "checked":""; ?>>
							  <label class="form-check-label" for="wild"> Wild</label>
							</div>
						</div>

						<!--Life Status-->
						<div class="form-group">
							<label>Life Status</label>
							<br>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="status" id="statusAlive" value="True"  <?php echo isset($_GET["status"]) && $_GET["status"]=="True" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusAlive"> Alive</label>
							</div>

							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="status" id="statusDeath" value="False"  <?php echo isset($_GET["status"]) && $_GET["status"]=="False" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusDeath"> Death</label>
							</div>

							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="status" id="statusUnkown" value="Unknown"  <?php echo isset($_GET["status"]) && $_GET["status"]=="Unknown" ? "checked":""; ?>>
							  <label class="form-check-label" for="statusUnkown"> Unkown</label>
							</div>
						</div>

						<!--population-->
						<div class="form-group">
							<label>Population</label>
							<select name="filterpopulation" class="form-control form-control-sm">
							  <option <?php echo !isset($_GET['filterpopulation']) ? "selected":""; ?> value="">All</option>
							  <?php 
							  $sql_population =" SELECT DISTINCT(population) as population FROM(
							  SELECT DISTINCT(genotype.id_individual) as id, identification, id_category, sex, alive,
							  CASE
							      WHEN id_category = 1 THEN institute.abbreviation
							      WHEN id_category = 2 THEN fragment.fragment
							  END AS population

							  FROM genotype

							  INNER JOIN individual ON individual.id=genotype.id_individual
							  INNER JOIN status ON status.id_individual=genotype.id_individual
							  LEFT JOIN institute ON status.id_institute=institute.id
							  LEFT JOIN fragment ON status.id_fragment=fragment.id)genotype2";
							  $query = $mysqli->query($sql_population);

							  while ($row = $query->fetch_array()):?>
							    <option <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row["population"] ? "selected":""; ?> value="<?php echo $row["population"]; ?>"><?php echo $row["population"]; ?></option>
							  <?php endwhile; ?>
							</select>
						</div>

						<!--Display informations-->
						<div class="form-group">
							<label>Display informations</label>
					        <div class="overflow-auto" style="max-height: 150px;">
					        	<?php foreach ($headersAdicionais as $value):?>
					        		<div class="custom-control custom-checkbox">
								 		<input type="checkbox" class="custom-control-input" id="display<?php echo $value;?>" name="<?php echo $value;?>" value="s"  <?php echo isset($_GET[$value]) || $flag==0 ? "checked":""; ?>>
										<label class="custom-control-label" for="display<?php echo $value;?>"><?php echo ucfirst(str_replace('_',' ',$value)); ?></label>
									</div>
						        <?php endforeach;?>
					        </div>
						</div>
					</form>
				</div>
				<!-- FORM -->

				<div class="modal-footer">
					<button type="submit" form="formFiltro" class="btn btn-sm btn-warning">Submit</button>

					<form id="formClear" action="genotypes.php" method="get">
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
					<div class="d-flex justify-content-center align-items-end">

						<?php if(in_array($value, array('identification','category','sex', 'population', 'alive'))): ?>
							<span class="text-warning"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>
							<button class="btn btn-sm btn-link text-warning" type="submit" form="formFiltros" 
							onclick="document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
								<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
							</button>
						
						<?php elseif($value=="manager"): ?>
							<span class="text-warning"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>

						<?php else: ?>
							<?php
							$sql="SELECT * FROM locus WHERE locus='$value'";
							$result= $mysqli->query($sql);
							$row = $result->fetch_assoc();?>
							<!-- Popover-->
							<span class="btn btn-outline-light font-weight-bold text-warning border-0 py-0" data-toggle="popover" data-trigger="click hover"  tabindex="0" data-container="body" data-placement="auto" data-html="true"
							data-content="
								<b>Type:</b> <?php echo ucfirst($row['type']);?><br>
								<b>Motif:</b> <?php echo ucfirst($row['motif']);?><br>
								<b>Primer Forward:</b> <?php echo $row['forward'];?><br>
								<b>Primer Reverse:</b> <?php echo $row['reverse'];?><br>
								<b>Reference:</b> <?php echo $row['reference'];?><br>">
								<?php echo ucfirst(str_replace('_',' ',$value)); ?>
							</span>		
						<?php endif; ?>
					</div>
				</th>
			<?php endforeach ?>
    		</tr>
    	</thead>

    	<!--Body Table -->
		<tbody>
		<?php while($row = $result_filter->fetch_array()):?>

			<tr class="text-center">
				<?php foreach ($header as $value):?>
					<?php switch ($value):

						case 'identification':?>
							<?php array_push($download_ids,$row["id"]); ?>
							<td scope="row">
								<a class="btn btn-sm btn-outline-success btn-block border-0" href="individual.php?identification=<?php echo $row[$value];?>"><?php echo $row[$value];?></a>
							</td>
						<?php break;?>

						<?php case 'category': 
	    					$sql_category = "SELECT * FROM category WHERE id = '$row[id_category]'";
	    					$result_category = $mysqli->query($sql_category);
	    					$row_category = $result_category->fetch_array();?>
	    						<td scope="row">
	    							<?php echo ucfirst($row_category['category']); ?>
	    						</td>
    					<?php break;?>

    					<?php case 'sex': ?> 
    						<td scope="row">
    							<?php echo ucfirst($row['sex']); ?>
    						</td>
    					<?php break;?>

						<?php case 'population': ?>
							<td scope="row">
								<!-- Trigger Modal -->
								<button type="button" class="btn btn-sm btn-outline-primary btn-block border-0" data-toggle="modal" data-target="#population<?php echo str_replace(' ','_',$row['population']); ?>" style="white-space: nowrap;">
								  <?php echo $row['population']; ?>
								</button>

								<!-- Modal -->
								<?php if(!in_array($row['population'], $population)):
									array_push($population, $row['population']);?>

									<div class="modal fade" id="population<?php echo str_replace(' ','_',$row['population']); ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
															<?php if($row['id_category']==1): ?>
																<?php 
																$sql="SELECT * FROM institute WHERE abbreviation = '$row[population]';";
																$result= $mysqli->query($sql);
																$row_population = $result->fetch_assoc();
																?>
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
															<?php else: ?>
																<?php 
																$sql="SELECT * FROM fragment WHERE fragment = '$row[population]';";
																$result= $mysqli->query($sql);
																$row_population = $result->fetch_assoc();
																?>
																<tr>
																	<th>name</th>
																	<td><?php echo $row_population['fragment']; ?></td>
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
															<?php endif; ?>
														</tbody>
													</table>
												</div>

												<div class="modal-footer">
													<form action="genotypes.php" method="get">
														<input type="hidden" name="filterpopulation" value="<?php echo $row['population'];?>">
														<button type="submit" class="btn btn-sm btn-warning" <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row['population'] ? "disabled ":""; ?>>Filter by this population</button>
													</form>
													<button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
			    				<?php endif; ?>
			    			</td>
    					<?php break;?>

    					<?php case 'alive': ?>
	    					<td scope="row">
			    				<?php if($row['alive']=="True"):?>
			    					<div class="text-success">True</div>
			    				<?php elseif($row['alive']=="False"): ?>
			    					<div class="text-danger">False</div>
			    				<?php else: ?>
			    					<div class="text-secondary">Unknown</div>
			    				<?php endif; ?>
			    			</td>
	    				<?php break;?>

	    				<?php case 'manager': ?>
    					<td scope="row">
		    				<form action="genotypes_edit.php" method="GET" id="edit<?php echo $row['id'];?>" target="_blank">
		    					<input type="hidden" name="identification" value="<?php echo $row['identification'];?>">
		    					<input type="hidden" name="action" value="edit">
		    				</form>
	    					<button type="submit" form="edit<?php echo $row['id'];?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
	    				</td>
	    				<?php break;?>
		
						<?php default:
						 	$sql_locus = "SELECT * FROM genotype WHERE restricted ='0' AND id_individual='$row[id]' AND id_locus=(SELECT id FROM locus WHERE locus='$value'); ";
						 	$result_locus = $mysqli->query($sql_locus);
							if ($result_locus->num_rows>0):?>
								<td scope="row" style="white-space: nowrap;"> 
									<?php while($row_locus = $result_locus->fetch_array()){
										echo $row_locus['allele']," ";	
									}?>
								</td>
							<?php else: ?>
								<td scope="row">-</td>
							<?php endif;?>
						<?php break; ?>

					<?php endswitch; ?> 
				<?php endforeach; ?>
			</tr>
		<?php endwhile; ?>
		</tbody>
		

    	</table>
	</div>
</div>

<!-- Download -->
	<form id="formDownload" action="download_genotypes.php" method="post">
		<input type="hidden" name="pagina" value="genotypes">	
		<input type="hidden" name="header" value="<?php echo htmlentities(serialize($header)); ?>">		
		<input type="hidden" name="download_ids" value="<?php echo htmlentities(serialize($download_ids)); ?>">		
	</form>

<?php include 'footer.php'; ?>