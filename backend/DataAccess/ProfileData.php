<?php 

include_once '/backend/DTO/Profile.php';
include_once '/backend/DataAccess/Database.php';

class ProfileData {

	public function getLeaderboard(){
		
		$connection = Database::getConnection();
		
		$query = "SELECT
						p.id_profile as id,
						p.username as username, 
						p.score as score
					FROM
						Profile p
					ORDER BY
						p.score DESC";
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$ranking = array();
		foreach($stmt->fetchAll() as $k=>$v) {
			$ranking[] = $this->convertDbDataToDto($v);
		}
		return $ranking;
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
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$profile = array();
		foreach($stmt->fetchAll() as $k=>$v) {
			$profile[] = $this->convertDbDataToDto($v);
		}
		return $profile;
	}	

	public function getProfileDetailByusername($username){
		
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
						p.username like '".$username."'";
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);

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
	
	public function updateCoins($id,$coins){
		try {
			$connection = Database::getConnection();

			$query = "UPDATE Profile p
						SET	p.coins = ".$coins."
					  WHERE p.id_profile = ".$id ;
			 
			// prepare query statement
			$stmt = $connection->prepare($query);
		 
			// execute query
			$stmt->execute();

			return "OK";
		} catch(PDOException $e) {
			return $sql . "<br>" . $e->getMessage();
		}
	}	

	public function updateScore($id,$score){
		try {		
			$connection = Database::getConnection();

			$query = "UPDATE Profile p
						SET	p.score = ".$score."
					  WHERE p.id_profile = ".$id ;
			 
			// prepare query statement
			$stmt = $connection->prepare($query);
		 
			// execute query
			$stmt->execute();

			return "OK";
		} catch(PDOException $e) {
			return $sql . "<br>" . $e->getMessage();
		}
	}

	public function verifyUsername($profile){
		try {
			$connection = Database::getConnection();

			$query = "SELECT count(*)
						FROM
							Profile p
						WHERE
							p.username ='".$profile->username."'";
			 
			// prepare query statement
			$stmt = $connection->prepare($query);
		 
			// execute query
			$stmt->execute();
			return $stmt->fetchColumn(); exit();
			
		} catch(PDOException $e) {
			return $query . "<br>" . $e->getMessage();
		}
	}
	
	private function convertDbDataToDto($dbrow){
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