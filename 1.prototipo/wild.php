<?php
session_start();
$_SESSION['pagina']='wild';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['name','sex','fragment','group','longitude','latitude','informations'];

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

/* Filtros */
  // Pagination
  $pag = isset($_GET['pag']) ? $_GET['pag']:1;

  // Limit
  $limit = isset($_GET['limit'])? $_GET['limit']:20;
  $offset = $limit!="All" ? ($pag-1) * $limit : "";
  $limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";

  // Sort Table
  $column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
  $sort_order = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) == 'desc' ? 'DESC' : 'ASC';
  switch ($column) {
	case 'identification':
	  $order = " ORDER BY CONVERT($column, SIGNED) $sort_order, identification $sort_order, individual.id $sort_order";
	  break;

	case 'name':
	  $order = " ORDER BY ISNULL(individual.name),individual.name $sort_order, CONVERT(identification, SIGNED) $sort_order, individual.id $sort_order";
	  break;
	
	default:
	  $order = " ORDER BY `$column` $sort_order, CONVERT(identification, SIGNED) $sort_order, individual.id $sort_order";
	  break;
  }

  // Order
  $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
  $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

  //Sex
  $sexFilter = isset($_GET['sexFilter'])? $_GET['sexFilter'] : "";
  $sexFilter_sql = $sexFilter!=""? " AND sex='$sexFilter'" : "";

  // Fragment
  $filterpopulation = isset($_GET['filterpopulation'])? $_GET['filterpopulation'] : "";
  $filterpopulation_sql = $filterpopulation!=""? " AND fragment.id ='$_GET[filterpopulation]'" : "";

/* Forms */
	$array =  array(
			"column" => $column,
			"sort_order" => $sort_order,
			"pag" => $pag,
			"limit" => $limit,
			"sexFilter" => $sexFilter,
			"status" => $status,
			"filterpopulation" => $filterpopulation,
		);

$sql = "SELECT *,individual.id as id
FROM `individual` 
INNER JOIN status ON individual.id=status.id_individual 
INNER JOIN fragment ON status.id_fragment=fragment.id
LEFT JOIN ind_group ON individual.id=ind_group.id_individual
LEFT JOIN `group` ON `group`.id=ind_group.id_group
WHERE id_category=2";
$sql_pagination = $sql.$sexFilter_sql.$filterpopulation_sql;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);

/* Evita excesso de modal*/
$fragment = [];

/* Ids dos individuos para download*/
$download_ids = [];
?>

<!-- Header page -->
<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Wild</h3><hr></div>

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
		  <form id="formFiltro" action="wild.php" method="get">

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

			<!--Fragment-->
			<div class="form-group">
			  <label>Fragment</label>
			  <select name="filterpopulation" class="form-control form-control-sm">
				<option <?php echo !isset($_GET['filterpopulation']) ? "selected":""; ?> value="">All</option>
				<?php 
				$sql_fragment =" SELECT DISTINCT(fragment) as fragment, id_fragment
				FROM individual
				INNER JOIN status ON individual.id=status.id_individual
				INNER JOIN fragment ON status.id_fragment=fragment.id";
				$query = $mysqli->query($sql_fragment);

				while ($row = $query->fetch_array()):?>
				  <option <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row["id_fragment"] ? "selected":""; ?> value="<?php echo $row["id_fragment"]; ?>"><?php echo $row["fragment"]; ?></option>
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
		  </form>
		</div>
		<!-- FORM -->

		<div class="modal-footer">
		  <button type="submit" form="formFiltro" class="btn btn-sm btn-warning">Submit</button>

		  <form id="formClear" action="wild.php" method="get">
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
					<?php if(!in_array($value,["informations","manager"])): ?>
						<button class="btn btn-sm btn-link text-warning" type="submit" form="formFiltros" 
						onclick="document.getElementsByName('pag')[0].value = '1'; document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
							<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
						</button>
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

						<?php case 'fragment': ?>
							<!-- Trigger Modal -->
							<button type="button" class="btn btn-sm btn-outline-primary btn-block border-0" data-toggle="modal" data-target="#fragment<?php echo str_replace(' ','_',$row['fragment']); ?>" style="white-space: nowrap;">
							  <?php echo $row['fragment']; ?>
							</button>

							<!-- Modal -->
							<?php if(!in_array($row['fragment'], $fragment)):
								array_push($fragment, $row['fragment']);?>

								<div class="modal fade" id="fragment<?php echo str_replace(' ','_',$row['fragment']); ?>" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">

											<div class="modal-header">
												<h5 class="modal-title" >Fragment</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												<table class="table table-sm table-borderless text-left text-capitalize">
													<tbody>
														<?php 
														$sql="SELECT * FROM fragment WHERE fragment = '$row[fragment]';";
														$result= $mysqli->query($sql);
														$row_fragment = $result->fetch_assoc();
														?>
														<tr>
															<th>name</th>
															<td><?php echo $row_fragment['fragment']; ?></td>
														</tr>
														<tr>
															<th>Abbreviation</th>
															<td><?php echo $row_fragment['abbreviation']; ?></td>
														</tr>
														<tr>
															<th>country</th>
															<td><?php echo $row_fragment['country']; ?></td>
														</tr>
														<tr>
															<th>state</th>
															<td><?php echo $row_fragment['state']; ?></td>
														</tr>
														<tr>
															<th>city</th>
															<td><?php echo $row_fragment['city']; ?></td>
														</tr>
													</tbody>
												</table>
											</div>

											<div class="modal-footer">
												<form action="wild.php" method="get">
													<input type="hidden" name="filterpopulation" value="<?php echo $row_fragment['id'];?>">
													<button type="submit" class="btn btn-sm btn-warning" <?php echo isset($_GET['filterpopulation']) && $_GET['filterpopulation']==$row_fragment['id'] ? "disabled ":""; ?>>Filter by this fragment</button>
												</form>
												<button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php break;?>

						<?php case 'informations': 
							$sql_informations = "SELECT * FROM genotype WHERE id_individual = '$row[id]'";
							$result_informations = $mysqli->query($sql_informations);
							if ($result_informations->num_rows > 0): ?>
								<a href='genetics.php?identification=<?php echo $row['identification'];?>' class="btn btn-sm btn-success">Genetics</a>
								<button type="button" class="btn btn-sm btn-primary">Genomics</button>
							<?php else: ?>
								<button type="button" class="btn btn-sm btn-secondary disabled">Genetics</button>
								<button type="button" class="btn btn-sm btn-secondary disabled">Genomics</button>
							<?php endif; ?>
						<?php break;?>

						<?php case 'manager': ?>
							<form action="delete.php" method="GET" id="delete<?php echo $row['identification'];?>'" target="_blank">
								<input type="hidden" name="identification" value='<?php echo $row['identification'];?>'>
							</form>
							<form action="edit.php" method="GET" id="edit" target="_blank">
								<input type="hidden" name="identification" value="<?php echo $row['identification'];?>">
							</form>
							<button type="submit" form="delete<?php echo $row['identification'];?>'" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
							<button type="submit" form="edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>			    				
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
	<form id="formDownload" action="download_wild.php" method="post">
		<input type="hidden" name="pagina" value="wild">	
		<input type="hidden" name="download_ids" value="<?php echo htmlentities(serialize($download_ids)); ?>">		
	</form>



<?php include 'footer.php'; ?>