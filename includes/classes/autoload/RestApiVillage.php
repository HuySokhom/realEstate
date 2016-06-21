<?php

use
	OSC\Village\Collection
		as VillageCol,
	OSC\Village\Object
		as VillageObj
;

class RestApiVillage extends RestApi {

	public function get($params){
		$col = new VillageCol();
		$this->getId() ? $col->filterByDistrictId($this->getId()): '';
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
