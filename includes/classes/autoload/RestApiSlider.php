<?php

use
	OSC\ImageSlider\Collection
		as SliderCol
;

class RestApiSlider extends RestApi {

	public function get($params){
		$col = new SliderCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}
}
