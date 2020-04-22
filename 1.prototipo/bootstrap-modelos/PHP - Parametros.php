<?php

$category=2;
/* create a prepared statement */

if ($stmt = $mysqli->prepare("SELECT identification from individual WHERE id_category=?;")) {

    /* bind parameters for markers */
    $stmt->bind_param("s",$category);

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($district);

    /* fetch value */
    echo $stmt->fetch(),"<br>";

    printf("%s is in district %s\n", $category, $district);
}
/* Num_Rows
$query = $mysqli->prepare("SELECT * FROM table1");
$query->execute();
$query->store_result();

$rows = $query->num_rows;
*/