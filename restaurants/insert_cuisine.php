<?php

require("header.php");


dbconnect();

//mysql_select_db('sjurscom_ig');

$handle = fopen("cuisine.txt", r);


while($buffer = fgetcsv($handle)) {
	
	$query = "INSERT INTO `sjurscom_ig`.`cuisine` (`CODE`, `DESCRIPTION`) values ('$buffer[0]', '$buffer[1]')";
	
	$result = mysql_query($query);
	
	debug($query);
	
}




?>