<?php
require("RestaurantClass.php");

$sql = "SELECT * FROM `public_inspections`"; 

$result = mysql_query($sql);

?>


<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
  function loadMap() {
	  
	  
<?php include("map_styles.php");?>


	  
	  	var zipRegionAreas = Array();
		
	
    	var latlng = new google.maps.LatLng(40.790000,-73.915000);
		
    	var myOptions = {
      		zoom: 12,
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


		
		
  }


loadMap();
</script>

