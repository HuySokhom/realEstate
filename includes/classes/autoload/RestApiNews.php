<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiNews extends RestApi {

	public function get($params){
		$col = new NewsCol();
		$col->sortByDate('DESC');
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$params['GET']['search_title'] ? $col->filterByTitle($params['GET']['search_title']) : '';
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
