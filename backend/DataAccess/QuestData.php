<?php 

include_once '/backend/DTO/Quest.php';
include_once '/backend/DTO/Answer.php';
include_once '/backend/DataAccess/Database.php';

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
						a.flag_correct as correct,
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

		$question = $this->convertDbDataToDto($v);
		
		return $question;
	}

	
	public function getProfileDetail($id){
		
		$connection = Database::getConnection();
		
		$query = "SELECT
						p.id_profile as id,
						p.username as username, 
						p.score as score,
						p.level as level, 
						p.coins as coins
					FROM
						Profile p
					WHERE
						p.id_profile =".$id;
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$profile = array();
		foreach($stmt->fetchAll() as $k=>$v) {
			$profile[] = $this->convertDbDataToDto($v);
		}
		return $profile;
	}	

	public function createProfile($profile){
		try {
			$connection = Database::getConnection();

			$query = "INSERT INTO Profile
						(username, score, level, coins)
					  VALUES ('".$profile->username."','0','1','".$profile->coins."');";
			 
			// prepare query statement
			$stmt = $connection->prepare($query);
		 
			// execute query
			$stmt->execute();
			return "OK";
		} catch(PDOException $e) {
			return $query . "<br>" . $e->getMessage();
		}
	}
	
	private function convertDbDataToDto($dbrow){
		
		foreach($stmt->fetchAll() as $k=>$v) {
			$question = $this->convertDbDataToDto($v);
		}		
		$profile = new Profile();
		
		$profile->id = $dbrow['id'];
		$profile->username = $dbrow['username'];
		if(isset($dbrow['coins'])) $profile->coin = $dbrow['coins']; else $profile->coin = 0;
		if(isset($dbrow['score'])) $profile->score = $dbrow['score']; else $profile->score = 0;
		if(isset($dbrow['level'])) $profile->level = $dbrow['level']; else $profile->level = 1;	
		
		return $profile;
	}	
	
}
?>