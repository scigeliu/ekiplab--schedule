<?php 

include_once 'backend/DTO/Product.php';
include_once 'backend/DataAccess/Database.php';

class MarketplaceData {

	public function getProductList(){

		$connection = Database::getConnection();
		
		$query = "SELECT
						p.id_product as id,
						p.coins as coins, 
						p.title as title,
						p.category as category,
						p.image as image
					FROM
						product p";
		 
		// prepare query statement
		$stmt = $connection->prepare($query);
	 
		// execute query
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$products = array();

		foreach($stmt->fetchAll() as $k=>$v) {
			$products[] = $this->convertDbDataToDto($v);
		}
		return $products;
	}
	
	private function convertDbDataToDto($objRow){
		$product = new Product();
		
		$product->id = $objRow['id'];
		$product->coins = $objRow['coins'];
		$product->title = $objRow['title'];
		$product->category = $objRow['category'];
		$product->image = $objRow['image'];
		
		return $product;
	}	
	
}
?>