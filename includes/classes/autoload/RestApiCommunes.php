<?php

use
	OSC\Communes\Collection
		as CommunesCol
;

class RestApiCommunes extends RestApi {

	public function get($params){
		$col = new CommunesCol();
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
