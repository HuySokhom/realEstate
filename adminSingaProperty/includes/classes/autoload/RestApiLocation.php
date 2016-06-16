<?php

use
	OSC\Location\Collection
		as LocationCol,
	OSC\Location\Object
		as LocationObj
;

class RestApiLocation extends RestApi {

	public function get($params){
		$col = new LocationCol();
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$params['GET']['search_name'] ? $col->filterByName($params['GET']['search_name']) : '';
		// start limit page
		if($params['GET']['pagination']) {
			$showDataPerPage = 10;
			$start = $params['GET']['start'];
			$this->applyLimit($col,
					array(
							'limit' => array($start, $showDataPerPage)
					)
			);
		}
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$obj = new LocationObj();
		$obj->setProperties( $params['POST'] );
		$obj->insert();
		$id = $obj->getId();
		return array(
			'data' => array(
				'id' => $id
			)
		);
	}

	public function put($params){
		$obj = new LocationObj();
		$obj->setId($this->getId());
		$obj->setProperties($params['PUT']);
		$obj->update();

		return array(
			'data' => array(
				'success' => 'true'
			)
		);

	}

	public function delete(){

		$obj = new LocationObj();
		$obj->setId($this->getId());
		$obj->delete();

		return array(
			'data' => array(
				'data' => 'success'
			)
		);

	}

}
