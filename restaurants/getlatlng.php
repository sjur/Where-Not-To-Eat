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



$query = "SELECT * from `restaurants`";

$result = mysql_query($query);

$i = 0;

while($res = mysql_fetch_assoc($result)) {
	
	if($i == 10) {
		
		$a .= $i;
		
		println($a);
		
		sleep(3);
		
		$i = 0;
		
	}
	
	$i++;
	
	

	//debug($res);
	
	println($res['DBA']);
	
	$address = (urlencode($res['BUILDING']." ".$res['STREET'].", ".$res['ZIPCODE'].", NY"));
	$url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$address."&sensor=false";


	$xml = simplexml_load_file($url);

	//debug($xml);

	$lat = $xml->xpath("//location/lat");
	$lng = $xml->xpath("//location/lng");

	//$lat = ($xml->result->geometry->location->lat);
	$latitude = ($lat[0][0]);
	$longitude = ($lng[0][0]);

	$query = "UPDATE `restaurants` SET lat = ".$latitude.", lng = ".$longitude." WHERE id = ".$res['ID'];
	mysql_query($query);
	

}

?>
</body>
</html>
