<?php

include_once '/backend/DataAccess/ProfileData.php';
include_once '/backend/DTO/Profile.php';

class LaunchDao {
	
	public function getLeaderboard(){
		$leaderboard = new ProfileData();
		return $leaderboard->getLeaderboard();
	}

}

?>