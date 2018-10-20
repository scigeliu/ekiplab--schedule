<?php

include_once '/backend/ProfileDao.php';

$request_method = $_SERVER['REQUEST_METHOD'];
$input_data = json_decode(file_get_contents('php://input'),true);

if($request_method =='PUT' && $input_data['method'] == 'updateCoins'){
	$profileId = $input_data['id'];
	$coins = $input_data['coins'];
	$profileDao = new ProfileDao();
	$profile = $profileDao->updateCoins($profileId,$coins);
	http_response_code(200);
	print json_encode(array('status'=>'ok'));	
} elseif($request_method =='PUT' && $input_data['method'] == 'updateScore'){
	$profileId = $input_data['id'];
	$score = $input_data['score'];
	$profileDao = new ProfileDao();
	$profile = $profileDao->updateScore($profileId,$score);
	http_response_code(200);
	print json_encode(array('status'=>'ok'));	
} elseif($request_method == "GET"){
	$id = $_GET['profileId'];
	$profileDao = new ProfileDao();
	$profile = $profileDao->getProfileDetail($id);
	http_response_code(200);
	print json_encode($profile);	
} elseif($request_method == "POST"){

	http_response_code(200);
	print json_encode($scheduled);	
}
?>