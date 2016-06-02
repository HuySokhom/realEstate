<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiNewsPreviousRecord extends RestApi {

	public function get($params){
		$col = new NewsCol();
		if($this->getId()){
			$col->filterByPreviousRecord($this->getId());var_dump($col->getQueryString());
			$this->applyFilters($col, $params);
			$this->applySortBy($col, $params);
			return $this->getReturn($col, $params);
		}

	}

}
