<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>




<?php
require("/home8/sjurscom/public_html/src/functions.php");

dbconnect();
mysql_select_db('sjurscom_ig');





$sql = "SELECT DISTINCT CAMIS, DBA, BUILDING, STREET, ZIPCODE FROM `sjurscom_ig`.`nyc_restaurants` WHERE ACTION = 'G' AND BORO = 1";

$result = mysql_query($sql);

$i = 0;
while($restaurants = mysql_fetch_assoc($result)) {
	
println($restaurants["DBA"].", ".$restaurants["BUILDING"]." ".$restaurants["STREET"].", ".$restaurants["ZIPCODE"].", NY");
$i++;
	
}



?>
</body>
</html>
