<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiSessionUserNews extends RestApi {

	public function get($params){
		$col = new NewsCol();
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$col->sortByDate('DESC');
			$col->filterByUserId($userId);
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

}
