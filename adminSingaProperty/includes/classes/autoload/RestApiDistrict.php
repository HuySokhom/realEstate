<?php

use
	OSC\District\Collection
		as DistrictCol,
	OSC\District\Object
		as DistrictObj
;

class RestApiDistrict extends RestApi {

	public function get($params){
		$col = new DistrictCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$obj = new DistrictObj();
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
		$obj = new DistrictObj();
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

		$obj = new DistrictObj();
		$obj->setId($this->getId());
		$obj->delete();

		return array(
			'data' => array(
				'data' => 'success'
			)
		);

	}

}
