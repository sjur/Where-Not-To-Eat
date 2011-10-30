<?php

//LOADS ALL THE RESTAURANTS FROM THE DB, CREATES RESTAURANT OBJECTS AND PUTS THEM INTO AN ARRAY

require("RestaurantClass.php");


//dbconnect();
$dbhost = 'localhost';
$dbuser = 'sjurscom_xml';
$dbpass = 'XMLisking2010';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');


$dbname = 'sjurscom_cms';
mysql_query("SET OPTION SQL_BIG_SELECTS=1");
mysql_select_db($dbname);

mysql_query("SET NAMES UTF8");

mysql_select_db('sjurscom_ig');

$sql = "SELECT * FROM `public_inspections`"; 
//$sql = "SELECT * FROM `local_inspections`"; 



$result = mysql_query($sql);



$tempAllCuisines = array(); //to keep track of number of cuisines affected, format [cuisinename][counter]

$allRestaurants = array(); //to keep track of the restaurants we added, the seond and third time we just add the date of closing

$today = 20101014;
$lastWeek=0;
$lastMonth=0; 
		
		while($res = mysql_fetch_assoc($result)) 
		{
			/* if the restaurant has already been added, we need to add another inpection date to the object*/
			
			if(array_key_exists($res['camis'], $allRestaurants))
			{
				$allRestaurants[$res['camis']]->addClosedDate($res['inspdate']);
			
				if($restaurant->getNewestDate() >= 20101007) $lastWeek++;
				if($restaurant->getNewestDate() >= 20100914) $lastMonth++;
				
				
			}
			
			else //restaurant hasnt been added already, we must create an object and put it in the array
			{
				$restaurant = new Restaurant($res['camis'], $res['dba'], $res['inspdate'], $res['building']." ".ucwords(strtolower($res['street'])).", ".$res['zipcode']." NY", 
										 $res['cuisine'], $res['yelp_rating'], $res['yelp_url'], $res['lat'], $res['lng'], $res['zipcode']);
			
				$allRestaurants[$res['camis']] = $restaurant;
				
				$tempAllCuisines[trim($res['cuisine'])]++; //we update the cuisine-counter for that cuisine
			
				if($restaurant->getNewestDate() >= 20101007) $lastWeek++;
				if($restaurant->getNewestDate() >= 20100914) $lastMonth++;
			}

		}
		
$allCuisinesByNumber = $tempAllCuisines;
$allCuisinesByAlphabet = $tempAllCuisines;

asort($allCuisinesByNumber);
$temparray = array_reverse($allCuisinesByNumber, true);
$allCuisinesByNumber = $temparray;

ksort($allCuisinesByAlphabet);
/*for portfolio*/
$stringOfRestaurants = serialize($allRestaurants);

$fp = fopen('myrestaurants.txt','w');
fwrite($fp, $stringOfRestaurants);
fclose($fp);


?>