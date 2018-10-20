<?php

include_once '/backend/launchDao.php';

$method = $_GET['method'];

if($method =='getNext'){
	$num = $_GET['num'];
	$launchDao = new LaunchDao();
	$scheduled = $launchDao->getScheduledLaunch($num);
	print json_encode($scheduled);	

} elseif($method =='getForDate'){
	$dateFrom = $_GET['dateFrom'];
	$dateTo = $_GET['dateTo'];
	
	$launchDao = new LaunchDao();
	$scheduled = $launchDao->getScheduledLaunchForDate($dateFrom,$dateTo);
	print json_encode($scheduled);	
}
?>