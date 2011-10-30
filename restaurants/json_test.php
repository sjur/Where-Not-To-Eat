<?php

$json = file_get_contents("http://api.yelp.com/phone_search?phone=2126830900&ywsid=p8F-TP5DZDACyIx5muWtKQ");

echo "<pre>";
$bz = json_decode($json, true);

$closed = ($bz['businesses'][0]['is_closed']);
$rating = ($bz['businesses'][0]['avg_rating']);
$url = ($bz['businesses'][0]['url']);
echo "</pre>";
echo $url." - ".$closed." - ".$rating;
var_dump($closed);


?>
