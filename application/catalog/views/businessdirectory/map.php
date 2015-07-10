<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Travel modes in directions</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
     <?php $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".$address."&sensor=false");
    $json = json_decode($json);

     $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
     $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}; 
     // current Ip get lat long
     //$ip = '107.170.167.130';
     $ip = $_SERVER['REMOTE_ADDR'];
     $d  = file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip");

		$data = unserialize($d);
		$clatitude = $data['geoplugin_latitude'];
		$clongitude = $data['geoplugin_longitude'];
     
     ?>
    <script>
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

var from = new google.maps.LatLng(<?php echo $clatitude;?> , <?php echo $clongitude;?> );
var to = new google.maps.LatLng(<?php echo $lat;?> , <?php echo $long;?> );

// Test Lat long
//var haight = new google.maps.LatLng(28.1287597, -82.5076474);
//var oceanBeach = new google.maps.LatLng(28.1279088, -82.5046026);

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    zoom: 14,
    center: from
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
}

function calcRoute() {
  var selectedMode = document.getElementById('mode').value;
  var request = {
      origin: from,
      destination: to,
      // Note that Javascript allows us to access the constant
      // using square brackets and a string value as its
      // "property."
      travelMode: google.maps.TravelMode[selectedMode]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
	  
    <div id="panel">
		<?php //echo $clatitude.',' .$clongitude;?>
		<?php //echo $lat.','.$long;?>
    <b>Mode of Travel: </b>
    <select id="mode" onchange="calcRoute();">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
   
    <div id="map-canvas"></div>
  </body>
</html>
