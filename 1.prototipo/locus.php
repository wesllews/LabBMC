<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['locus','type','motif','reference','forward','reverse'];
if(in_array("delete",$_SESSION['permission'])){
	array_push($header, "manager");
}

/* Recebe as variaveis*/
  // Pagination
  $pag = isset($_GET['pag']) ? $_GET['pag']:1;
  $limit = isset($_GET['limit'])? $_GET['limit']:10;
  $offset = $limit!="All" ? ($pag-1) * $limit : "";

  // Sort Table
  $column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
  $sort_order = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) == 'desc' ? 'DESC' : 'ASC';

  // Some variables we need for the table.
  $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
  $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

/* SQL Filtros */
  $limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";
  $order = " ORDER BY `$column` $sort_order";

/* Forms */
	$array =  array(
		    "column" => $column,
		    "sort_order" => $sort_order,
		    "pag" => $pag,
		    "limit" => $limit
		);


$sql= "SELECT * FROM `locus` WHERE 1=1";
$sql_pagination = $sql;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);
?>

<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Locus</h3><hr></div>


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


<!--Filtros-->
<div class="container-fluid">
	<form method="get" class="form-inline pb-1">
		<label for="limit">Show: </label>
		<select class="btn btn-sm border mr-2" name="limit" id="limit">
			<?php for ($i=10; $i <= 50; $i+=10):?>
				<option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php endfor; ?>
			<option <?php echo isset($_GET['limit']) && $_GET['limit']=="All" ? "selected":""; ?> value="All">All results</option>
		</select>
		<button type="submit" class="btn btn-success btn-sm">Submit</button>
	</form>
		
	<!--Table Responsive-->
	<div class="table-responsive" style="min-height: 270px;">
		<!--Table-->
		<table class="table table-sm table-hover">

			<!--Head Table-->
			<thead class="text-warning">
				<tr class="text-center text-capitalize">
					<?php foreach ($header as $value): ?>
						<th scope="col" style="white-space: nowrap;">
							<div class="d-flex justify-content-center align-items-end">
								<span><?php echo str_replace('_',' ',$value); ?></span>
								<!--Icon-->
								<?php if(!in_array($value, array('manager'))): ?>
									<button class="btn btn-sm text-warning" type="submit" form="formFiltros" 
									onclick="document.getElementsByName('pag')[0].value = '1'; document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value ='<?php echo $value;?>';">
									<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
									</button>
								<?php endif;?>
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
					<td scope="col">

						<?php switch ($value):
							case 'manager': ?>
			    				<form action="delete.php" method="GET" id="delete<?php echo $row['id'];?>" target="_blank">
			    					<input type="hidden" name="id" value='<?php echo $row['id'];?>'>
			    					<input type="hidden" name="delete" value='locus'>
			    				</form>
			    				<form action="locus_insert.php" method="GET" id="edit<?php echo $row['id'];?>" target="_blank">
			    					<input type="hidden" name="id" value="<?php echo $row['id'];?>">
			    					<input type="hidden" name="action" value="edit">
			    				</form>
		    					<button type="submit" form="delete<?php echo $row['id'];?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
		    					<button type="submit" form="edit<?php echo $row['id'];?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
		    					<?php break;?>

							<?php default:?>
								<div style="cursor: auto;" class="overflow-auto text-justify p-2">
									<?php echo $row[$value]!=""? $row[$value]:"-";?>
								</div>
							<?php break;?>
						<?php endswitch; ?>

					</td>
					<?php endforeach; ?>

				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>

<?php include 'footer.php'; ?>