<?php

include_once 'backend/MarketplaceDao.php';
include_once 'backend/DTO/Quest.php';
include_once 'backend/DTO/ProfileAnswer.php';

$request_method = $_SERVER['REQUEST_METHOD'];

if($request_method == "GET"){
	$marketDao = new MarketplaceDao();
	$products = $marketDao->getProductList();
	http_response_code(200);
	print json_encode($products,JSON_UNESCAPED_SLASHES);
}

?>