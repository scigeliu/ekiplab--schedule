<?php 
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
	
	public getLeaderboard(){
		
		$connection = getConnection();
		
		$query = "SELECT
						p.id_profile as id,
						p.username as username, 
						p.score as point
					FROM
						Profile p
					ORDER BY
						p.score DESC";
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		return $stmt;
	}
	
	
	
}
?>