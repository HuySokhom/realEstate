<?php

use
	OSC\ContentDescription\Collection as ContentCol,
	OSC\ContentDescription\Object as ContentObj
;

class RestApiContent extends RestApi {

	public function get($params){
		$col = new ContentCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

	public function put($params){
		$obj = new ContentObj();
		$id = $this->getId();
		$obj->setProperties($params['PUT']);
		$obj->setId($id);
		$obj->update();
		return array(
			'data' => array(
				'success' => 'true'
			)
		);

	}

}
