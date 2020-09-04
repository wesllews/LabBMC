<?php
session_start();
$_SESSION['pagina']='wild';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['name','sex','fragment','group','longitude','latitude'];

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
  $filterfragment = isset($_GET['filterfragment'])? $_GET['filterfragment'] : "";
  $filterfragment_sql = $filterfragment!=""? " AND fragment ='$_GET[filterfragment]'" : "";

/* Forms */
	$array =  array(
			"column" => $column,
			"sort_order" => $sort_order,
			"pag" => $pag,
			"limit" => $limit,
			"sexFilter" => $sexFilter,
			"filterfragment" => $filterfragment,
		);

/* Evita excesso de modal*/
$fragment = [];

$sql = "SELECT *,individual.id as id
FROM `individual` 
INNER JOIN status ON individual.id=status.id_individual 
INNER JOIN fragment ON status.id_fragment=fragment.id
LEFT JOIN ind_group ON individual.id=ind_group.id_individual
LEFT JOIN `group` ON `group`.id=ind_group.id_group
WHERE id_category=2";
$sql_pagination = $sql.$sexFilter_sql.$filterfragment_sql;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);
?>

<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Wild</h3><hr></div>

<!-- Filtro -->
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-warning text-white filter px-3" data-toggle="modal" data-target="#filtro">
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
			  <select name="filterfragment" class="form-control form-control-sm">
				<option <?php echo !isset($_GET['filterfragment']) ? "selected":""; ?> value="">All</option>
				<?php 
				$sql_fragment =" SELECT DISTINCT(fragment) as fragment
				FROM individual
				INNER JOIN status ON individual.id=status.id_individual
				INNER JOIN fragment ON status.id_fragment=fragment.id";
				$query = $mysqli->query($sql_fragment);

				while ($row = $query->fetch_array()):?>
				  <option <?php echo isset($_GET['filterfragment']) && $_GET['filterfragment']==$row["fragment"] ? "selected":""; ?> value="<?php echo $row["fragment"]; ?>"><?php echo $row["fragment"]; ?></option>
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
		  <button type="submit" form="formFiltro" class="btn btn-warning">Submit</button>

		  <form id="formClear" action="wild.php" method="get">
			<button type="submit" form="formClear" class="btn btn-warning">Clear</button>
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
	  </ul>
  </div>

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
					<button class="btn btn-link text-warning" type="submit" form="formFiltros" 
					onclick="document.getElementsByName('pag')[0].value = '1'; document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
					<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
					</button>
				  </div>
				</th>
			  <?php endforeach ?>
			</tr>
	  </thead>

	  <!--Body Table -->
	  <tbody>
			<?php while($row = $result_filter->fetch_array()): ?>
			  <tr class="text-center">
				<?php foreach ($header as $value): ?>
				  <?php switch($value):

					case 'identification': ?>
					  <td scope="row">
						<a class="btn btn-outline-success btn-block border-0" href="individual.php?identification=<?php echo $row[$value];?>"><?php echo $row[$value];?></a>
					  </td>
					<?php break;?>

					<?php case 'fragment': ?>
						<td scope="row">
							<!-- Trigger Modal -->
							<button type="button" class="btn btn-outline-primary btn-block border-0" data-toggle="modal" data-target="#fragment<?php echo str_replace(' ','_',$row['fragment']); ?>" style="white-space: nowrap;">
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
													<input type="hidden" name="filterfragment" value="<?php echo $row['fragment'];?>">
													<button type="submit" class="btn btn-warning" <?php echo isset($_GET['filterfragment']) && $_GET['filterfragment']==$row['fragment'] ? "disabled ":""; ?>>Filter by this fragment</button>
												</form>
												<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
		    				<?php endif; ?>
		    			</td>
					<?php break;?>

					<?php default: ?>
					  <td scope="row"><div class="btn" style="cursor:auto;"><?php echo $row[$value]!=""? $row[$value]:"-";?></div></td>
					  
				  <?php endswitch; ?>
				<?php endforeach; ?>
			  </tr>
			<?php endwhile; ?>
	  </tbody>
	</table>
  </div>
</div>



<?php include 'footer.php'; ?>