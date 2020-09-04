<?php 
session_start();
include 'connection.php';

$header = unserialize($_POST['header']);
$query = $mysqli->query($_REQUEST['sql']);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Download</title>
	<head>
	<body>
		<table>

		<!-- Captivity -->
		<?php if ($_REQUEST['page']=='captivity'):?>
			
			<!--Head Table-->
			<tr style="text-transform: capitalize;">
				<?php foreach ($header as $value): ?>
					<?php switch($value):
						case 'informations':?><?php break; ?>

						<?php default:?>
							<th><?php echo $value ?></th>
					<?php endswitch; ?>
				<?php endforeach; ?>
			</tr>

			<!--Body Table -->
			<?php while($row = $query->fetch_array()): ?>
		    	<tr class="text-center">
		    		<?php foreach ($header as $value): ?>
		    			<?php switch($value):

		    				case 'identification': ?>
			    				<td scope="row">
			    					<?php echo $row[$value];?>
			    				</td>
		    				<?php break;?>

		    				<?php case "historic":
		    					$sql_historic = "SELECT *, institute.name as institute FROM historic LEFT JOIN events ON historic.id_event=events.id LEFT JOIN institute ON historic.id_institute=institute.id  WHERE id_individual = '$row[id]'";
		    					$result_historic = $mysqli->query($sql_historic);
		    					$num = $result_historic->num_rows ?>

		    					<td scope="row">
			    					<?php if ($num>=1): ?>
			    						<ul>
			    							<?php while ($row_historic = $result_historic->fetch_array()): ?>
			    								<li>
			    									<?php echo $row_historic['events']," on "; ?>
			    									<?php echo $row_historic['date']; ?>
			    									<?php echo " at the ",$row_historic['institute'],".";?>
			    									<?php echo $row_historic['observation'];?>
			    								</li>
			    							<?php endwhile; ?>		
			    						</ul>	    						
			    					<?php else: ?>
			    						-
			    					<?php endif; ?>
			    				</td>
		    				<?php break;?>

		    				<?php case 'population':					
		    					$sql_population = "SELECT * FROM institute WHERE id = '$row[id_institute]';";
		    					$result_population = $mysqli->query($sql_population);

		    					if ($result_population->num_rows > 0): 
		    						$row_population = $result_population->fetch_array();?>
		    						<td scope="row">
		    							<?php echo $row_population['abbreviation']; ?>
		    						</td>
		    					<?php else: ?>
		    						<td scope="row">-</td>
		    					<?php endif; ?>
		    				<?php break;?>

		    				<?php case "sire": ?>
		    				<?php case "dam": 
		    					$sql_kinship = "SELECT * FROM `individual` WHERE id='$row[$value]'";
			    				$result_kinship = $mysqli->query($sql_kinship);
			    				$row_kinship = $result_kinship->fetch_array();?>
			    				<td scope="row">
			    					<?php echo $row_kinship['identification'];?>
			    				</td>
		    					<?php break;?>

		    				<?php case 'alive': ?>
	    						<td scope="row">
	    							<?php switch($row[$value]):
	    							case '1': ?>
	    								True
	    							<?php break;?>

	    							<?php case '0': ?>
	    								False
	    							<?php break;?>

	    							<?php default: ?>
	    								Unknown
	    							<?php endswitch; ?>
	    						</td>
		    				<?php break;?>

		    				<?php case 'informations': ?><?php break;?>

		    				<?php default: ?>
		    					<td scope="row"><div class="btn" style="cursor:auto;"><?php echo $row[$value]!=""? $row[$value]:"-";?></div></td>
		    				
		    			<?php endswitch; ?>
		    		<?php endforeach; ?>
		    	</tr>
			<?php endwhile; ?>
		
		<?php endif; ?>
