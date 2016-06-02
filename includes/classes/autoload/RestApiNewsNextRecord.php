<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiNewsNextRecord extends RestApi {

	public function get($params){
		$col = new NewsCol();
		if($this->getId()){
			$col->filterByNextRecord($this->getId());
			$this->applyFilters($col, $params);
			$this->applySortBy($col, $params);
			return $this->getReturn($col, $params);
		}

	}

}
