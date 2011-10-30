<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
require("/home8/sjurscom/public_html/src/functions.php");
//require("get_yelp_data.php");

/*dbconnect(); FINAL
mysql_select_db('sjurscom_ig');
*/
//$handle = fopen("WebExtract10dec.txt", r);

$i = 0;
$failcount = 0;
fgetcsv($handle); //reads the header line

$isAdded = array();

//while($buffer = fgetcsv($handle))  FINAL
{
	
	foreach($buffer as &$a) $a = trim($a);
	unset($a);
	
	if($buffer[9] == 'G' || $buffer[9] == 'W') 
	{

		$query = "INSERT INTO `sjurscom_ig`.`inspections` (`CAMIS`,`INSPDATE`, `ACTION`, `VIOLCODE`, `SCORE`, `CURRENTGRADE`, `GRADEDATE`, `RECORDDATE`) VALUES ('$buffer[0]', '$buffer[8]', '$buffer[9]', '$buffer[10]', '$buffer[11]', '$buffer[12]', '$buffer[13]', '$buffer[14]')";

//$query = "INSERT INTO `sjurscom_ig`.`nyc_restaurants` (`CAMIS`, `DBA`, `BORO`, `BUILDING`, `STREET`, `ZIPCODE`, `PHONE`, `CUISINECODE`, `INSPDATE`, `ACTION`, `VIOLCODE`, `SCORE`, `CURRENTGRADE`, `GRADEDATE`, `RECORDDATE`) VALUES ('30075445', 'MORRIS PARK BAKE SHOP', '2', '1007', 'MORRIS PARK AVE', '10462', '7188924968', '08', '2008-03-12 12:32:00', 'F', '08A', '47', '', '', '2010-10-29 01:00:48.137000000')";
			
			
	$result = mysql_query($query);
	
	if(!(in_array($buffer[0], $isAdded))) 
	{
		
		$query2 = "INSERT INTO `sjurscom_ig`.`restaurants` (`CAMIS`, `DBA`, `BORO`, `BUILDING`, `STREET`, `ZIPCODE`, `PHONE`, `CUISINECODE`) VALUES ('$buffer[0]', '$buffer[1]', '$buffer[2]', '$buffer[3]', '$buffer[4]', '$buffer[5]', '$buffer[6]', '$buffer[7]')";
		
		$result2 = mysql_query($query2);
		
		
		
		$isAdded[$buffer[0]] = $buffer[0];
	}
		
	
	

	}



}






?>

</body>
</html>
