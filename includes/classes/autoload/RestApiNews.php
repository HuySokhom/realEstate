<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiNews extends RestApi {

	public function get($params){
		$col = new NewsCol();
		$col->sortByDate('DESC');
		$col->filterByStatus(1);
		$this->getId() ? $col->filterById($this->getId()) : '';
		$params['GET']['news_type_id'] ? $col->filterByTypeId($params['GET']['news_type_id']) : '';
		// start limit page
		$showDataPerPage = 10;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);

		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

}
