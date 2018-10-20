<?php

include_once '/backend/DataAccess/QuestData.php';

class QuestDao {
	
	public function getQuestList($id){
		$questData = new ProfileData();
		return $questData->getQuestList($id);
	}

	public function insertProfileAnswer($answer){
		//$profileData = new ProfileData();
		//return $profileData->updateCoins($id,$coins);
	}
	
	public function updateScore($id,$score){
		$profileData = new ProfileData();
		return $profileData->updateScore($id,$score);
	}

	public function insertProfile($profile){
		$profileData = new ProfileData();
		$count = $profileData->verifyUsername($profile);
		if($count>0)
			return "DUPLICATE";
		else
			return $profileData->createProfile($profile);
	}	
	
}
?>