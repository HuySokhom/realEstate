<?php

use
	OSC\Content\Collection as ContentCol,
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
		foreach($params['PUT'] as $value){
			$obj->setProperties($value);
			$obj->update();
		}
		return array(
			'data' => array(
				'success' => 'true'
			)
		);

	}

}
