<?php

use
	OSC\PopularSearch\Collection as PopsearchCol,
	OSC\PopularSearch\Object as PopsearchObj
;

class RestApiSearchLocation extends RestApi {

	public function get($params){
		$col = new PopsearchCol();
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
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
		$newsObj = new PopsearchObj();
		$newsObj->setCreateBy($_SESSION['admin']['username']);
		$newsObj->setProperties( $params['POST'] );
		$newsObj->insert();
		$newId = $newsObj->getId();
		return array(
			'data' => array(
				'id' => $newId
			)
		);
	}

	public function put($params){
		$cols = new PopsearchCol();
		$typeId = $this->getId();
		$cols->filterById( $typeId );
		if( $cols->getTotalCount() > 0 ){
			$cols->populate();
			$col = $cols->getFirstElement();
			$col->setId($this->getId());
			$col->setProperties($params['PUT']);
			$col->setUpdateBy($_SESSION['admin']['username']);
			$col->update();
		}
		return array(
			'data' => array(
				'success' => 'true'
			)
		);

	}

	public function patch($params){
		$obj = new NewsTypeObj();
		$obj->setId($this->getId());
		$obj->setUpdateBy($_SESSION['admin']['username']);
		$obj->setStatus($params['PATCH']['status']);
		$obj->updateStatus();
	}

	public function delete(){

		$cols = new PopsearchCol();
		$cols->filterById( $this->getId() );
		if( $cols->getTotalCount() > 0 ){
			$cols->populate();
			$col = $cols->getFirstElement();
			$col->setId($this->getId());
			$col->delete();
		}
		return array(
			'data' => array(
				'data' => 'success'
			)
		);

	}

}
