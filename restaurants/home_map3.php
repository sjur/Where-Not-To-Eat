<?php

require("RestaurantClass.php");

$sql = "SELECT * FROM `public_inspections`"; 

$result = mysql_query($sql);





?>

<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">

	var map;
  function loadMap() {
	
    <?php include("map_styles.php");?>
	
	
	var latlng = new google.maps.LatLng(40.790000,-73.915000);
    
	
	
	var myOptions = {
      zoom: 12,
      center: latlng,
	  disableDefaultUI: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	
	var styledMapOptions = { name: "greyscale" }
		
		var greyMap = new google.maps.StyledMapType(
      stylez, styledMapOptions);
		
		map.mapTypes.set('greyscale', greyMap);
  map.setMapTypeId('greyscale');
  
  }
	
	function loadMarkers() {
	var markers = new Array();
	var contentStrings = new Array();
	var i=0;
	infoWindow2 = new google.maps.InfoWindow();
	
    <?php
		
		$allRestaurants = array(); //to keep track of the restaurants we added, the seond and third time we just add the date of closing
		
		while($res = mysql_fetch_assoc($result)) {
															
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
		if ($res['yelp_rating'] > 0 ) println("<br/><a href='".$res['yelp_url']."' target='_blank'><img src='yelp_logo_small.png' />&nbsp;<img src='".$yelpImage."' /></a>"); ?>";

		

		google.maps.event.addListener(markers[i], 'mouseover', function() {
		
		//infoWindow2.close();
		infoWindow2.setPosition(this.position);
		infoWindow2.setContent(contentStrings[this.title]);
		
		infoWindow2.open(map);
		});
		
		i++;
		

		<?php
				
			

		}
		//debug($allRestaurants);
		?>
 }

loadMap();


</script>
