<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />



<?php
require("/home8/sjurscom/public_html/src/functions.php");

dbconnect();
mysql_select_db('sjurscom_ig');

$zipRegion1 = array();
$zipRegion2 = array();
$zipRegion3 = array();
$zipRegion4 = array();
$zipRegion5 = array();
$zipRegion6 = array();
$zipRegion7 = array();
$zipRegion8 = array();
$zipRegion9 = array();


array_push($zipRegion1, 10282, 10281, 10280, 10004, 10006, 10271, 10005, 10045, 10038, 10007, 10279, 10278, 10013, 10002);
array_push($zipRegion2, 10012, 10009, 10003, 10014, 10011, 10010, 10016, 10122, 10199, 10001, 10119, 10118, 10158);
array_push($zipRegion3, 10018, 10036, 10019, 10017, 10022, 10110, 10065, 10168, 10170, 10174, 10167, 10169, 10175, 10176, 10177, 10171, 10172, 10154, 10152, 10153, 10155, 10103, 10112, 10111, 10020, 10105, 10107);
array_push($zipRegion4, 10069, 10023, 10065, 10021, 10075, 10028, 10162); 
array_push($zipRegion5, 10128, 10024, 10029);
array_push($zipRegion6, 10025, 10026, 10035);
array_push($zipRegion7, 10027, 10030, 10037);
array_push($zipRegion8, 10031, 10032, 10039);
array_push($zipRegion9, 10033, 10040, 10034);

//$sql = "SELECT * FROM `restaurants` WHERE BORO = 1 LIMIT 400"; 

//$result = mysql_query($sql);




?>

<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
  function initialize() {
	  
	  
<?php include("map_styles.php");?>


	  
	  	var zipRegionAreas = Array();
		
	
    	var latlng = new google.maps.LatLng(40.790000,-73.965000);
		
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


		
		
	var zipRegion1Coords = [
    new google.maps.LatLng(40.704497, -74.016652),
    new google.maps.LatLng(40.725836444469394, -74.0110731124878),
    new google.maps.LatLng(40.72408018073348, -73.99253368377686),
    new google.maps.LatLng(40.71868100570399, -73.97493839263916),
	new google.maps.LatLng(40.71139467772733, -73.97871494293213),
	new google.maps.LatLng(40.70879222448318, -73.99768352508545),
	new google.maps.LatLng(40.701960300805645, -74.00952816009521),
	new google.maps.LatLng(40.7016349536258, -74.01510715484619),
	];
	
	var zipRegion2Coords = [
    new google.maps.LatLng(40.725836444469394, -74.0110731124878),
    new google.maps.LatLng(40.72408018073348, -73.99253368377686),
    new google.maps.LatLng(40.71868100570399, -73.97493839263916),
	new google.maps.LatLng(40.72889353375019, -73.97167682647705),
	new google.maps.LatLng(40.73591780252244, -73.9747667312622),
	new google.maps.LatLng(40.74736317009753, -73.9685869216919),
	new google.maps.LatLng(40.75685612820658, -74.00497913360596),
	new google.maps.LatLng(40.749378911525234, -74.00806903839111),
	];
	
	var zipRegion3Coords = [
	new google.maps.LatLng(40.74736317009753, -73.9685869216919),
	new google.maps.LatLng(40.75867654062536, -73.95880222320557),
	new google.maps.LatLng(40.772913046537546,-73.99364948272705),
	new google.maps.LatLng(40.75685612820658, -74.00497913360596),

	
	];
	
	var zipRegion4Coords = [
	new google.maps.LatLng(40.75867654062536, -73.95880222320557),
	new google.maps.LatLng(40.77635795263519, -73.94249439239502),
	new google.maps.LatLng(40.78285728898757, -73.94378185272217),
	new google.maps.LatLng(40.781037538909814,-73.98772716522217),
	new google.maps.LatLng(40.772913046537546,-73.99364948272705),
	
	];
	
	var zipRegion5Coords = [
	new google.maps.LatLng(40.78285728898757, -73.94378185272217),
	new google.maps.LatLng(40.7942090207447, -73.93122911453247),
	//new google.maps.LatLng(40.8006091511052, -73.94642114639282),
	new google.maps.LatLng(40.79690559758898,-73.94929647445679),
	new google.maps.LatLng(40.79310436728126,-73.97968053817749),
	new google.maps.LatLng(40.781037538909814,-73.98772716522217),
	
	];
	
	var zipRegion6Coords = [
	new google.maps.LatLng(40.7942090207447, -73.93122911453247),
	
	new google.maps.LatLng(40.80063838866519, -73.92966270446777),
	new google.maps.LatLng(40.80700541588734, -73.93343925476074),
	new google.maps.LatLng(40.80785322413584, -73.9690375328064),
	
	new google.maps.LatLng(40.79310436728126,-73.97968053817749),
		new google.maps.LatLng(40.79690559758898,-73.94929647445679),
			//new google.maps.LatLng(40.8006091511052, -73.94642114639282),
	
	];
	
	var zipRegion7Coords = [
	new google.maps.LatLng(40.80700541588734, -73.93343925476074),
	
	new google.maps.LatLng(40.819501637716726, -73.9341688156128),
	new google.maps.LatLng(40.8201306090747, -73.95968198776245),
	
	new google.maps.LatLng(40.80785322413584, -73.9690375328064),
	
	];
	
	var zipRegion8Coords = [
	new google.maps.LatLng(40.819501637716726, -73.9341688156128),
	
	new google.maps.LatLng(40.834025996795624, -73.93515586853027),
	new google.maps.LatLng(40.84272739765821, -73.9310359954834),
	new google.maps.LatLng(40.848509301526974, -73.94663572311401),
	new google.maps.LatLng(40.834483823042284, -73.94981145858765),
	
	
	new google.maps.LatLng(40.8201306090747, -73.95968198776245),
	
	];
	
	var zipRegion9Coords = [
	new google.maps.LatLng(40.84272739765821, -73.9310359954834),
	
	new google.maps.LatLng(40.868824746669645, -73.91129493713379),
	new google.maps.LatLng(40.87297859981961, -73.91146659851074),
	new google.maps.LatLng(40.8770023965494, -73.92365455627441),
	new google.maps.LatLng(40.875444826827426, -73.92949104309082),
	
	
	new google.maps.LatLng(40.848509301526974, -73.94663572311401),
	
	];
	
	var myFillOpacity = 0.8;
	var myStrokeOpacity = 0.5;
	var myStrokeWeight = 1;
	var myStrokeColor = "#000000";
	
	zipRegionAreas[0] = new google.maps.Polygon({
    paths: zipRegion1Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#F00000",
    fillOpacity: myFillOpacity
  });

	zipRegionAreas[1] = new google.maps.Polygon({
    paths: zipRegion2Coords,
     strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#A00000",
    fillOpacity: myFillOpacity
  });
	
	zipRegionAreas[2] = new google.maps.Polygon({
    paths: zipRegion3Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#F00000",
    fillOpacity: myFillOpacity
  });
	
	zipRegionAreas[3] = new google.maps.Polygon({
    paths: zipRegion4Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#FF4500",
    fillOpacity: myFillOpacity
  });
	zipRegionAreas[4] = new google.maps.Polygon({
    paths: zipRegion5Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#FF4500",
    fillOpacity: myFillOpacity
  });
		zipRegionAreas[5] = new google.maps.Polygon({
    paths: zipRegion6Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#FFBB00",
    fillOpacity: myFillOpacity
  });
	zipRegionAreas[6] = new google.maps.Polygon({
    paths: zipRegion7Coords,
     strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#FFBB00",
    fillOpacity: myFillOpacity
  });
	zipRegionAreas[7] = new google.maps.Polygon({
    paths: zipRegion8Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#FF9900",
    fillOpacity: myFillOpacity
  });
	zipRegionAreas[8] = new google.maps.Polygon({
    paths: zipRegion9Coords,
    strokeColor: myStrokeColor,
    strokeOpacity: myStrokeOpacity,
    strokeWeight: myStrokeWeight,
    fillColor: "#FFBB00",
    fillOpacity: myFillOpacity
  });	

	
	for(var i = 0;i<zipRegionAreas.length;i++) {
	zipRegionAreas[i].setMap(map);
	}

	

 	}


</script>
<link href="restaurants.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="initialize()">
<div id="wrapper">
   <div id="left_column"></div>
   <div id="map_canvas_wrapper">
  		<div id="map_canvas">

       <span id="labels">
  <div class="number_label_1">289</div>
  <div class="number_label_2">289</div>
  <div class="number_label_3">289</div>
  <div class="number_label_4">289</div>
  <div class="number_label_5">289</div>
  <div class="number_label_6">289</div>
  <div class="number_label_7">289</div>
  <div class="number_label_8">89</div>
  <div class="number_label_9">289</div>
  </span>
  </div>

  <div id="right_column"></div>
</div>
  
</body>
</html>