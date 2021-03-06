<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';

/* Cabeçalho da tabela */
$header = ['id','name','institution','justification','email','permission','request_date','analyzed_date'];

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
  $permission = isset($_GET['permission'])? $_GET['permission'] : "All";
  $limit_sql = $limit!="All" ? " LIMIT $offset,$limit":"";
  $permission_sql = $permission!="All" ? " AND permission='$permission'" : "";
  $order = " ORDER BY `$column` $sort_order, analyzed_date";


/* Forms */
	$array =  array(
		    "column" => $column,
		    "sort_order" => $sort_order,
		    "pag" => $pag,
		    "limit" => $limit,
		    "permission" => $permission
		);


$sql= "SELECT * FROM `login` WHERE 1=1";
$sql_pagination = $sql.$permission_sql;
$sql_filter = $sql_pagination.$order.$limit_sql;
$result_filter = $mysqli->query($sql_filter);
?>

<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Users</h3><hr></div>


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
		<form action="users.php" method="get" class="form-inline pb-1">
			<label for="permission">Permission: </label>
			<select class="btn btn-sm border mr-2" name="permission" id="permission">
				<option <?php echo $permission=="administrator"? "selected":"";?> value="administrator">Administrator</option>
				<option <?php echo $permission=="collaborator"? "selected":"";?> value="collaborator">Collaborator</option>
				<option <?php echo $permission=="denied"? "selected":"";?> value="denied">Denied</option>
				<option <?php echo $permission=="requested"? "selected":"";?> value="requested">Requested</option>
				<option <?php echo $permission=="All"? "selected":"";?> value="All">All</option>
			</select>

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
								<form method="POST" action="send_email.php" target="_blank">
									<input type="hidden" name="ToEmail" value="<?php echo $row[$value];?>">
									<input type="hidden" name="name" value="<?php echo $row[name];?>">
									<button class=" btn btn-sm btn-outline-primary btn-block border-0" type="submit"><?php echo $row[$value];?></button>
								</form>
							 <?php break; ?>

							<?php case 'justification':?>
								<div class="overflow-auto text-justify p-2" style="max-height: 150px;">
									<?php echo nl2br($row[$value]); ?>
								</div>
							 <?php break; ?>

							<?php case 'permission':?>
								<form action="user_update.php" method="post" target="_blank">
									<input type="hidden" name="update" value="permission">
									<input type="hidden" name="id" value="<?php echo $row[id];?>">
									<div class="d-flex flex-nowrap">
										<select class="form-control form-control-sm" style="min-width: 120px;" name="permission" id="selectpermission<?php echo $row[id];?>" onchange="changeButton('<?php echo $row[id];?>','<?php echo $row[permission];?>')">
										<?php if ($row[$value]=="requested"): ?>
											<option selected disabled> Requested</option>
										<?php endif; ?>
										<option value="administrator" <?php echo $row[$value]=="administrator"? "selected":"";?>>
											Administrator
										</option>
										<option value="collaborator" <?php echo $row[$value]=="collaborator"? "selected":"";?>>
											Collaborator
										</option>
										<option value="denied" <?php echo $row[$value]=="denied"? "selected":"";?>>
											Denied
										</option>
									</select>
									<button type="submit" class="btn btn-success btn-sm ml-2" id ="changepermission<?php echo $row[id];?>" disabled>Change</button>
									</div>
									
								</form>
							<?php break; ?>

							<?php case 'request_date':?>
							<?php case 'analyzed_date':?>
								<?php if ($row[$value]!=""){
									echo date('m/d/Y', strtotime($row[$value]));
								} else{
									echo "-";
								} ?>
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