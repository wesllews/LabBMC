<?php

function get_all($header,$limit=20){

	// Table_Head
	$column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
	$sort_order = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) == 'desc' ? 'DESC' : 'ASC';

	// Pagination
	$pag = isset($_GET['pag']) ? $_GET['pag']:1;
	$limit = isset($_GET['limit'])? $_GET['limit']:$limit;
	$offset = ($pag-1) * $limit;

	// Studbook filters
	$startDate = isset($_GET['startDate']) ? $_GET['startDate'] :"";
	$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : "";
	$sex = isset($_GET['sex']) ? $_GET['sex'] : "";
	$institute = isset($_GET['institute']) ? $_GET['institute'] : "";

	// Genotype filters
	$category = isset($_GET['category']) ? $_GET['category'] : "";

	$array =  array(
	    "column" => $column,
	    "sort_order" => $sort_order,
	    "pag" => $pag,
	    "limit" => $limit,
	    "offset" => $offset,
	    "startDate" => $startDate,
	    "endDate" => $endDate,
	    "sex" => $sex,
	    "institute" => $institute,
	    "category" => $category
	);

	return $array;
}


function forms($header){ ?>

	<form method="get" action="" id="formFiltros">
		<?php foreach (get_all($header) as $key => $value): ?>
			<?php if($value != ""):?>
			<input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>">
			<?php endif;?>
		<?php endforeach;?>
	</form>
	<?php 
}


function pagination($sql,$header){

	include "connection.php";

	$array = get_all($header);

    $result = mysqli_query($mysqli,$sql);

    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows / $array['limit']);

	$NumLinks= 5;

	$start      = (($array['pag']-$NumLinks) > 0) ? ($array['pag'] - $NumLinks) : 1;
	$end        = (($array['pag']+$NumLinks) < $total_pages) ? ($array['pag'] + $NumLinks) : $total_pages; ?>

	<div class="container mt-4">
		 <ul class="pagination pagination-sm justify-content-center">

	    	<!--First page-->
	    	<li class="page-item <?php if($array['pag'] <= 1){ echo 'disabled'; } ?>">
	       		<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '1';" form="formFiltros" >First</button>
	    	</li>


	    	<!--Previous-->
	        <li class="page-item <?php if($array['pag'] <= 1){ echo 'disabled'; } ?>">
	        	
	       		<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo ($array['pag']-1);?>';" form="formFiltros" >Prev</button>
	            
	        </li>


	        <!-- Numbers -->
			<?php for ( $i = $start ; $i <= $end; $i++ ): ?>
				<li class="page-item <?php if ($array['pag'] == $i){echo "active";} ?>">
					<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo $i;?>';" form="formFiltros" > <?php echo $i;?> </button>
				</li>  		
	  		<?php endfor; ?>




	        <!--Next-->
	        <li class="page-item <?php if($array['pag'] >= $total_pages){ echo 'disabled'; } ?>">
	        	<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo ($array['pag']+1);?>';" form="formFiltros" >Next</button>
	        </li>


	        <!--Last-->
	    	<li class="page-item <?php if($array['pag'] >= $total_pages){ echo 'disabled'; } ?>">
	    		<button class="page-link" type="submit"  onclick="document.getElementsByName('pag')[0].value = '<?php echo $total_pages;?>';" form="formFiltros" >Last</button>
	    	</li>

	    </ul>
	</div>

	<?php
}


function table($sql,$header,$class="table-hover"){

	include "connection.php";
 	
 	$array = get_all($header);

	$order = " ORDER BY $array[column] $array[sort_order]"; #ORDER BY CAST(identification AS INT)
    $limit = " LIMIT $array[offset],$array[limit]";

    $sql = $sql.$order.$limit;

  	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $array['sort_order']); 
	$asc_or_desc = $array['sort_order'] == 'ASC' ? 'desc' : 'asc';
	?>
	<!--Table-->
    <table class="table <?php echo $class;?> ">
		<!--Head Table-->
	    <thead>
	        <tr class="text-center">
				<?php foreach ($header as $value): ?>
				 <th scope="col">
				 	<div class="d-flex justify-content-center text-warning">
				 		
				 	<span class="text-warning mt-auto"><?php echo ucfirst(str_replace('_',' ',$value)); ?></span>
				 	<button class="btn btn-link text-warning" type="submit" form="formFiltros" onclick="document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value = '<?php echo $value;?>';">

				 		<i class="fas fa-sort<?php echo $array['column'] == $value ? '-'.$up_or_down : ''; ?>"></i>
				 	</button>
				 	</div>

				 	
				 	
				</th>
				<?php endforeach ?>
			</tr>
		</thead>

		<?php 
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0): ?>

			<!--Body Table-->
			<tbody>
		    <?php while($row = $result->fetch_assoc()): ?>
		    	<tr class="text-center">
		    		<?php foreach ($header as $value): ?>
		    		<td scope="row"> <?php echo $row[$value];?> </td>
		    		<?php endforeach; ?>
		    	</tr>
		    <?php endwhile; ?>
			</tbody>
	</table>

		<?php else: ?>
	</table>

		<div class="alert text-center bg-light p-5">
			<h1><i class="far fa-window-close text-warning"></i> Couldn't Find Results</h1>
			<a class="btn btn-warning" href="?" role="button">Reset Search</a>	
		</div>

		<?php endif;
}


function table_head($header,$class="table-hover"){

	include "connection.php";
 	
 	$array = get_all($header);

    // Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $array['sort_order']); 
	$asc_or_desc = $array['sort_order'] == 'ASC' ? 'desc' : 'asc';
	?>

	<!--Table-->
    <table class="table <?php echo $class;?> ">
		<!--Head Table-->
	    <thead>
	        <tr class="text-center">
				<?php foreach ($header as $value): ?>
				 <th >
					<a  class="text-decoration-none text-warning" href="?<?php echo $link.$link2; ?>" >
						<?php echo ucfirst(str_replace('_',' ',$value)); ?>
						<i class="fas fa-sort<?php echo $array['column'] == $value ? '-'.$up_or_down : ''; ?>"></i>
					</a>
				</th>
				<?php endforeach ?>
			</tr>
		</thead>
	<?php 
}


function table_body($sql,$header){

	include "connection.php";
 	
 	$array = get_all($header);

	$order = " ORDER BY $array[column] $array[sort_order]";
    $limit = " LIMIT $array[offset],$array[limit]";

    $sql = $sql.$order.$limit;

    $link = "limit=$array[limit]&pag=$array[pag]";


	$result = $mysqli->query($sql);
	if ($result->num_rows > 0): ?>

		<!--Body Table-->
		<tbody>
	    <?php while($row = $result->fetch_assoc()): ?>
	    	<tr class="text-center">
	    		<?php foreach ($header as $value): ?>
	    		<td scope="row"> <?php echo $row[$value];?> </td>
	    		<?php endforeach; ?>
	    	</tr>
	    <?php endwhile; ?>
		</tbody>
	</table>

		<?php else: ?>
	</table>

		<div class="alert text-center bg-light p-5">
			<h1><i class="far fa-window-close text-warning"></i> Couldn't Find Results</h1>	
		</div>

	<?php endif;
}


function table_head_genotypes($header,$class="table-hover"){

	include "connection.php";
 	
 	$array = get_all($header);

    // Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $array['sort_order']); 
	$asc_or_desc = $array['sort_order'] == 'ASC' ? 'desc' : 'asc';
	?>

	<!--Table-->
    <table class="table <?php echo $class;?> ">
		<!--Head Table-->
	    <thead>
	        <tr class="text-center">
				<?php foreach ($header as $value): ?>
				 <th scope="col">
				 	<button class="btn btn-link text-warning" type="submit" form="formFiltros"onclick="document.getElementsByName('sort_order')[0].value = '<?php echo $asc_or_desc;?>'; document.getElementsByName('column')[0].value = '<?php echo $value;?>';">

				 		<i class="fas fa-sort<?php echo $array['column'] == $value ? '-'.$up_or_down : ''; ?>"></i>
				 		<?php echo ucfirst(str_replace('_',' ',$value)); ?>

				 	</button>
				</th>
				<?php endforeach ?>
			</tr>
		</thead>
	<?php 
}

function table_body_genotypes($sql,$header){

	include "connection.php";
 	
 	$array = get_all($header);

	$order = " ORDER BY `individual`.`identification` ASC"; #" ORDER BY $array[column] $array[sort_order]";
    $limit = " LIMIT $array[offset],$array[limit]";

    $sql = $sql.$order.$limit;
    $individual = $mysqli->query($sql);
    ?>

    <!--Body Table-->
	<tbody>
	    <?php while ($row_individual = $individual->fetch_array()):?>
			<tr class="text-center">
				<td scope="row"><?php echo $row_individual["identification"];?></td>
				<td scope="row"><?php echo $row_individual["category"];?></td>
				<td scope="row"><?php echo $row_individual["sex"];?></td>
				
				<?php 
				foreach (array_slice($header,3) as $locus):

				 	$sql_locus = "SELECT alelo FROM individual INNER JOIN genotype ON individual.identification=genotype.id_individual INNER JOIN category ON individual.id_category=category.id WHERE identification='$row_individual[identification]' AND id_locus ='$locus' ";
				 	$result = $mysqli->query($sql_locus);
					if ($result->num_rows >=2):?>
						<td scope="row">  
							<?php while($row = $result->fetch_array()){	echo $row[0],",";	}?>
						</td>

					<?php else: ?>
						<td scope="row">-</td>
					<?php endif;?>
				<?php endforeach; ?>
			</tr>
		<?php endwhile;?>
	</tbody>
	</table>
	<?php 
}




