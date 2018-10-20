<?php 

include_once '/backend/DataAccess/LaunchData.php';
include_once '/backend/DTO/Launch.php';

class LaunchDao {
	
	public function getScheduledLaunch($num){
		$launchData = new LaunchData();
		return $launchData->getNext($num);
	}
	
	
	public function getScheduledLaunchForDate($dateFrom,$dateTo){
		$launchData = new LaunchData();
		return $launchData->getForDate($dateFrom,$dateTo);
	}
	
	//return $this->getLaunchMock();
	
	private function getLaunchMock(){
		$scheduled = Array();
		
		$launch1 = new Launch();
		$launch1->setLaunchDate('26/10/2018');
		$launch1->setLaunchWindow('4:00 - 5:30');
		$launch1->setMission('ICON (Ionospheric Connection Explorer)');
		$launch1->setDescription('The Ionospheric Connection Explorer will study the frontier of space: the dynamic zone high in our atmosphere where Earth weather and space weather meet. ICON will launch from Cape Canaveral Air Force Station in Florida aboard an Northrop Grumman Pegasus XL rocket.');

		$scheduled[] = $launch1;

		$launch2 = new Launch();
		$launch2->setLaunchDate('15/11/2018');
		$launch2->setLaunchWindow('4:49');
		$launch2->setMission('Northrop Grumman Resupply Mission to Space Station (CRS-10)');
		$launch2->setDescription('Northrop Grumman  s tenth contracted commercial resupply services mission, launching aboard an Antares rocket from Wallops Flight Facility in Virginia, will deliver several tons of cargo including crew supplies and science experiments to the International Space Station.');

		$scheduled[] = $launch2;

		$launch3 = new Launch();
		$launch3->setLaunchDate('26/11/2018');
		$launch3->setLaunchWindow('');
		$launch3->setMission('InSight Landing on Mars');
		$launch3->setDescription('The Entry, Descent and Landing phase is the final plunge of the Mars InSight Lander through the Martian atmosphere. It lasts about six minutes and delivers the lander safely to the surface of the Red Planet.');

		$scheduled[] = $launch3;
		
		return $scheduled;
	}
}

?>