<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiNewsOther extends RestApi {

	public function get($params){
		$col = new NewsCol();
		if($params['GET']['type_id']){
			$col->sortByDate('DESC');
			$col->filterByNewsType($params['GET']['type_id'], $params['GET']['news_id']);
			$col->filterByStatus(1);

			// start limit page
			$showDataPerPage = 3;
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

}
