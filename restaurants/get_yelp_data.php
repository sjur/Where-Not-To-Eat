<?php
//require_once("/home8/sjurscom/public_html/src/functions.php"); FINAL
//require_once("sql_load.php"); FINAL

$ywsid = "p8F-TP5DZDACyIx5muWtKQ"; //the yelp api web service id string, needed for lookup

$yelpInfo = array();
$invalidPhoneNumber = array();
$errorInYelpLookup = array();

//debug($allRestaurants);

//foreach($allRestaurants as $a) FNIAL
{
	$camis = $a->getCamis();
	
	$sql = "SELECT * FROM `restaurants` where `CAMIS` = '$camis'";
	$result = mysql_query($sql);
	
	while($res = mysql_fetch_assoc($result)) 
		{
			$phone = $res['PHONE'];
			
			if($phone > 0) 
			{
				$yelpInfo = getYelpData($phone, $camis, $errorInYelpLookup);
				
				$rating = $yelpInfo[$camis]['yelp_rating'];
				$url = $yelpInfo[$camis]['yelp_url'];
				if($yelpInfo[$camis]['is_closed']) $active = 0;
				else $active = 1;
				
				if($rating > 0)
				{
					$query2 = "UPDATE `restaurants` SET `ACTIVE` = '$active', `YELP_RATING` = '$rating', `YELP_URL` = '$url' WHERE `CAMIS`  = '$camis'";
				}
				//echo $query2;
				$res = mysql_query($query2);
				//echo $res;
			}
			else array_push($invalidPhoneNumber, $res['CAMIS']);
			//debug($yelpInfo);
			//debug($yelpInfo);
			
		}
	
}
	
	
function getYelpData($phone, $camis, $errorInYelpLookup)
{
		$tempYelpInfo = array();
		$yelpResult = array();
		
		$handle = file_get_contents("http://api.yelp.com/phone_search?phone=$phone&ywsid=p8F-TP5DZDACyIx5muWtKQ");
		
		$tempYelpInfo = json_decode($handle,true);
		//echo "<hr/>";
		//echo($yelpInfo['message']['text']);
		if($tempYelpInfo['message']['code'] == 0)
		{
			//debug($tempYelpInfo['businesses'][0]['avg_rating']);
			//debug($tempYelpInfo['businesses'][0]['is_closed']);
			
			$yelpResult[$camis]['yelp_rating'] = $tempYelpInfo['businesses'][0]['avg_rating'];
			$yelpResult[$camis]['yelp_url'] = $tempYelpInfo['businesses'][0]['url'];
			$yelpResult[$camis]['is_closed'] = $tempYelpInfo['businesses'][0]['is_closed'];
		}
		else 
		{
			array_push($errorInYelpLookup, $camis);
			$yelpResult[$camis]['yelp_rating'] = 0;
			$yelpResult[$camis]['yelp_url'] = 0;
		}
		
		return $yelpResult;
}


echo "<hr> Invalid phone number";
debug($invalidPhoneNumber);
echo "<hr> Error in lookup";
debug($errorInYelpLookup);


?>