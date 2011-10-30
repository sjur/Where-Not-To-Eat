<?php

require("RestaurantClass.php");

$sql = "SELECT * FROM `public_inspections`"; 

$result = mysql_query($sql);

switch ($region) {
	
	case 1: $zipRegion = $zipRegion1; $lat = 40.716731514199296; $lng = -73.995000; break;
	case 2: $zipRegion = $zipRegion2; $lat = 40.741731514199296; $lng = -73.990000; break;
	case 3: $zipRegion = $zipRegion3; $lat = 40.75865595297261; $lng = -73.98139715194702; break;
	case 4: $zipRegion = $zipRegion4; $lat = 40.77282746332923; $lng = -73.96865129470825; break;
	case 5: $zipRegion = $zipRegion5; $lat = 40.79368918611019; $lng = -73.9586091041565; break;
	case 6: $zipRegion = $zipRegion6; $lat = 40.802071; $lng = -73.949640; break;
	case 7: $zipRegion = $zipRegion7; $lat = 40.812725474189726; $lng = -73.94938230514526; break;
	case 8: $zipRegion = $zipRegion8; $lat = 40.83152900354168; $lng = -73.94290208816528; break;
	case 9: $zipRegion = $zipRegion9; $lat = 40.85685175453138; $lng =-73.92822504043579; break;
	
}



?>

<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">

  function loadMap(lat, lng) {
	
    <?php include("map_styles.php");?>
	
	
	var latlng = new google.maps.LatLng(lat,lng);
    
	
	
	var myOptions = {
      zoom: 14,
      center: latlng,
	  disableDefaultUI: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
	var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	
	var styledMapOptions = { name: "greyscale" }
		
		var greyMap = new google.maps.StyledMapType(
      stylez, styledMapOptions);
		
		map.mapTypes.set('greyscale', greyMap);
  map.setMapTypeId('greyscale');
	
	
	var markers = new Array();
	var contentStrings = new Array();
	var i=0;
	infoWindow2 = new google.maps.InfoWindow();
	
    <?php
		$i = 0; //to count the number of restaurants
		
		$allRestaurants = array(); //to keep track of the restaurants we added, the seond and third time we just add the date of closing
		
		while($res = mysql_fetch_assoc($result)) {
			
			

			
			//if(in_array($res['zipcode'], $zipRegion)) {
			
			$restaurant = new Restaurant($res['camis'], $res['dba'], $res['inspdate'], $res['building']." ".$res['street'].", ".$res['zipcode']." NY", 
										 $res['cuisine'], $res['yelp_rating'], $res['yelp_url'], $res['lat'], $res['lng'], $res['zipcode']);
			
			$allRestaurants[$res['camis']] = $restaurant;
	
	
	?>
     	var myLatlng = new google.maps.LatLng(<?php echo $restaurant->getLat(); ?>,<?php echo $restaurant->getLng(); ?>);

        markers[i] = new google.maps.Marker({
            position: myLatlng,
			map: map,
			icon: "marker_8x8.png",
			title: "<?php echo $restaurant->getDba(); ?>",
			
            
        });
				
		contentStrings["<?php echo $restaurant->getDba(); ?>"] = "<?php println("<span class='bold'>". $restaurant->getDba()."</span>"); println($restaurant->getAddress()); 
		println("<br/>Closed on: ".date('j M Y',strtotime($res['inspdate'])));
		if ($res['yelp_rating'] >= 0 ) println("<br/><a href='".$res['yelp_url']."' target='_blank'><img src='yelp_logo_small.png' />&nbsp;<img src='stars_small_3_half.png' /></a>"); ?>";

		

		google.maps.event.addListener(markers[i], 'mouseover', function() {
		
		//infoWindow2.close();
		infoWindow2.setPosition(this.position);
		infoWindow2.setContent(contentStrings[this.title]);
		
		infoWindow2.open(map);
		});
		
		i++;
		

		<?php
				
				$i++;
			//}

		}
		//debug($allRestaurants);
		?>
 }

loadMap(<?php echo $lat;?>, <?php echo $lng; ?>);

</script>
