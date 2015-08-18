<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style>
		@media only screen and (min-width: 310px) and (max-width: 770px)  
		{
			#panel {position: absolute;left: 0;margin-left: 0px;z-index: 5;background-color: #fff;padding: 5px;float: left;clear: left;top: 8%;}
		}
        html, body, #map-canvas 
        {
          height: 100%;
          margin: 0px;
          padding: 0px
        }
      #error{color:red;display:none;text-align:center; }
	  .search { background:#005cb9;color:#fff;border-style:none;padding: 5px;} 
      
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <?php 
    $ip = '107.170.167.130';
     //$ip = $_SERVER['REMOTE_ADDR'];
     $d  = file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip");

		$data = unserialize($d);
		$clatitude = $data['geoplugin_latitude'];
		$clongitude = $data['geoplugin_longitude'];
		?>
    <script>
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var initialLocation;
var browserSupportFlag =  new Boolean();

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
  var marker = new google.maps.Marker({
    position: chicago
  
});

// To add the marker to the map, call setMap();
marker.setMap(map);
	navigator.geolocation.getCurrentPosition(function(position) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              //"location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
              "location": new google.maps.LatLng(<?php echo $clatitude;?> , <?php echo $clongitude;?> )
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK)
                $("#start").val(results[0].formatted_address);
              else
                $("#error").append("Unable to retrieve your address<br />");
            });
             });

}

function calcRoute(start,end) {

  //var start = document.getElementById('start').value;
  //var end = document.getElementById('end').value;
  var selectedMode ='DRIVING';
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
        
          calcRoute($("#start").val(), $("#end").val());
        });
      });
    </script>
  </head>
  <body>
    <div id="panel">
		<form id="calculate-route" name="calculate-route" action="#" method="get">
   
   <input type="hidden" id="start">
   
    <input type="text" id="end">
    
    <input type="submit" value="Get Direction" class="search" />
     
       <p id="error"><b>Unable to retrieve your route</b><br /></p>
    </form>
    </div>
    <div id="map-canvas"></div>
  </body>
</html>
