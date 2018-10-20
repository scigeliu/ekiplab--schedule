<?php

include_once 'backend/DataAccess/QuestData.php';

class QuestDao {
	
	public function getQuestList($id){
		$questData = new ProfileData();
		return $questData->getQuestList($id);
	}

	public function insertProfileAnswer($answer){
		$questData = new ProfileData();
		return $questData->insertProfileAnswer($answer);
	}

}
?>