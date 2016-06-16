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
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$params['GET']['search_name'] ? $col->filterByName($params['GET']['search_name']) : '';
		$params['GET']['type'] ? $col->filterByProvinceId($params['GET']['type']) : '';
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
