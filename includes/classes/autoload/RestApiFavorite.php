<?php

use
	OSC\Favorite\Object as FavoriteObj
;

class RestApiFavorite extends RestApi {

	public function post($params){
		$obj = new FavoriteObj();
		$obj->setSessionId($_SESSION['sessiontoken']);
		$obj->setProductsId($params['POST']['products_id']);
		$delete = $params['POST']['delete'];
		if($delete){
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
