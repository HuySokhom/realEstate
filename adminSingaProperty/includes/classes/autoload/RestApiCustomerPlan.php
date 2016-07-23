<?php

use
	OSC\CustomerPlan\Object as planObj,
	OSC\CustomerPlan\Collection as planCol
;

class RestApiCustomerPlan extends RestApi {

	public function get($params){
		$col = new planCol();
		$col->orderByDate('DESC');
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$params['GET']['customers_id'] ? $col->filterByCustomerId($params['GET']['customers_id']) : '';
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

	public function put($params){
		$obj = new planObj();
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
