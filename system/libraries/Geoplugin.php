<?php
/*
This PHP class is free software: you can redistribute it and/or modify
the code under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. 

However, the license header, copyright and author credits 
must not be modified in any form and always be displayed.

This class is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

@author geoPlugin (gp_support@geoplugin.com)
@copyright Copyright geoPlugin (gp_support@geoplugin.com)
$version 1.01


This PHP class uses the PHP Webservice of http://www.geoplugin.com/ to geolocate IP addresses

Geographical location of the IP address (visitor) and locate currency (symbol, code and exchange rate) are returned.

See http://www.geoplugin.com/webservices/php for more specific details of this free service
*/

class CI_Geoplugin {
	
	var $latitude = null;
	var $longitude = null;
	
	function get_geolocation($ip) 
	{
	
		$d = file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip");

		$data = unserialize($d);
		//set the geoPlugin vars
		$this->ip = $ip;
		$this->city = $data['geoplugin_city'];
		$this->region = $data['geoplugin_region'];
		$this->areaCode = $data['geoplugin_areaCode'];
		$this->dmaCode = $data['geoplugin_dmaCode'];
		$this->countryCode = $data['geoplugin_countryCode'];
		$this->countryName = $data['geoplugin_countryName'];
		$this->continentCode = $data['geoplugin_continentCode'];
		$latitude = $data['geoplugin_latitude'];
		$longitude = $data['geoplugin_longitude'];
		$this->currencyCode = $data['geoplugin_currencyCode'];
		$this->currencySymbol = $data['geoplugin_currencySymbol'];
		$this->currencyConverter = $data['geoplugin_currencyConverter'];
		return $data;
	
	}
	function nearby($radius, $limit=null, $latitude, $longitude) {
		
		if ( ($latitude == 0) || ($longitude == 0)) {
			trigger_error ('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
			return array( 'geoPlugin class Warning: Incorrect latitude or longitude values.' );
		}
		else
		{
			$nearby = file_get_contents("http://www.geoplugin.net/extras/nearby.gp?lat=" . $latitude . "&long=" . $longitude . "&radius={$radius}");
			$data= unserialize( $nearby );
			return $data;
		}
		
		
		

	}
}

?>
