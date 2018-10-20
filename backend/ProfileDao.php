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