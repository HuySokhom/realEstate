<?php

use
	OSC\District\Collection
		as DistrictCol,
	OSC\District\Object
		as DistrictObj
;

class RestApiDistrict extends RestApi {

	public function get($params){
		$col = new DistrictCol();
		$this->getId() ? $col->filterByProvinceId($this->getId()) : '';
		// start limit page
		if($params['GET']['pagination']) {
			$showDataPerPage = 10;
			$start = $params['GET']['start'];
			$this->applyLimit($col,
				array(
					'limit' => array($start, $showDataPerPage)
				)
			);
		}

		return $this->getReturn($col, $params);
	}

}
