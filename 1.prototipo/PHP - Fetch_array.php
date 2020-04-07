<?php


$sql = "SELECT * FROM `individual` WHERE id_category!=2";
$query = $mysqli->query($sql);

while ($row = $query->fetch_array()) {

    foreach ($query->fetch_array() as $key => $value) {
	echo $value;
	# code...
	}

}
$query->free();