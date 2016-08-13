<?php

use
	OSC\Favorite\Object as FavoriteObj
;

class RestApiFavorite extends RestApi {

	public function post($params){
		$obj = new FavoriteObj();
		$sessionId = $_SESSION['sessiontoken'];
		$productId = (int)$params['POST']['products_id'];
		$obj->setSessionId($sessionId);
		$obj->setProductsId($productId);
		$delete = $params['POST']['type'];
		if($delete == "delete"){
			$obj->delete();
			return array(
				'data' => array(
					'id' => $obj->getId()
				)
			);
		}else{
			$obj->insert();
			return array(
				'data' => array(
					'id' => $obj->getId()
				)
			);
		}
	}

}
