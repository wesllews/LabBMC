<?php

function get_all($header,$limit=20){

	// Head
	$column = isset($_GET['column']) && in_array($_GET['column'], $header) ? $_GET['column'] : $header[0];
	$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
	// Pagination
	$pag = isset($_GET['pag']) ? $_GET['pag']:1;
	$limit = isset($_GET['limit'])? $_GET['limit']:$limit;
	$offset = ($pag-1) * $limit;

	// Studbook filters
	$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '1970-01-01';
	$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : date('Y-m-d') ;

	return array(
	    "column" => $column,
	    "sort_order" => $sort_order,
	    "pag" => $pag,
	    "limit" => $limit,
	    "offset" => $offset,
	    "startDate" => $startDate,
	    "endDate" => $endDate
	);
}


function pagination($total_pages_sql,$header){

	include "connection.php";

	$array = get_all($header);

    // Href
    $link = "limit=$array[limit]&column=$array[column]&order=$array[sort_order]";

    $result = mysqli_query($mysqli,$total_pages_sql);

    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows / $array['limit']);

	$links= 5;

	$start      = (($array['pag']-$links) > 0) ? ($array['pag'] - $links) : 1;
	$end        = (($array['pag']+$links) < $total_pages) ? ($array['pag'] + $links) : $total_pages; ?>

	<div class="container mt-4">
		 <ul class="pagination pagination-sm justify-content-center">

	    	<!--First page-->
	    	<li class="page-item <?php if($array['pag'] <= 1){ echo 'disabled'; } ?>">
			    <a class="page-link"  href="?<?php echo $link."&pag=1";?>">
			        First
			    </a>
	    	</li>


	    	<!--Previous-->
	        <li class="page-item <?php if($array['pag'] <= 1){ echo 'disabled'; } ?>">
	            <a class="page-link"  href="?<?php if($array['pag'] > 1){echo $link."&pag=".($array['pag']-1); }?>" >
	            	Prev
	        	</a>
	        </li>


	        <!-- Numbers -->
			<?php for ( $i = $start ; $i <= $end; $i++ ): ?>
				<li class="page-item <?php if ($array['pag'] == $i){echo "active";} ?>">
					<a class="page-link"  href="?<?php echo $link."&pag=".$i;?>">
						<?php echo $i;?> 
					</a>
				</li>  		
	  		<?php endfor; ?>




	        <!--Next-->
	        <li class="page-item <?php if($array['pag'] >= $total_pages){ echo 'disabled'; } ?>">
	            <a class="page-link" href="?<?php if($array['pag'] < $total_pages){echo $link."&pag=".($array['pag']+1); }?>">
	            	Next
	        	</a>
	        </li>


	        <!--Last-->
	    	<li class="page-item <?php if($array['pag'] >= $total_pages){ echo 'disabled'; } ?>">
			    <a class="page-link"  href="?<?php echo $link."&pag=".$total_pages;?>">
			        Last
			    </a>
	    	</li>

	    </ul>
	</div>

	<?php
}


function table($sql,$header){

	include "connection.php";
 	
 	$array = get_all($header);

	$order = " ORDER BY $array[column] $array[sort_order]";
    $limit = " LIMIT $array[offset],$array[limit]";

    $sql = $sql.$order.$limit;

    $link = "limit=$array[limit]&pag=$array[pag]";

		// Some variables we need for the table.
		$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $array['sort_order']); 
		$asc_or_desc = $array['sort_order'] == 'ASC' ? 'desc' : 'asc';
		?>

		<!--Head Table-->
	    <thead>
	        <tr class="text-center">
				<?php foreach ($header as $value): ?>
				 <th scope="col">
				 	<?php $link2 = "&order=".$asc_or_desc."&column=".$value; ?>
					<a  class="text-decoration-none text-warning" href="?<?php echo $link.$link2; ?>" >
						<?php echo ucfirst(str_replace('_',' ',$value)); ?>
						<i class="fas fa-sort<?php echo $array['column'] == $value ? '-'.$up_or_down : ''; ?>"></i>
					</a>
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

	<?php else: ?>

		<tbody>
	    	<tr class="text-center">
	    		<td scope="row">
	    			<h2><i class="far fa-window-close text-warning"></i> Couldn't Find Results</h2>	
	    		</td>
	    	</tr>
		</tbody>

	<?php endif;
}


function table_head($header){

	include "connection.php";
 	
 	$array = get_all($header);

    $link = "limit=$array[limit]&pag=$array[pag]";

    // Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $array['sort_order']); 
	$asc_or_desc = $array['sort_order'] == 'ASC' ? 'desc' : 'asc';
	?>


	<!--Head Table-->
    <thead>
        <tr class="text-center">
			<?php foreach ($header as $value): ?>
			 <th scope="col">
			 	<?php $link2 = "&order=".$asc_or_desc."&column=".$value; ?>
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

	<?php else: ?>

		<tbody>
	    	<tr class="text-center">
	    		<td scope="row">
	    			<h2><i class="far fa-window-close text-warning"></i> Couldn't Find Results</h2>	
	    		</td>
	    	</tr>
		</tbody>

	<?php endif;
}






