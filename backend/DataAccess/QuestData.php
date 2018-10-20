<?php 

include_once 'backend/DTO/Quest.php';
include_once 'backend/DTO/Answer.php';
include_once 'backend/DataAccess/Database.php';

class ProfileData {

	public function getQuestList($id){

		$connection = Database::getConnection();
		
		$query = "SELECT
						q.id_question as question_id,
						q.question as question, 
						q.question_type as question_type,
						q.question_point as question_point,
						q.question_coin as question_coin,
						a.id_answer as answer_id,
						a.answer as answer,
						a.flag_correct as correct
					FROM
						quest_questions q,
						question_answers a
					WHERE 
						q.id_question = a.id_question
					AND q.id_question not in (
							SELECT pa.id_question
							  FROM profile_answers pa
							 WHERE pa.id_profile = ".$id."
						)";
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$question = $this->convertDbDataToDto($stmt);
		
		return $question;
	}

	public function insertProfileAnswer($answer){
		try {
			$connection = Database::getConnection();

			$query = "INSERT INTO profile_answers
						(id_profile, id_question, id_answer, flag_correct)
					  VALUES ('".$answer->profileId."',".$answer->questionId.",".$answer->answerId.",'".$answer->correct."');";
			 
			// prepare query statement
			$stmt = $connection->prepare($query);
		 
			// execute query
			$stmt->execute();
			return "OK";
		} catch(PDOException $e) {
			return $query . "<br>" . $e->getMessage();
		}
	}
	
	private function convertDbDataToDto($stmt){
		$questions = array();
		
		foreach($stmt->fetchAll() as $k=>$v) {
			if(!empty($questions) && array_key_exists ($v['question_id'], $questions)){
				$answer = new Answer();
				$answer->answerId = $v['answer_id'];
				$answer->answer = $v['answer'];
				$answer->flagCorrect = $v['correct'];
				
				$questions[$v['question_id']]->answers[] = $answer;				
			} else {
				$question = new Quest();
				$question->questionId = $v['question_id'];
				$question->question = $v['question'];
				$question->questionType = $v['question_type'];
				$question->questionPoint = $v['question_point'];
				$question->questionCoin = $v['question_coin'];
				
				$answer = new Answer();
				$answer->answerId = $v['answer_id'];
				$answer->answer = $v['answer'];
				$answer->flagCorrect = $v['correct'];
				
				$question->answers = array($answer);

				$questions[$v['question_id']] = $question;
			}
			$v['question_id'];
		}		

		return $questions;
	}	
	
}
?>