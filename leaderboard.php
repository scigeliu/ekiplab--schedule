<?php

include_once '/backend/leaderbordDao.php';

$method = $_GET['method'];

if($method =='getLeaderboard'){
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