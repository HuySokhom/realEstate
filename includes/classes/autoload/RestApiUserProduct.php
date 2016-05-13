<?php

use
	OSC\ProductPost\Collection
		as ProductPostCol
;

class RestApiUserProduct extends RestApi {

	public function get($params){
		$col = new ProductPostCol();
		$userId = $this->getId();
		// start limit page
//		$showDataPerPage = 10;
//		$start = $params['GET']['start'];
//		$this->applyLimit($col,
//			array(
//				'limit' => array( $start, $showDataPerPage )
//			)
//		);
		$col->sortByDate('DESC');
		$col->filterByCustomersId($userId);
		// filter with default status 1
		$params['filters']['status'] = 1;
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

}

