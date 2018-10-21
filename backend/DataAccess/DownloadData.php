<?php 

include_once 'backend/DataAccess/Database.php';

class DownloadData {

	public function insertNewDownload($ip){
		try {
			$connection = Database::getConnection();

			$query = "INSERT INTO download
						(download_ip, download_date)
					  VALUES ('".$ip."',NOW());";
			 
			// prepare query statement
			$stmt = $connection->prepare($query);
		 
			// execute query
			$stmt->execute();
			return "OK";
		} catch(PDOException $e) {
			return $query . "<br>" . $e->getMessage();
		}
	}
}
?>