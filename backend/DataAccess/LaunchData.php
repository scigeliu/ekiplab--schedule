<?php 

include_once '/backend/DTO/Launch.php';

class LaunchData {
	
	// specify your own database credentials
	//private $url = "https://launchlibrary.net/1.4/launch/";
 
	// get the database connection
	public function getNext($num){
		$url = "https://launchlibrary.net/1.4/launch/next/" .$num;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		$result = curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($result);
		
		$scheduled = Array();
		
		foreach($obj->launches as $jsonObj){
			$launch = $this->convertJsonToDto($jsonObj);
			$scheduled[] = $launch;
		}
		return $scheduled;

	}
	
	public function getForDate($dateFrom,$dateTo){
		$url = "https://launchlibrary.net/1.4/launch/" .$dateFrom .'/'.$dateTo;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		$result = curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($result);
		
		$scheduled = Array();
		
		foreach($obj->launches as $jsonObj){
			$launch = $this->convertJsonToDto($jsonObj);
			$scheduled[] = $launch;
		}
		return $scheduled;
	}
	
	private function convertJsonToDto($jsonObj){
		$launch = new Launch();
		
		$launch->name = $jsonObj->name;
		$launch->windowstart = $jsonObj->isostart;
		$launch->windowend = $jsonObj->isoend;
		$launch->location = $jsonObj->location->name;
		$launch->rocket = $jsonObj->rocket->name;
		$launch->image = $jsonObj->rocket->imageURL;
		
		return $launch;
	}

}