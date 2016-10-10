<?php

use
	OSC\Advertisement\Collection
		as AdvertisementCol
;

class RestApiAdvertisement extends RestApi {

	public function get($params){
		$col = new AdvertisementCol();

		$col->filterByStatus(1);
		$params['GET']['location'] ? $col->filterBylocation($params['GET']['location']) : '';
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

}
