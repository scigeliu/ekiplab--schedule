<?php 

include_once 'backend/DTO/Launch.php';

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
			//print "<pre>"; print_r($jsonObj); print "</pre>"; 
			//exit();			
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
		if(is_array($jsonObj->missions) && !empty($jsonObj->missions[0])){
			$launch->missionName = $jsonObj->missions[0]->name;
			$launch->missionDescr = $jsonObj->missions[0]->description;	
			if(is_array($jsonObj->missions[0]->agencies) && !empty($jsonObj->missions[0]->agencies[0]) ){
				$launch->agency = $jsonObj->missions[0]->agencies[0]->name;	
			}
		}
		if(is_array($jsonObj->location->pads) && !empty($jsonObj->location->pads[0])){
			$launch->mapURL = $jsonObj->location->pads[0]->mapURL;
			$launch->latitude = $jsonObj->location->pads[0]->latitude;
			$launch->longitude = $jsonObj->location->pads[0]->longitude;	
		}
		
		return $launch;
	}

}