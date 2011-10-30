

<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">

	var map;
	var markers = new Array();
	infoWindow2 = new google.maps.InfoWindow();
	
  function loadMap(lat, lng, zoomlevel) {
	
    <?php include("map_styles.php");?>
	
	
	var latlng = new google.maps.LatLng(lat, lng);
    
	
	
	var myOptions = {
      zoom: zoomlevel,
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
	
	function loadMarkers(searchString) {
		
	
	
		
	//markers = new Array();
	var contentStrings = new Array();
	var i=0;
	//infoWindow2 = new google.maps.InfoWindow();
	
    <?php
				
	foreach($allRestaurants as $restaurant)
	{
					
	?>
		//alert(<?php echo "\"".$restaurant->getCuisine()."\"";?>);
		var restaurantTitle = <?php echo "\"".$restaurant->getDba()."\""; ?> ;
		var latestInspectionDate = <?php echo "\"".$restaurant->getLatestClosedDate()."\""; ?>;
		var restaurantCuisine = <?php echo "\"".$restaurant->getCuisine()."\"";?>;
		var newestDate = <?php echo "\"".$restaurant->getNewestDate()."\"";?>
		
		//alert(restaurantCuisine+searchString);
		//alert((restaurantTitle.search(searchString.toUpperCase()))+searchString+" "+restaurantTitle);
		
		if((searchString == "ALL") || (restaurantTitle.search(searchString.toUpperCase()) > -1) 
			|| (restaurantCuisine.search(searchString) > -1) || (newestDate >= searchString)) 
		{
		
     	var myLatlng = new google.maps.LatLng(<?php echo $restaurant->getLat(); ?>,<?php echo $restaurant->getLng(); ?>);

        markers[i] = new google.maps.Marker({ 
            position: myLatlng,
			map: map,
			icon: "marker_8x8.png",
			title: "<?php echo $restaurant->getDba(); ?>"
			
            
        });
			
					

		contentStrings["<?php echo $restaurant->getDba(); ?>"] = "<?php println("<div class='restaurant_infowindow'><span class='bold'>". $restaurant->getDba()."</span>"); println($restaurant->getAddress()); 
		println("<br/>Category: ".$restaurant->getCuisine());
		println("<br/>".$restaurant->getClosedDatesAsString('<br/>'));
		if ($restaurant->getYelpScore() > 0 ) println("<br/><br/><a href='".$restaurant->getYelpUrl()."' target='_blank'><img src='yelp_logo_small.png' />&nbsp;<img src='".$restaurant->getYelpImage()."' class='yelp_image'/></a></div>"); ?>";

		

		google.maps.event.addListener(markers[i], 'mouseover', function() {
		
		//infoWindow2.close();
		infoWindow2.setPosition(this.position);
		infoWindow2.setContent(contentStrings[this.title]);
		
		infoWindow2.open(map);
		});
		
		i++;
		
		
		
		} //end if searchString == ALL or restaurantTitle.search.searchString
		
		
		
		<?php
				
		} //end foreach($allRestaurants as $restautant)
		
		?>
		
}

loadMap(40.790000,-73.955000, 12);


</script>
