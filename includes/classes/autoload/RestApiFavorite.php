<?php

use
	OSC\Favorite\Object as FavoriteObj
;

class RestApiFavorite extends RestApi {

	public function post($params){
		$obj = new FavoriteObj();
		$obj->setSessionId($_SESSION['sessiontoken']);
		$obj->setProperties($params['POST']);
		$obj->insert();
		return array(
			'data' => array(
				'id' => $obj->getId()
			)
		);

	}

}
