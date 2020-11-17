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
		<table class="table table-sm table-responsive table-hover">

			<!--Head Table-->
			<thead class="text-warning">
				<tr class="text-center text-capitalize">
					<?php foreach ($header as $value): ?>
						<th scope="col" style="white-space: nowrap;">
							<div class="d-flex justify-content-center align-items-end">
								<span><?php echo str_replace('_',' ',$value); ?></span>

								<?php if(!in_array($value, array('justification'))): ?>
									<!--Icon-->
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
							case 'email':?>
								<td scope="row">
									<form method="POST" action="send_email.php" target="_blank">
										<input type="hidden" name="ToEmail" value="<?php echo $row[$value];?>">
										<input type="hidden" name="name" value="<?php echo $row[name];?>">
										<button class=" btn btn-sm btn-outline-primary btn-block border-0" type="submit"><?php echo $row[$value];?></button>
									</form>
								</td>
							 <?php break; ?>

							<?php case 'justification':?>
								<div class="overflow-auto text-justify p-2" style="max-height: 150px;">
									<?php echo nl2br($row[$value]); ?>
								</div>
							 <?php break; ?>
							
							<?php default:?>
								<div class="btn" style="cursor: auto; white-space: nowrap;"><?php echo $row[$value]!=""? $row[$value]:"-";?></div>
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