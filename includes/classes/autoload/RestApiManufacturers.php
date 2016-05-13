<?php

use
	OSC\Manufacturers\Collection
		as ManufacturersCol
;

class RestApiManufacturers extends RestApi {

	public function get(){
		$col = new ManufacturersCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}
}
