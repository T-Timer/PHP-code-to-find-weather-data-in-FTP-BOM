<?php

$ftp_username = "anonymous";
$ftp_userpass = "guest";
//Use this try to test success connection to ftp server.
try {
	$server = "ftp.bom.gov.au";
    $con = ftp_connect($server);
	ftp_pasv($con , TRUE); // bypassing firewall on the ftp server side. 
    if (false === $con) {
        throw new Exception('Unable to connect');
    }

    $loggedIn = ftp_login($con, $ftp_username ,  $ftp_userpass);
    if (true === $loggedIn) {
        echo 'Connection to server is successful.';
    } else {
        throw new Exception('Unable to log in');
    }

    //print_r(ftp_nlist($con, "."));
    
} catch (Exception $e) {
    echo "Failure: " . $e->getMessage();
}
//End of try method.

//echo "Current directory: " . ftp_pwd($con) . "\n";

// try to change the directory to somedir
if (ftp_chdir($con, "anon/gen/fwo/")) {
    echo "<br>Current directory is now: " . ftp_pwd($con) . "\n";
} else { 
    echo "Couldn't change directory\n";
}
echo "<br><br>";

//Downloading the xml file and save it to a file called NSW_WeatherStations. 
$local_fileNSW = "NSW_WeatherStations";
$server_fileNSW = "IDN60920.xml";

$local_fileWA = "WA_WeatherStations";
$server_fileWA = "IDW60920.xml";

$local_fileQLD = "QLD_WeatherStations";
$server_fileQLD = "IDQ60920.xml";
// download server file

if (ftp_get($con, $local_fileNSW, $server_fileNSW, FTP_ASCII))
  {
  echo "Successfully written to $local_fileNSW. ";
  }
else
  {
  echo "Error downloading $server_fileNSW.";
  }
 if (ftp_get($con, $local_fileWA, $server_fileWA, FTP_ASCII))
  {
  echo "Successfully written to $local_fileWA. ";
  }
else
  {
  echo "Error downloading $server_fileWA.";
  }
 if (ftp_get($con, $local_fileQLD, $server_fileQLD, FTP_ASCII))
  {
  echo "Successfully written to $server_fileQLD. ";
  }
else
  {
  echo "Error downloading $local_fileQLD.";
  }


//Loading the NSW_WeatherStations file. 
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

	/* Broken code. Working but because the elements are added and subtracted on basis that's why this is unreliable.
		public function getWeatherSydneyAirport()
	{
	$doc = new DOMDocument(); 
	$doc->load("NSW_WeatherStations");
	$searchNode = $doc->getElementsByTagName("station" ); 

		foreach( $searchNode as $searchNode ) 
		{ 
		$valueStation = $searchNode->getAttribute('stn-name'); 

		$xmlWindDirection = $searchNode->getElementsByTagName( "element" ); 
		$valueWindDirection = $xmlWindDirection->item(0)->nodeValue; 
		$valueWindSpeedKm = $xmlWindDirection->item(0)->nodeValue; 
		$valueWindSpeedKnots = $xmlWindDirection->item(0)->nodeValue; 

			if($valueStation == "SYDNEY AIRPORT AMO")
			{
				$valueWindDirection = $xmlWindDirection->item(12)->nodeValue; 
				$valueWindSpeedKm = $xmlWindDirection->item(14)->nodeValue;
				$valueWindSpeedKnots = $xmlWindDirection->item(15)->nodeValue; 
				echo "Station name: $valueStation <br> Wind direction: $valueWindDirection <br>
				Wind speed in km: $valueWindSpeedKm<br> Wind speed in knots: $valueWindSpeedKnots<br><br>";
				break;
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

		$xmlWindDirection = $searchNode->getElementsByTagName( "element" ); 
		$valueWindDirection = $xmlWindDirection->item(0)->nodeValue; 
		$valueWindSpeedKm = $xmlWindDirection->item(0)->nodeValue; 
		$valueWindSpeedKnots = $xmlWindDirection->item(0)->nodeValue; 

			if($valueStation == "GARDEN ISLAND HSF")
			{
				$valueWindDirection = $xmlWindDirection->item(9)->nodeValue; 
				$valueWindSpeedKm = $xmlWindDirection->item(11)->nodeValue;
				$valueWindSpeedKnots = $xmlWindDirection->item(12)->nodeValue; 
				echo "Station name: $valueStation <br> Wind direction: $valueWindDirection <br>
				Wind speed in km: $valueWindSpeedKm<br> Wind speed in knots: $valueWindSpeedKnots<br><br>";
				break;
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

		$xmlWindDirection = $searchNode->getElementsByTagName( "element" ); 
		$valueWindDirection = $xmlWindDirection->item(0)->nodeValue; 
		$valueWindSpeedKm = $xmlWindDirection->item(0)->nodeValue; 
		$valueWindSpeedKnots = $xmlWindDirection->item(0)->nodeValue; 

			if($valueStation == "HERVEY BAY AIRPORT")
			{
				$valueWindDirection = $xmlWindDirection->item(12)->nodeValue; 
				$valueWindSpeedKm = $xmlWindDirection->item(14)->nodeValue;
				$valueWindSpeedKnots = $xmlWindDirection->item(15)->nodeValue; 
				echo "Station name: $valueStation <br> Wind direction: $valueWindDirection <br>
				Wind speed in km: $valueWindSpeedKm<br> Wind speed in knots: $valueWindSpeedKnots<br><br>";
			}
		}
	}*/


/* Successful tests

class Library
{
    private $xmlPath = "books.xml";
    private $domDocument;
	private $doc;


    public function __construct() {
        $doc = new DOMDocument(); 
		$doc->load("books.xml"); 
    }

    public function __destruct() {
		unset($this->domDocument);     }

    public function getBookByISBN() {

	$doc = new DOMDocument(); 
	$doc->load("books.xml");
	$searchNode = $doc->getElementsByTagName("book" ); 

		foreach( $searchNode as $searchNode ) 
			{ 
			$valueISBN = $searchNode->getAttribute('isbn'); 

			$xmlTitle = $searchNode->getElementsByTagName( "title" ); 
			$valueTitle = $xmlTitle->item(0)->nodeValue; 

			$xmlAuthor = $searchNode->getElementsByTagName( "author" ); 
			$valueAuthor = $xmlAuthor->item(0)->nodeValue;
			
			echo "$valueISBN - $valueTitle - $valueAuthor\n"; 	
			}
	}
}


*/
?>