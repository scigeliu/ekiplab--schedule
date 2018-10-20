<?php

include_once '/backend/ProfileDao.php';
include_once '/backend/DTO/Profile.php';

$request_method = $_SERVER['REQUEST_METHOD'];
$input_data = json_decode(file_get_contents('php://input'),true);

if($request_method =='PUT' && $input_data['method'] == 'updateCoins'){
	$profileId = $input_data['id'];
	$coins = $input_data['coins'];
	$profileDao = new ProfileDao();
	$return = $profileDao->updateCoins($profileId,$coins);
	if($return == '0K'){
		http_response_code(200);
		print json_encode(array('status'=>'ok'));	
	} else {
		http_response_code(200);
		print json_encode(array('status'=>'ko'));		
	}
} elseif($request_method =='PUT' && $input_data['method'] == 'updateScore'){
	$profileId = $input_data['id'];
	$score = $input_data['score'];
	$profileDao = new ProfileDao();
	$return = $profileDao->updateScore($profileId,$score);
	if($return == '0K'){
		http_response_code(200);
		print json_encode(array('status'=>'ok'));	
	} else {
		http_response_code(200);
		print json_encode(array('status'=>'ko'));		
	}	
} elseif($request_method == "GET"){
	$id = $_GET['profileId'];
	$profileDao = new ProfileDao();
	$profile = $profileDao->getProfileDetail($id);
	http_response_code(200);
	print json_encode($profile);	
} elseif($request_method == "POST"){
	$profile = new Profile();
	$profile->username = $input_data['username'];
	$profile->level = 1;
	$profile->coins = $input_data['coins'];
	$profile->score = 0;
	$profileDao = new ProfileDao(); 	
	$return = $profileDao->insertProfile($profile);

	if($return == '0K'){
		http_response_code(200);
		print json_encode(array('status'=>'ok'));	
	} elseif($return == 'DUPLICATE') {
		http_response_code(200);
		print json_encode(array('status'=>'ko',"message"=>'username in duplicate'));		
	} else {
		http_response_code(200);
		print json_encode(array('status'=>'ko',"message"=>$return));		
	}	
}
?>