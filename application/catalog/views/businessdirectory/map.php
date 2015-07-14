<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #error{color:red;display:none;text-align:center; }
		  
		  
	 
      #panel {
        position: absolute;
        top: 5px;
        left: 24%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <?php 
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

function initialize() {
	
  directionsDisplay = new google.maps.DirectionsRenderer();
  var chicago = new google.maps.LatLng(<?php echo $clatitude;?> , <?php echo $clongitude;?> );
  var mapOptions = {
    zoom:7,
    center: chicago,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
}

function calcRoute(start,end,mode) {
  //var start = document.getElementById('start').value;
  //var end = document.getElementById('end').value;
  var selectedMode =mode;
  var request = {
      origin:start,
      destination:end,
     travelMode: google.maps.TravelMode[selectedMode]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
		 $("#error").hide();
      directionsDisplay.setDirections(response);
    }
    else
    {
		 $("#error").show();
		
          }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
  $(document).ready(function() {
	   $("#calculate-route").submit(function(event) {
          event.preventDefault();
        
          calcRoute($("#start").val(), $("#end").val(),$("#mode").val());
        });
      });
    </script>
  </head>
  <body>
    <div id="panel">
		<form id="calculate-route" name="calculate-route" action="#" method="get">
    <b>Start: </b>
   <input type="text" id="start">
    <b>End: </b>
    <input type="text" id="end">
    <b> Mode:</b>
     <select id="mode">
	  <option value="DRIVING">Select Your Travel Mode</option>
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    <input type="submit" />
      <input type="reset" />
       <p id="error"><b>Unable to retrieve your route</b><br /></p>
    </form>
    </div>
    <div id="map-canvas"></div>
  </body>
</html>
