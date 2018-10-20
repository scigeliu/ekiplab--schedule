<?php 

include_once '/backend/DTO/Profile.php';

class ProfileData {
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "nasa_db";
    private $username = "root";
    private $password = "";
    private $conn;
 
    // get the database connection
	private function getConnection(){
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn -> exec("set names utf8");
        } catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->conn;
	}
	
	public function getLeaderboard(){
		
		$connection = $this->getConnection();
		
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
		
		$connection = $this->getConnection();
		
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

		$connection = $this->getConnection();

		$query = "INSERT INTO Profile p
					(username, score, level, coins)
				  VALUES (".$profile->username.",0,1,0);";
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		return $stmt;
	}
	
	public function updateCoins($id,$coins){
		$connection = $this->getConnection();

		$query = "UPDATE Profile p
					SET	p.coins = ".$coins."
				  WHERE p.id_profile = ".$id ;
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		return $stmt;
	}	

	public function updateScore($id,$score){
		
		$connection = $this->getConnection();

		$query = "UPDATE Profile p
					SET	p.score = ".$score."
				  WHERE p.id_profile = ".$id ;
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		return $stmt;
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