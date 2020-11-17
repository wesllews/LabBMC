<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['id','name','institution','justification','email','status','request_date'];

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
  $order = " ORDER BY `$column` $sort_order, approval_date";

  // Order
  $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
  $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

  //Status
  $status = isset($_GET['status'])? $_GET['status'] : "";
  $status_sql = $status!=""? " AND sex='$status'" : "";


$sql= "SELECT * FROM `login` WHERE 1=1";
$sql_pagination = $sql.$status_sql;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);
?>

<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Users</h3><hr></div>
<!--Table-->
<div class="container-fluid">
	<!--Table Responsive-->
	<div class="table-responsive">
		<!--Table-->
		<table class="table table-sm table-hover">

			<!--Head Table-->
			<thead>
				<tr class="text-center text-capitalize">
					<?php foreach ($header as $value): ?>
						<th scope="col" style="white-space: nowrap;">
							<div class="d-flex justify-content-center align-items-end">
								<span><?php echo str_replace('_',' ',$value); ?></span>
								<!--Icon-->
								<button class="btn btn-link btn-sm text-dark" type="submit" form="formFiltros" 
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
						<td scope="row">
							<div class="btn" style="cursor:auto;"><?php echo $row[$value]!=""? $row[$value]:"-";?></div>
						</td>
					<?php endforeach; ?>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>



<div class="fixed-bottom">
	<?php include 'footer.php'; ?>
</div>