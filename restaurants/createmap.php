<!DOCTYPE html>
<html>
<head>
<!-- <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> -->




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

$sql = "SELECT * FROM `restaurants` WHERE BORO = 1 LIMIT 400"; 

$result = mysql_query($sql);




?>

<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">

  function initialize() {
	
    var latlng = new google.maps.LatLng(40.79,-73.975);
    var myOptions = {
      zoom: 12,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
	var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	var markers = new Array();
	var contentStrings = new Array();
	var i=0;
	infoWindow2 = new google.maps.InfoWindow();
	
    <?php
				$i = 0;
		while($res = mysql_fetch_assoc($result)) {

			
			if(in_array($res['ZIPCODE'], $zipRegion9)) {

	
	
	?>
     	var myLatlng = new google.maps.LatLng(<?php echo $res['LAT']; ?>,<?php echo $res['LNG']; ?>);

        markers[i] = new google.maps.Marker({
            position: myLatlng,
			map: map,
			icon: "marker.png",
			title: "<?php echo $res['DBA']; ?>",
			
            
        });
				
		contentStrings["<?php echo $res['DBA']; ?>"] = "<?php println($res['DBA']); println($res['BUILDING'].' '.$res['STREET'].', '.$res['ZIPCODE'].', NY'); ?>";

		

		google.maps.event.addListener(markers[i], 'mouseover', function() {
		
		//infoWindow2.close();
		infoWindow2.setPosition(this.position);
		infoWindow2.setContent(contentStrings[this.title]);
		
		infoWindow2.open(map);
		});
		
		i++;
		

		<?php
				$i++;
			}

		}
		?>
 }


</script>
<link href="restaurants.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="initialize()">
	<div id="wrapper">
  <div id="map_canvas"></div>
  <div id="info_text"><?php echo $i; ?></div>
  </div>
</body>
</html>