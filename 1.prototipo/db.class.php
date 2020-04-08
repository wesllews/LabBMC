<?php


function table($sql,$header,$limit=20){

	include "connection.php";

	// For extra protection these are the columns of which the user can sort by (in your database table).
	$columns = $header; //['identification','name','sex','events','date','institute','local id'];

	// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
	$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];


	// Get the sort order for the column, ascending or descending, default is ascending.
	$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

	$sql .= "ORDER BY $column $sort_order";

	$pag = isset($_GET['pag']) ? $_GET['pag']:1;
    $limit = isset($_GET['limit'])? $_GET['limit']:$limit;
    $offset = ($pag-1) * $limit;

    $sql.= " LIMIT $offset,$limit";

    $link = "limit=$limit&pag=$pag";

	// Get the result...
	if ($result = $mysqli->query($sql)){

		// Some variables we need for the table.
		$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
		$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
		$add_class = ' class="highlight"';

		?>

		<!--Head Table-->
	    <thead>
	        <tr class="text-center">
				<?php foreach ($columns as $value): ?>
				 <th scope="col">
				 	<?php $link2 = "&order=".$asc_or_desc."&column=".$value; ?>
					<a  class="text-decoration-none text-warning" href="?<?php echo $link.$link2; ?>" >
						<?php echo ucfirst(str_replace('_',' ',$value)); ?>
						<i class="fas fa-sort<?php echo $column == $value ? '-'.$up_or_down : ''; ?>"></i>
					</a>
				</th>
				<?php endforeach ?>
			</tr>
		</thead>

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
	
<?php
	}
}





function table_body($sql,$header,$limit=10){

	include "connection.php";

    $pag = isset($_GET['pag']) ? $_GET['pag']:1;
    $limit = isset($_GET['limit'])? $_GET['limit']:$limit;
    $offset = ($pag-1) * $limit;

    $sql.= " LIMIT $offset, $limit";

    $result = mysqli_query($mysqli,$sql);

    #Rows Table
    while($row = mysqli_fetch_array($result)): ?>

    	<tr class="text-center">
    		<?php foreach ($header as $value): ?>
    		<td scope="row"> <?php echo $row[$value];?> </td>
    		 <?php endforeach; ?>
    	</tr>
    <?php endwhile;
}






function pagination($total_pages_sql,$header,$limit=10){

	include "connection.php";

	// Filtros e Ordens
	$columns = $header;
	$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
	$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

	// Paginas e limites
    $pag = isset($_GET['pag']) ? $_GET['pag']:1;
    $limit = isset($_GET['limit'])? $_GET['limit']:$limit;
    $offset = ($pag-1) * $limit;
	
    // Href
    $link = "limit=$limit&column=$column&order=$sort_order";

    $result = mysqli_query($mysqli,$total_pages_sql);

    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows / $limit);

	$links= 5;

	$start      = (($pag-$links) > 0) ? ($pag - $links) : 1;
	$end        = (($pag+$links) < $total_pages) ? ($pag + $links) : $total_pages;
?>

	<div class="container mt-4">
		 <ul class="pagination pagination-sm justify-content-center">

	    	<!--First page-->
	    	<li class="page-item <?php if($pag <= 1){ echo 'disabled'; } ?>">
			    <a class="page-link"  href="?<?php echo $link."&pag=1";?>">
			        First
			    </a>
	    	</li>


	    	<!--Previous-->
	        <li class="page-item <?php if($pag <= 1){ echo 'disabled'; } ?>">
	            <a class="page-link"  href="?<?php if($pag > 1){echo $link."&pag=".($pag-1); }?>" >
	            	Prev
	        	</a>
	        </li>


	        <!-- Numbers -->
			<?php for ( $i = $start ; $i <= $end; $i++ ): ?>
				<li class="page-item <?php if ($pag == $i){echo "active";} ?>">
					<a class="page-link"  href="?<?php echo $link."&pag=".$i;?>">
						<?php echo $i;?> 
					</a>
				</li>  		
	  		<?php endfor; ?>




	        <!--Next-->
	        <li class="page-item <?php if($pag >= $total_pages){ echo 'disabled'; } ?>">
	            <a class="page-link" href="?<?php if($pag < $total_pages){echo $link."&pag=".($pag+1); }?>">
	            	Next
	        	</a>
	        </li>


	        <!--Last-->
	    	<li class="page-item <?php if($pag >= $total_pages){ echo 'disabled'; } ?>">
			    <a class="page-link"  href="?<?php echo $link."&pag=".$total_pages;?>">
			        Last
			    </a>
	    	</li>

	    </ul>
	</div>

<?php
}