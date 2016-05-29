<?php

use
	OSC\News\Collection
		as NewsCol
;

class RestApiNews extends RestApi {

	public function get($params){
		$col = new NewsCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}
}
