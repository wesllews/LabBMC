<?php
session_start();
$_SESSION['pagina']='genotypes';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['identification'];
$headersAdicionais =['category','sex','population','alive'];

	// Adiciona os Locus cadastrados aos headers adicionais
	$sql_locus = "SELECT DISTINCT(id_locus) FROM genotype";
	$query = $mysqli->query($sql_locus);
	while ($row = $query->fetch_array()) {
	    array_push($headersAdicionais, $row["id_locus"]); //Sunstituindo . por _ para envio de variáveis pro método get
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
	$category = isset($_GET['category']) ? $_GET['category'] : "";

/* SQL Filtros */

	// Table order
	$limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";
	$aux_column = $column=='identification'? 'CAST(identification AS INT),identification':$column;
	$aux_column = $column=='population'? 'id_institute':$column;
	$aux_column = $column=='category'? 'id_category':$column;
	$order = " ORDER BY $aux_column $sort_order"; 

	// Genotype filters
	$sexFilter = $sexFilter!=""? " AND sex='$_GET[sexFilter]'" : "";
	$status = $status!=""? " AND alive='$_GET[status]'" : "";
	$filterpopulation = $filterpopulation!=""? " AND id_institute='$_GET[filterpopulation]'" : "";

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


$sql= "SELECT DISTINCT(genotype.id_individual) as identification FROM genotype
INNER JOIN individual ON individual.identification=genotype.id_individual";
$sql_pagination = $sql.$sexFilter.$status.$filterpopulation;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter); 
?>

<div class="text-warning m-5" style="white-space: nowrap;"><h1 class="ml-5">Genotypes and Alelles</h1><hr></div>

<!--Button-->
<div class="d-flex flex-row">
  <div class="bg-warning text-white text-center p-4 girar" data-toggle="collapse" data-target="#filtro">
    <i class="fas fa-filter"></i><i class="fas fa-chevron-up" id="girar"></i>
  </div></div>

<!--Filtro Form-->
<div class="container-fluid collapse mb-1" id="filtro">
	
	<form class="bg-light rounded-bottom p-3" action="genotypes.php" method="get" target="_top">

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
		
		<!--Category-->
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
		  <label class="btn btn-secondary active">
		    <input type="radio" name="options" id="option1" autocomplete="off" checked> Captivity
		  </label>
		  <label class="btn btn-secondary">
		    <input type="radio" name="options" id="option3" autocomplete="off"> Wild
		  </label>
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

		<!--Display informations-->
		<div class="form-group">
			<label>Display informations</label>

	        <div class="overflow-auto" style="max-height: 300px;">
	        	<?php foreach ($headersAdicionais as $value):?>
	        		<div class="custom-control custom-checkbox">
				 		<input type="checkbox" class="custom-control-input" id="check<?php echo $value;?>" name="<?php echo $value;?>" value="s"  <?php echo isset($_GET[$value]) || $flag==0 ? "checked":""; ?>>
						<label class="custom-control-label" for="check<?php echo $value;?>"><?php echo ucfirst(str_replace('_',' ',$value)); ?></label>
					</div>
		        <?php endforeach;?>
	        </div>
		</div>

		<button type="submit" class="btn btn-warning">Submit</button>

		<a class="btn btn-warning" href="genotypes.php" role="button">Clear All</a>

	</form></div>

<!-- Forms Hiddens-->
<form method="get" action="" id="formFiltros">
	<?php foreach($array as $key => $value): ?>
		<?php if($value != ""):?>
		<input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>">
		<?php endif;?>
	<?php endforeach;?></form>

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
					<div class="d-flex justify-content-center align-items-end">

						<?php if(in_array($value, array('identification','category','sex'))): ?>
							<span class="text-warning"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>
							<button class="btn btn-link text-warning" type="submit" form="formFiltros" 
							onclick="document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
								<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
							</button>

						<?php elseif(in_array($value, array('population','alive'))): ?>
							<span class="text-warning"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>

						<?php else: ?>
							<!-- Modal Button-->
							<span type="button" class="text-warning" data-toggle="modal" data-target="#<?php echo $value;?>">
								<?php echo ucfirst(str_replace('_',' ',$value)); ?>
							</span>

							<!-- Modal -->
							<div class="modal fade" id="<?php echo $value;?>" tabindex="-1" role="dialog" >
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header"><h5 class="modal-title text-warning font-weight-bolder"><?php echo $value;?></h5></div>
										<div class="modal-body text-justify text-capitalize font-weight-normal">
											<?php 
											$sql="SELECT * FROM locus WHERE locus='$value'";
											$result= $mysqli->query($sql);
											$row = $result->fetch_assoc();
											?>
											<b>Type:</b> <?php echo ucfirst($row['type']);?><br>
											<b>Primer Forward:</b> <?php echo $row['forward'];?><br>
											<b>Primer Reverse:</b> <?php echo $row['reverse'];?><br>
											<b>Reference:</b> <?php echo $row['reference'];?><br>
										</div>
										<div class="modal-footer"><button type="button" class="btn btn-warning text-white" data-dismiss="modal">Close</button></div>
									</div>
								</div>
							</div>
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
							<td scope="row">
								<form method="get" action="individual.php" id="individual">
									<input type="hidden" name="identification" value="<?php echo $row[$value];?>">
									<button class=" btn btn-outline-success btn-block border-0" type="submit"><?php echo $row[$value];?></button>
								</form>
							</td>
						<?php break;?>


						<?php case 'category': 
	    					$sql_category = "SELECT * FROM `individual` INNER JOIN category ON category.id = individual.id_category WHERE identification = '$row[identification]'";
	    					$result_category = $mysqli->query($sql_category);
	    					$row_category = $result_category->fetch_array();?>
	    						<td scope="row">
	    							<?php echo ucfirst($row_category['category']); ?>
	    						</td>
    					<?php break;?>

    					<?php case 'sex': 
	    					$sql_sex = "SELECT * FROM `individual` WHERE identification = '$row[identification]'";
	    					$result_sex = $mysqli->query($sql_sex);
	    					$row_sex = $result_sex->fetch_array();?>
	    						<td scope="row">
	    							<?php echo ucfirst($row_sex['sex']); ?>
	    						</td>
    					<?php break;?>

						<?php case 'population': 
	    					$sql_population = "SELECT * FROM `status` INNER JOIN institute ON institute.id = status.id_institute WHERE id_individual = '$row[identification]'";
	    					$result_population = $mysqli->query($sql_population);

		    					if ($result_population->num_rows > 0): 
		    						$row_population = $result_population->fetch_array();?>
		    						<td scope="row" style="white-space: nowrap;">
		    							<?php echo $row_population['abbreviation']; ?>
		    						</td>
		    					<?php else: ?>
		    						<td scope="row">-</td>
		    					<?php endif; ?>
    					<?php break;?>

    					<?php case 'alive': 
	    					$sql_alive = "SELECT * FROM `status` 
	    					WHERE id_individual = '$row[identification]'";
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
		
						<?php default:
						 	$sql_locus = "SELECT * FROM genotype WHERE id_individual='$row[identification]' AND id_locus ='$value' ";
						 	$result_locus = $mysqli->query($sql_locus);
							if ($result_locus->num_rows >=2):?>
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


<?php include 'footer.php'; ?>