<?php

include_once 'backend/DataAccess/ProfileData.php';

class LeaderBoardDao {
	
	public function getLeaderboard(){
		$leaderboard = new ProfileData();
		return $leaderboard->getLeaderboard();
	}

}

?>