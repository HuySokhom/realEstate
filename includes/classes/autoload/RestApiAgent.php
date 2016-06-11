<?php

use
	OSC\Customer\Collection
		as CustomerCol
;

class RestApiAgent extends RestApi {

	public function get($params){
		$col = new CustomerCol();

		$col->filterByStatus(1);
		$this->getId() ? $col->filterById($this->getId()) : '';

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
