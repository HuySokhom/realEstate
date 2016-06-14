<?php

use
	OSC\Location\Collection
		as LocationCol
;

class RestApiLocation extends RestApi {

	public function get(){
		$col = new LocationCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}
}
