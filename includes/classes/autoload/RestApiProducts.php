<?php

use
	OSC\Product\Collection
		as ProductCol
;

class RestApiProducts extends RestApi {

	public function get($params){
		$col = new ProductCol();

		$col->filterByStatus(1);
		$this->getId() ? $col->filterByCustomersId($this->getId()) : '';
		$col->sortByDate("DESC");
		// start limit page
		$showDataPerPage = 9;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);

		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

}
