<?php

include_once 'backend/LaunchDao.php';

$method = $_GET['method'];

if($method =='getNext'){
	$num = $_GET['num'];
	$launchDao = new LaunchDao();
	$scheduled = $launchDao->getScheduledLaunch($num);
	http_response_code(200);
	print json_encode($scheduled,JSON_UNESCAPED_SLASHES);	

} elseif($method =='getForDate'){
	$dateFrom = $_GET['dateFrom'];
	$dateTo = $_GET['dateTo'];
	
	$launchDao = new LaunchDao();
	$scheduled = $launchDao->getScheduledLaunchForDate($dateFrom,$dateTo);
	http_response_code(200);
	print json_encode($scheduled,JSON_UNESCAPED_SLASHES);	
}
?>