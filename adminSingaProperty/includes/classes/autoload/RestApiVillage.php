<?php

use
	OSC\Village\Collection
		as VillageCol,
	OSC\Village\Object
		as VillageObj
;

class RestApiVillage extends RestApi {

	public function get($params){
		$col = new VillageCol();
		// start limit page
		$showDataPerPage = 10;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$obj = new VillageObj();
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
		$obj = new VillageObj();
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

		$obj = new VillageObj();
		$obj->setId($this->getId());
		$obj->delete();

		return array(
			'data' => array(
				'data' => 'success'
			)
		);

	}

}
