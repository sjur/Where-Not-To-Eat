<!DOCTYPE html>
<html>
<head>
<!-- <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> -->
<title>Where Not To Eat</title>

<?php
require_once("functions.php");

require_once("sql_load.php");



//$region = $_GET['region'];



//ZIPREGIONS SHOULD BE IN DB

include ("ziparrays.php");

?>


<link href="restaurants.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
  <div id="left_column">
  <!-- <a href="http://infographics.sjurs.com/nyc/restaurants/index4.php">&nbsp;reset all</a>-->
  <a href="index4.php" id="reset_all">&nbsp;reset all</a>
  <br/><img id="header_image" src="danger_knife_fork.png" />
  <a href="http://infographics.sjurs.com/nyc/restaurants/index2.php" id="header">where not to eat</a>

  <!-- <div id="nav"><a href="http://infographics.sjurs.com/nyc/restaurants/index2.php">help</a></div> -->
  <div id="tagline">Manhattan restaurants <br/>that have been <br/>temporarily <span class="red">closed</span> due <br/>to health violations in the <br/>previous 12 months</div>
  
  <div id="label_latest">
 latest closings
  </div>
  
  <div id="latest"><span class="number"><a href="javascript:getLatest('20101007')"><?php echo $lastWeek; ?> </span> this week</a><br/>
  <span class="number"><a href="javascript:getLatest('20100914')"><?php echo $lastMonth; ?></span> this month</a> 
  </div>
  <div id="search">
  <input name="search" type="text" value="Search for your favorite spot" size="50" id="search_field" onFocus="clearText(this)" onBlur="clearText(this)">
  </div>
    <div id="label_mini_map">
  click a region to zoom in
  <div id="mini_map_zoom_out" onClick="shiftMap(40.790000,-73.955000,12,0)">zoom out</div>
  <div id="mini_map_reset_all"><a href="index4.php">reset all</a></div>
  </div>

  <div id="mini_map">

  <?php require("mini_map.html"); ?>
 
  </div>
  <div id="cuisine_filter">
  	Select by category: 
	<select id="cuisine" onFocus="clearSearch()">
    <option selected value=""></option>
    <option value="ALL">All</option>
  	<?php
	
	foreach($allCuisinesByAlphabet as $key=>$a)
	{
		echo "<option value=\"$key\">$key</option>";	
		
		
	}
	
	?>

</select>
  
  </div>
  
  <div id="powered_by">
  
  Powered by:<br/><br/>
    <a href="http://www.nyc.gov/html/doh/html/home/home.shtml" target="_blank" title"NYC Department of Health"><img src="nyc-health-logo.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
  <a href="http://maps.google.com/" target="_blank"><img src="google-maps-logo-small.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
    
    <a href="http://yelp.com/" target="_blank"><img src="http://media1.px.yelpcdn.com/static/201012162846157596/img/developers/yelp_logo_50x25.png" alt="yelp_logo" /></a>
  
  </div>
  
  
  </div> <!-- end left column -->
   <div id="map_canvas_wrapper">
   
   
  		<div id="map_canvas">
        <h2> map loading..... </h2>
      	<?php
		if(!(isset($_GET['region']))) {  //if region isnt set, we need the homemap
			
			require("home_map4.php");

		?>
        

			
			
		<?php	
		}
		
		else { //we must zoom in on a region
		
			require("region_map4.php");
		
		}
		
		
		?>
	 
     	</div> 
                	
     
  </div>
  <div id="right_column">
	<a href="index4.php?about=true">about</a>
        <p/>

    <?php
    if($_GET['about'] == true) include("about.php"); 
	?>    
<div id="legal">Last update: 14th of October, 2010<br/>
    All data &copy; <a href="http://www.nyc.gov/html/doh/html/home/home.shtml" target="_blank">NYCDOHMH</a>
</div>
  </div> <!-- end right_column -->
</div>
<?php
		if(!(isset($_GET['region']))) { //if region isnt set we must also load all the markers

?>
 <script type="text/javascript">
 loadMarkers("ALL");

 function loadSearchMarkers(e)
 {
	//loadMarkers(document.getElementById('search_field').value); 
	//loadMap();
	//loadMarkers("m");
	 clearMarkers();
	loadMarkers(document.getElementById('search_field').value); 
	
 }
 function getLatest(period)
 {
	clearMarkers();
	loadMarkers(period);
	 
 }
 function clearMarkers()
 {

	for(var i=0;i<markers.length;i++)
	{
		markers[i].setMap(null);
	}
	infoWindow2.close();
 }
 
 var doSearch = document.getElementById('search_field');
 doSearch.addEventListener('keyup',loadSearchMarkers,false);

function clearText(field)
{	

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
	document.getElementById('cuisine').selectedIndex=0;

}
function clearSearch()
{
	var searchBox = document.getElementById('search_field');
	searchBox.value = searchBox.defaultValue;
	
}

var selectmenu = document.getElementById('cuisine');

selectmenu.onchange = function()
{
	var chosenoption=this.options[this.selectedIndex].value;
	clearMarkers();
	loadMarkers(chosenoption);
	
}

function shiftMap(lat, lng, zoomLevel, region) 
{
	latlng = new google.maps.LatLng(lat, lng, 12);
	map.panTo(latlng);
	map.setZoom(zoomLevel);
	changeMapImage(region);
	
}
function changeMapImage(region)
{
	document.getElementById('navmap').src  = "http://infographics.sjurs.com/nyc/restaurants/nav_region"+region+".png";
	
}
function searchByDate(range)
{
	var today="20101014";
	var searchRange = today - range;
	loadMarkers(searchRange);
	
	
}

 

 </script>
 
 <?php
		}
		//debug($allRestaurants);
		?>
</body>
</html>