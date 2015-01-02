<!doctype html>
<html lang="en">
<head>
<title>Directions</title>
</head>
<body>
<div id="companymap">
  <style>
#map-canvas, #map_canvas {
	height: 40%;
	width: 35%;
}
#panel {
	top: 10px;
	float:left;
	left: 50%;
	padding: 5px;
	
}
</style>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  <?php
// Get lat and long by address      
	    $address1 = str_replace('+',' ',$destination);
		$prepAddr = str_replace(' ','+',$destination);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;

?>
  <script>
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {

  directionsDisplay = new google.maps.DirectionsRenderer();
  var chicago = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
  var mapOptions = {
    zoom:14,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: chicago
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  
  var marker = new google.maps.Marker({
   position: new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>),
   map: map,
   title: '<?php echo $address1;?>'
  });
  
  directionsDisplay.setMap(map);
}

function calcRoute() {
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
  
    directionsDisplay.setPanel(document.getElementById('panel'));
			
	var a=document.getElementById('start').value;
	var b=document.getElementById('end').value;
    var request = {

    origin: a, 
    destination: b,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
     };

	directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
		$("#panel").show();
        directionsDisplay.setDirections(response);
    	directionsDisplay.setDirections(response);
      	distance = "km->"+response.routes[0].legs[0].distance.text;
      	distance += "   walking->"+response.routes[0].legs[0].duration.text;
		 }
		});
}


google.maps.event.addDomListener(window, 'load', initialize);

    </script> 
  
  <div style="margin-top:5px;margin-bottom:5px;"> <b>Start: </b>
    <input type="text" name="start" id="start" onChange="calcRoute();">
    <b>End: </b>
    <select id="end" onChange="calcRoute();">
      <option value=<?php echo $prepAddr;?>><?php echo $address1;?></option>
    </select>
  </div>
  <div id="map-canvas" style="width:600px;height:250px;border:1px solid #CCCCCC"></div>
  <div id="panel" style="width:600px; font-size:12px;height:auto;"></div>
</div>
</body>
</html>