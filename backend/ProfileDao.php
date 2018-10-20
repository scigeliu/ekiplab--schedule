<?php

include_once '/backend/DataAccess/ProfileData.php';

class ProfileDao {
	
	public function getProfileDetail($id){
		$profileData = new ProfileData();
		return $profileData->getProfileDetail($id);
	}

	public function updateCoins($id,$coins){
		$profileData = new ProfileData();
		return $profileData->updateCoins($id,$coins);
	}
	
	public function updateScore($id,$score){
		$profileData = new ProfileData();
		return $profileData->updateScore($id,$score);
	}	
}
?>