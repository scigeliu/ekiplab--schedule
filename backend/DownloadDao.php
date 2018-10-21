<?php 

include_once 'backend/DataAccess/DownloadData.php';

class DownloadDao {
	
	public function insertDownload($num){
		$launchData = new DownloadData();
		return $launchData->insertNewDownload($num);
	}

}

?>