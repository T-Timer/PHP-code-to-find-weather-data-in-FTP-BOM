<?php

$ftp_username = "anonymous";
$ftp_userpass = "guest";
//Connect code is removed

$xml=simplexml_load_file("NSW_WeatherStations") or die("Error: Cannot create object");
//print_r($xml); //Prints the entire file onto the screen. 

$xmlDoc = new DOMDocument();

$weather = new Weather();
echo "<br><br>";
$weather -> getWeatherSydneyAirport();
$weather -> getWeatherHerveyBay();
$weather -> getWeatherGardenIsland();

class Weather
{
		public function getWeatherSydneyAirport()
		{
		$doc = new DOMDocument(); 
		$doc->load("NSW_WeatherStations");
		$searchNode = $doc->getElementsByTagName("station" ); 

		foreach( $searchNode as $searchNode ) 
		{ 
		$valueStation = $searchNode->getAttribute('stn-name'); 
		$xmlElement = $searchNode->getElementsByTagName( "element" ); 

		
		if($valueStation == "SYDNEY AIRPORT AMO")
			{
			//Test each wind_dir, km, and knots for index i in while loop
			echo "Station name: $valueStation<br>";
			$i = 1;
			while(true)
			{
			$wind = $xmlElement->item($i)->getAttribute('type');
			if($wind == "wind_dir")
			{
				$windD = $xmlElement->item($i)->nodeValue;
				echo "Wind direction is: $windD<br>";
				break;
			}
			else
			$i++;
			}
						while(true)
						{
						$kmType = $xmlElement->item($i)->getAttribute('type');
						if($kmType == "wind_spd_kmh")
						{
							$kmValue = $xmlElement->item($i)->nodeValue;
							echo "Wind speed in km is: $kmValue<br>";
							
							break;
						}
						else
						$i++;
						}
			
			while(true)	//This code assumes the type attributes exist. If the type attribute doesn't exist, will get in dex out of bounds.
			{
			$knotsType = $xmlElement->item($i)->getAttribute('type');
			if($knotsType == "wind_spd")
			{
				$knotsValue = $xmlElement->item($i)->nodeValue;
				echo "Wind speed in knots is: $knotsValue<br><br>";
				break;
			}
			else
			$i++;
			}
			break; //To stop looping more than what's required.
			
			}			
		}
	}
	
			public function getWeatherHerveyBay()
	{
		$doc = new DOMDocument(); 
		$doc->load("QLD_WeatherStations");
		$searchNode = $doc->getElementsByTagName("station" ); 

		foreach( $searchNode as $searchNode ) 
		{ 
		$valueStation = $searchNode->getAttribute('stn-name'); 
		$xmlElement = $searchNode->getElementsByTagName( "element" ); 

		
		if($valueStation == "HERVEY BAY AIRPORT")
			{
			//Test each wind_dir, km, and knots for index i in while loop
			echo "Station name: $valueStation<br>";
			$i = 1;
			while(true)
			{
			$wind = $xmlElement->item($i)->getAttribute('type');
			if($wind == "wind_dir")
			{
				$windD = $xmlElement->item($i)->nodeValue;
				echo "Wind direction is: $windD<br>";
				break;
			}
			else
			$i++;
			}
						while(true)
						{
						$kmType = $xmlElement->item($i)->getAttribute('type');
						if($kmType == "wind_spd_kmh")
						{
							$kmValue = $xmlElement->item($i)->nodeValue;
							echo "Wind speed in km is: $kmValue<br>";
							
							break;
						}
						else
						$i++;
						}
			
			while(true)
			{
			$knotsType = $xmlElement->item($i)->getAttribute('type');
			if($knotsType == "wind_spd")
			{
				$knotsValue = $xmlElement->item($i)->nodeValue;
				echo "Wind speed in knots is: $knotsValue<br><br>";
				break;
			}
			else
			$i++;
			}
			break; //To stop looping more than what's required.
			
			}			
		}
	}
	
		public function getWeatherGardenIsland()
	{
		$doc = new DOMDocument(); 
		$doc->load("WA_WeatherStations");
		$searchNode = $doc->getElementsByTagName("station" ); 

		foreach( $searchNode as $searchNode ) 
		{ 
		$valueStation = $searchNode->getAttribute('stn-name'); 
		$xmlElement = $searchNode->getElementsByTagName( "element" ); 

		
		if($valueStation == "GARDEN ISLAND HSF")
			{
			//Test each wind_dir, km, and knots for index i in while loop
			echo "Station name: $valueStation<br>";
			$i = 1;
			while(true)
			{
			$wind = $xmlElement->item($i)->getAttribute('type');
			if($wind == "wind_dir")
			{
				$windD = $xmlElement->item($i)->nodeValue;
				echo "Wind direction is: $windD<br>";
				break;
			}
			else
			$i++;
			}
						while(true)
						{
						$kmType = $xmlElement->item($i)->getAttribute('type');
						if($kmType == "wind_spd_kmh")
						{
							$kmValue = $xmlElement->item($i)->nodeValue;
							echo "Wind speed in km is: $kmValue<br>";
							
							break;
						}
						else
						$i++;
						}
			
			while(true)
			{
			$knotsType = $xmlElement->item($i)->getAttribute('type');
			if($knotsType == "wind_spd")
			{
				$knotsValue = $xmlElement->item($i)->nodeValue;
				echo "Wind speed in knots is: $knotsValue<br><br>";
				break;
			}
			else
			$i++;
			}
			break; 
			
			}			
		}
	}
}


ftp_close($con);
//End of file.

?>
