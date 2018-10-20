<?php

include_once '/backend/QuestDao.php';
include_once '/backend/DTO/Quest.php';
include_once '/backend/DTO/ProfileAnswer.php';

$request_method = $_SERVER['REQUEST_METHOD'];
$input_data = json_decode(file_get_contents('php://input'),true);


if($request_method == "GET"){
	$questDao = new QuestDao();
	$id = $_GET['profileId'];
	$questions = $questDao->getQuestList($id);
	http_response_code(200);
	print json_encode($questions);
} elseif($request_method == "POST"){
	$answer = new ProfileAnswer();
	$answer->questionId = $input_data['questionId'];
	$answer->answerId = $input_data['answerId'];
	$answer->profileId = $input_data['profileId'];
	$answer->correct = $input_data['correct'];
	$questDao = new QuestDao(); 	
	$return = $questDao->insertProfileAnswer($answer);

	if($return == '0K'){
		http_response_code(200);
		print json_encode(array('status'=>'ok'));	
	} else {
		http_response_code(200);
		print json_encode(array('status'=>'ko',"message"=>$return));		
	}	
}
?>