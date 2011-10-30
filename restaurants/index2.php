<!DOCTYPE html>
<html>
<head>
<!-- <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> -->


<?php
require_once("/home8/sjurscom/public_html/src/functions.php");

dbconnect();
mysql_select_db('sjurscom_ig');



$region = $_GET['region'];



//ZIPREGIONS SHOULD BE IN DB

include ("ziparrays.php");

?>


<link href="restaurants.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
  <div id="left_column">
  <a href="http://infographics.sjurs.com/nyc/restaurants/index2.php">reset</a>
  <br/><img id="header_image" src="danger_knife_fork.png" />
  <a href="http://infographics.sjurs.com/nyc/restaurants/index2.php" id="header">where not to eat</a>

  <!-- <div id="nav"><a href="http://infographics.sjurs.com/nyc/restaurants/index2.php">help</a></div> -->
  <div id="tagline">Manhattan restaurants <br/>that have been <br/>temporarily <span class="red">closed</span> due <br/>to health violations in the <br/>last 12 months</div>
  
  <div id="label_latest">
 latest closings
  </div>
  
  <div id="latest"><span class="number">4&nbsp;</span> this week<br/>
  <span class="number">20</span> this month
  </div>
  <div id="search">
  <input name="search" type="text" value="Search for your favorite spot" size="50" id="search">
  </div>
    <div id="label_mini_map">
  click to select region
  </div>
  <div id="mini_map">

  <?php require("mini_map.html"); ?>
  </div>
  <div id="cuisine_filter">
  
	<select id="cuisine">
    <option>Select by cuisine</option>
  <option>African</option>
  <option>American</option>
  <option>Asian</option>
  <option>Cajun</option>
  <option>Chinese</option>
   <option>Egyptian</option>
    <option>French</option>
     <option>German</option>
      <option>Greek</option>
       <option>Indian</option>
        <option>Indonesian</option>
         <option>Italian</option>
          <option>Japanese</option>
          <option>Jewish/Kosher</option>
<option>Korean</option>
<option>Latin</option>
<option>Mediterranean</option>
<option>Mexican</option>
<option>Middle Eastern</option>
<option>Russian</option>
<option>Southwestern</option>
<option>Thai</option>
<option>Other</option>

</select>
  
  </div>
  </div> <!-- end left column -->
   <div id="map_canvas_wrapper">
   
   
  		<div id="map_canvas">
        <h2> map loading..... </h2>
      	<?php
		if(!(isset($_GET['region']))) {  //if region isnt set, we need the homemap
			
			require("home_map3.php");

		?>
        
        	<div id="about">
            <?php 
			require("about.php"); 
			?>
            </div>
			
			
		<?php	
		}
		
		else { //we must zoom in on a region
		
			require("region_map3.php");
		
		}
		
		
		?>
	 
     	</div> 
     
  </div>
</div>
<?php
		if(!(isset($_GET['region']))) { //if region isnt set we must also load all the markers

?>
 <script type="text/javascript">
 loadMarkers();
 </script>
 <?php
		}
		?>
</body>
</html>