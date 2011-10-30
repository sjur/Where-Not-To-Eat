<!DOCTYPE html>
<html>
<head>
<!-- <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> -->


<?php
require("/home8/sjurscom/public_html/src/functions.php");

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
  <a href="http://infographics.sjurs.com/nyc/restaurants/index2.php" id="header">where not to eat</a>

  <!-- <div id="nav"><a href="http://infographics.sjurs.com/nyc/restaurants/index2.php">help</a></div> -->
  <div id="tagline">Manhattan restaurants <br/>that have been <br/>temporarily <span class="red">closed</span> due <br/>to health violations in the <br/>last 12 months</div>
  <div id="latest"><span class="number">4</span> this week<br/>
  <span class="number">20</span> this month</div>
  <div id="search">
  <input name="search" type="text" value="Search for your favorite spot" size="50" id="search">
  </div>
  <div id="mini_map">
  <?php if((isset($_GET['region']))) require("mini_map.html");; ?>
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
  <div id="legal">Last update: 29th of November, 2010<br/>
    All data &copy; <a href="http://www.nyc.gov/html/doh/html/home/home.shtml" target="_blank">New York City Department of Health and Mental Hygiene</a>
  </div>
  </div> <!-- end left column -->
   <div id="map_canvas_wrapper">
   
   
  		<div id="map_canvas">
        
      	<?php
		if(!(isset($_GET['region']))) {  //if region isnt set, we need the homemap
			
			require("home_map.html");

		?>
        
        	<div id="about">
            <!-- <h2>about this infographic</h2> -->
            <p class="black">The New York City Department of Health and Mental Hygiene (DOHMH) has temporarily closed over 400 restaurants the previous 12 months due to various health violations and other violations.</p>

<p>This infographic shows you which restaurants that have been closed and where they are located. It also shows you how many times each business has been closed.</p>
<p>
There are a number of reasons why a restaurant will be temporarily closed by the DOHMH, it can be a combination of minor violations or one or more major ones. Common reasons are food handling and storage, the presence of vermin or rats, or insufficient licenses or certificates.</p>
<p>
A restaurant can be closed and re-closed after a second or third inspection. 
</p>
<p>
The intention of this infographic is to educate and inform people who are concerned about health and food safety. It is also meant as a resource for individuals interested in the restaurant business in Manhattan specifically. Hopefully it will also serve as a motivation to business owners to improve and comply to the current standards and regulations.
   </p>         
            </div>
			
			
		<?php	
		}
		
		else { //we must zoom in on a region
		
			require("region_map.php");
		
		
		}
		
		?>
	 
     	</div> 
     
  </div>
</div>
  
</body>
</html>