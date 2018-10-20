<?php

include_once '/backend/DataAccess/MarketplaceData.php';

class MarketplaceDao {
	
	public function getProductList(){
		$marketData = new MarketplaceData();
		return $marketData->getProductList();
	}

}
?>